<?php

namespace zacksleo\yii2\cms\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%item}}".
 *
 * @property integer $id
 * @property string $item_name
 * @property string $categories
 * @property string $market_price
 * @property integer $price
 * @property string $description
 * @property integer $status
 * @property integer $subtitle
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $logo_image
 * @property string $url
 */
class Item extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_name', 'subtitle', 'categories', 'description'], 'required'],
            [['price', 'status', 'created_at', 'updated_at'], 'integer'],
            [['market_price'], 'number'],
            [['description', 'categories'], 'string'],
            [['item_name', 'logo_image', 'subtitle'], 'string', 'max' => 125],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item_name' => '商品名称',
            'subtitle' => '副标题',
            'categories' => '商品类别',
            'market_price' => '市场价',
            'price' => '价格',
            'description' => '简介',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'logo_image' => '缩略图'
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

    /**
     * @return string
     */
    public function getUrl()
    {
        return Url::to(['item/view', 'id' => $this->id]);
    }

    /**
     * @return ItemCategory
     */
    public function getItemCategory()
    {
        $category_id = array_shift(explode(',', $this->categories));
        return ItemCategory::findOne($category_id);
    }

    /**
     * @return array
     */
    public function getItemCategories()
    {
        $ids = explode(',', $this->categories);
        $res = [];
        foreach ($ids as $id) {
            $res[] = ItemCategory::findOne($id);
        }
        return $res;
    }

    public function getItemCategoriesName()
    {
        $categories = $this->getItemCategories();
        $labels = [];
        foreach ($categories as $category) {
            $labels[] = $category->name;
        }
        return implode(',', $labels);
    }

    public static function getStatusList()
    {
        return [
            self::STATUS_INACTIVE => '下线',
            self::STATUS_ACTIVE => '上线',
        ];
    }
}
