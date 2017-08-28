<?php

namespace zacksleo\yii2\cms\models;

use Yii;

/**
 * This is the model class for table "{{%district}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 * @property string $initial
 * @property string $initials
 * @property string $pinyin
 * @property string $extra
 * @property string $suffix
 * @property string $code
 * @property string $area_code
 * @property integer $order
 * @property array[Hospital] hospitals
 */
class District extends \yii\db\ActiveRecord
{
    const BEIJING_ID = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%district}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'order'], 'integer'],
            [['name'], 'string', 'max' => 270],
            [['initial'], 'string', 'max' => 3],
            [['initials', 'code', 'area_code'], 'string', 'max' => 30],
            [['pinyin'], 'string', 'max' => 600],
            [['extra'], 'string', 'max' => 60],
            [['suffix'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'parent_id' => 'Parent ID',
            'initial' => 'Initial',
            'initials' => 'Initials',
            'pinyin' => 'Pinyin',
            'extra' => 'Extra',
            'suffix' => 'Suffix',
            'code' => 'Code',
            'area_code' => 'Area Code',
            'order' => 'Order',
        ];
    }

    public function fields()
    {
        $fields = [];
        $fields['province'] = function () {
            return $this->name;
        };
        return $fields;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChildren()
    {
        return $this->hasMany(District::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(District::className(), ['id' => 'parent_id']);
    }
}
