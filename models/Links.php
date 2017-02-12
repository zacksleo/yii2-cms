<?php

namespace zacksleo\yii2\cms\models;

use Yii;
use zacksleo\yii2\cms\Module;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%links}}".
 *
 * @property integer $id
 * @property string $category
 * @property string $name
 * @property string $description
 * @property string $url
 * @property string $logo
 * @property integer $order
 * @property integer $created_at
 * @property integer $updated_at
 */
class Links extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%links}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order', 'created_at', 'updated_at'], 'integer'],
            [['name', 'url'], 'required'],
            [['name', 'description', 'url', 'logo', 'category'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('links', 'ID'),
            'category' => Module::t('links', 'Category'),
            'name' => Module::t('links', 'Name'),
            'description' => Module::t('links', 'Description'),
            'url' => Module::t('links', 'Url'),
            'logo' => Module::t('links', 'Logo'),
            'order' => Module::t('links', 'Order'),
            'created_at' => Module::t('links', 'Created At'),
            'updated_at' => Module::t('links', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }

}
