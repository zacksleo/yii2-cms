<?php

namespace zacksleo\yii2\cms\models;

use Yii;
use yii\behaviors\TimestampBehavior;

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
            [['active', 'visits', 'created_at', 'updated_at'], 'integer'],
            [['title', 'image', 'source'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('cms', 'ID'),
            'title' => Yii::t('cms', 'Title'),
            'image' => Yii::t('cms', 'Image'),
            'content' => Yii::t('cms', 'Content'),
            'active' => Yii::t('cms', 'Active'),
            'source' => Yii::t('cms', 'Source'),
            'visits' => Yii::t('cms', 'Visits'),
            'created_at' => Yii::t('cms', 'Created At'),
            'updated_at' => Yii::t('cms', 'Updated At'),
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
