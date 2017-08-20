<?php
namespace zacksleo\yii2\cms\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\base\DynamicModel;
use zacksleo\yii2\cms\Module;
use yii\base\InvalidParamException;

/**
 * Class Setting
 * @package zacksleo\yii2\cms\models
 * @property string $type
 * @property string $key
 * @property string $value
 * @property integer $item_id
 */
class ItemField extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%item_field}}';
    }

    /**
     * @param bool $forDropDown if false - return array or validators, true - key=>value for dropDown
     * @return array
     */
    public function getTypes($forDropDown = true)
    {
        $values = [
            'string' => ['value', 'string'],
            'integer' => ['value', 'integer'],
            'boolean' => ['value', 'boolean', 'trueValue' => "1", 'falseValue' => "0", 'strict' => true],
            'float' => ['value', 'number'],
            'email' => ['value', 'email'],
            'ip' => ['value', 'ip'],
            'url' => ['value', 'url'],
            'object' => [
                'value',
                function ($attribute, $params) {
                    $object = null;
                    try {
                        Json::decode($this->$attribute);
                    } catch (InvalidParamException $e) {
                        $this->addError($attribute, Module::t('settings', '"{attribute}" must be a valid JSON object', [
                            'attribute' => $attribute,
                        ]));
                    }
                }
            ],
        ];

        if (!$forDropDown) {
            return $values;
        }

        $return = [];
        foreach ($values as $key => $value) {
            $return[$key] = Module::t('settings', $key);
        }

        return $return;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['item_id', 'integer'],
            [['value'], 'string'],
            ['key', 'string', 'max' => 255],
            [
                ['key'],
                'unique',
                'targetAttribute' => ['item_id', 'key'],
                'message' =>
                    Module::t('cms', '{attribute} "{value}" already exists for this section.')
            ],
            ['type', 'in', 'range' => array_keys($this->getTypes(false))],
            ['type', 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('cms', 'ID'),
            'type' => Module::t('cms', 'Type'),
            'item_id' => Module::t('cms', 'Item ID'),
            'key' => Module::t('cms', 'Key'),
            'value' => Module::t('cms', 'Value'),
        ];
    }

    public function beforeSave($insert)
    {
        $validators = $this->getTypes(false);
        if (!array_key_exists($this->type, $validators)) {
            $this->addError('type', Module::t('cms', 'Please select correct type'));
            return false;
        }

        $model = DynamicModel::validateData([
            'value' => $this->value
        ], [
            $validators[$this->type],
        ]);

        if ($model->hasErrors()) {
            $this->addError('value', $model->getFirstError('value'));
            return false;
        }

        if ($this->hasErrors()) {
            return false;
        }

        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function getSettings()
    {
        $settings = static::find()->asArray()->all();
        return array_merge_recursive(
            ArrayHelper::map($settings, 'key', 'value', 'item_id'),
            ArrayHelper::map($settings, 'key', 'type', 'item_id')
        );
    }

    /**
     * @inheritdoc
     */
    public function setSetting($item_id, $key, $value, $type = null)
    {
        $model = static::findOne(['item_id' => $item_id, 'key' => $key]);

        if ($model === null) {
            $model = new static();
        }
        $model->item_id = $item_id;
        $model->key = $key;
        $model->value = strval($value);

        if ($type !== null) {
            $model->type = $type;
        } else {
            $t = gettype($value);
            if ($t == 'string') {
                $error = false;
                try {
                    Json::decode($value);
                } catch (InvalidParamException $e) {
                    $error = true;
                }
                if (!$error) {
                    $t = 'object';
                }
            }
            $model->type = $t;
        }

        return $model->save();
    }

    /**
     * @inheritdoc
     */
    public function deleteSetting($item_id, $key)
    {
        $model = static::findOne(['item_id' => $item_id, 'key' => $key]);

        if ($model) {
            return $model->delete();
        }
        return true;
    }

    /**
     * @param $key
     * @param $item_id
     * @return array|null|ActiveRecord
     */
    public function findSetting($key, $item_id)
    {
        return $this->find()->where(['item_id' => $item_id, 'key' => $key])->limit(1)->one();
    }
}
