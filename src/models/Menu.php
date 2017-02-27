<?php

namespace zacksleo\yii2\cms\models;

use Yii;
use zacksleo\yii2\cms\Module;

/**
 * This is the model class for table "{{%menu}}".
 *
 * @property integer $id
 * @property string $title
 * @property integer $order
 * @property integer $parent
 * @property string $url
 * @property array $children
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'url'], 'required'],
            ['parent', 'default', 'value' => 0],
            [['order', 'parent'], 'integer'],
            [['title', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('cms', 'ID'),
            'title' => Module::t('cms', 'Title'),
            'order' => Module::t('cms', 'Order'),
            'parent' => Module::t('cms', 'Parent'),
            'url' => Module::t('cms', 'Url'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChildren()
    {
        return $this->hasMany(self::className(), ['parent' => 'id'])->orderBy('order');
    }
}
