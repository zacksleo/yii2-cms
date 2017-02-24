<?php

namespace zacksleo\yii2\cms\models;

use Yii;

/**
 * This is the model class for table "{{%item_field}}".
 *
 * @property integer $item_id
 * @property string $field
 * @property string $value
 */
class ItemField extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%item_field}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'field'], 'required'],
            [['item_id'], 'integer'],
            [['value'], 'string'],
            [['field'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_id' => Yii::t('cms', 'Item ID'),
            'field' => Yii::t('cms', 'Field'),
            'value' => Yii::t('cms', 'Value'),
        ];
    }
}
