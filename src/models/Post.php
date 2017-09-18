<?php

namespace zacksleo\yii2\cms\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use zacksleo\yii2\cms\Module;
use creocoder\taggable\TaggableBehavior;
use yii\helpers\Url;
use zacksleo\yii2\cms\models\queries\PostQuery;

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
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

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
            ['tagValues', 'safe'],
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
            'tagValues' => '标签',
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
            'taggable' => [
                'class' => TaggableBehavior::className(),
                // 'tagValuesAsArray' => false,
                // 'tagRelation' => 'tags',
                // 'tagValueAttribute' => 'name',
                // 'tagFrequencyAttribute' => 'frequency',
            ],
        ];
    }

    /**
     * @return array
     */
    public static function getStatusList()
    {
        return [
            self::STATUS_INACTIVE => Module::t('cms', 'InActive'),
            self::STATUS_ACTIVE => Module::t('cms', 'Active'),
        ];
    }

    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])
            ->viaTable('{{%post_tag_assn}}', ['post_id' => 'id']);
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find()
    {
        return new PostQuery(get_called_class());
    }

    /**
     * @return PostCategory
     */
    public function getCategory()
    {
        $ids = explode(',', $this->categories);
        $category_id = array_shift($ids);
        return PostCategory::findOne($category_id);
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        $ids = explode(',', $this->categories);
        $res = [];
        foreach ($ids as $id) {
            $res[] = PostCategory::findOne($id);
        }
        return $res;
    }

    public function getCategoriesName()
    {
        $categories = $this->getCategories();
        $labels = [];
        foreach ($categories as $category) {
            $labels[] = $category->name;
        }
        return implode(',', $labels);
    }

    public function getUrl()
    {
        return Url::to(['post/view', 'id' => $this->id]);
    }

    public function beforeSave($insert)
    {
        $this->categories = ',' . trim($this->categories, ',') . ',';
        return parent::beforeSave($insert);
    }

    public function afterFind()
    {
        $this->categories = trim($this->categories, ',');
        parent::afterFind();
    }
}
