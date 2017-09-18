<?php

namespace zacksleo\yii2\cms\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%page}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property integer $status
 * @property string $content
 * @property integer $created_at
 * @property integer $updated_at
 */
class Page extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'slug'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['content'], 'string'],
            [['title', 'slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'slug' => '别名',
            'status' => '状态',
            'content' => '内容',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
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
            'fileBehavior' => [
                'class' => \nemmo\attachments\behaviors\FileBehavior::className()
            ],
        ];
    }

    public static function getStatusList()
    {
        return [
            self::STATUS_INACTIVE => '隐藏',
            self::STATUS_ACTIVE => '显示',
        ];
    }

    public function getUrl()
    {
        return Url::to(['page/view', 'slug' => $this->slug]);
    }

    public function getImage()
    {
        if ($this->files && $this->files[0] instanceof File) {
            return $this->files[0]->getUrl();
        }
        return 'https://ws1.sinaimg.cn/large/a76d6e45gy1fj5d3ckxgej205x05vaa4.jpg';
    }
}
