<?php

namespace zacksleo\yii2\cms\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use zacksleo\yii2\cms\Module;

/**
 * This is the model class for table "{{%news}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $image
 * @property string $content
 * @property integer $active
 * @property string $source
 * @property integer $visits
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $category_id
 * @property string $categories
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%post}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'active'], 'required'],
            [['content'], 'string'],
            [['active', 'visits', 'created_at', 'updated_at', 'category_id'], 'integer'],
            [['title', 'image', 'source', 'categories'], 'string', 'max' => 255],
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
            'image' => Module::t('cms', 'Image'),
            'content' => Module::t('cms', 'Content'),
            'active' => Module::t('cms', 'Active'),
            'source' => Module::t('cms', 'Source'),
            'visits' => Module::t('cms', 'Visits'),
            'category_id' => Module::t('cms', 'Category Id'),
            'categories' => Module::t('cms', 'Categories'),
            'created_at' => Module::t('cms', 'Created At'),
            'updated_at' => Module::t('cms', 'Updated At'),
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
