<?php

namespace zacksleo\yii2\cms\models;

use kartik\tree\models\Tree;
use yii;
use zacksleo\yii2\cms\Module;

/**
 * This is the model class for table "{{%item_category}}".
 *
 * @property integer $id
 * @property integer $root
 * @property integer $lft
 * @property integer $rgt
 * @property integer $lvl
 * @property string $name
 * @property string $icon
 * @property integer $icon_type
 * @property integer $active
 * @property integer $selected
 * @property integer $disabled
 * @property integer $readonly
 * @property integer $visible
 * @property integer $collapsed
 * @property integer $movable_u
 * @property integer $movable_d
 * @property integer $movable_l
 * @property integer $movable_r
 * @property integer $removable
 * @property integer $removable_all
 */
class ItemCategory extends Tree
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%item_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lft', 'lvl'], 'default', 'value' => 1],
            ['rgt', 'default', 'value' => 1],
            [
                [
                    'root',
                    'lft',
                    'rgt',
                    'lvl',
                    'icon_type',
                    'active',
                    'selected',
                    'disabled',
                    'readonly',
                    'visible',
                    'collapsed',
                    'movable_u',
                    'movable_d',
                    'movable_l',
                    'movable_r',
                    'removable',
                    'removable_all'
                ],
                'integer'
            ],
            [['lft', 'rgt', 'lvl', 'name'], 'required'],
            [['name'], 'string', 'max' => 60],
            [['icon'], 'string', 'max' => 255],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('tree', 'ID'),
            'root' => Module::t('tree', 'Root'),
            'lft' => Module::t('tree', 'Nested set left property'),
            'rgt' => Module::t('tree', 'Nested set right property'),
            'lvl' => Module::t('tree', 'Nested set level / depth'),
            'name' => Module::t('tree', 'Name'),
            'icon' => Module::t('tree', 'Icon'),
            'icon_type' => Module::t('tree', 'Icon Type'),
            'active' => Module::t('tree', 'Active'),
            'selected' => Module::t('tree', 'Selected'),
            'disabled' => Module::t('tree', 'Disabled'),
            'readonly' => Module::t('tree', 'Read Only'),
            'visible' => Module::t('tree', 'Visible'),
            'collapsed' => Module::t('tree', 'Collapsed'),
            'movable_u' => Module::t('tree', 'Up Movable'),
            'movable_d' => Module::t('tree', 'Down Movable'),
            'movable_l' => Module::t('tree', 'Movable To The Left'),
            'movable_r' => Module::t('tree', 'Movable To The Right'),
            'removable' => Module::t('tree', 'Removable'),
            'removable_all' => Module::t('tree', 'Removable Along With Descendants'),
        ];
    }

}
