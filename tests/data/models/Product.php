<?php


namespace tests\data\models;

use yii\base\Model;
use zacksleo\yii2\cms\models\ItemField;

class Product extends Model
{
    public $item_id;
    public $sales;
    public $freight;

    public function rules()
    {
        return [
            [['item_id', 'sales', 'freight'], 'required'],
            [['sales', 'freight'], 'integer']
        ];
    }

    public function attributeLabels()
    {
        return [
            'item_id' => 'Item ID',
            'sales' => '销量',
            'freight' => '运费',
        ];
    }

    public function fields()
    {
        return [
            'sales',
            'freight'
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }
        $model = new ItemField();
        if ($model->setSetting($this->item_id, 'sales', $this->sales, 'integer') &&
            $model->setSetting($this->item_id, 'freight', $this->freight, 'integer')
        ) {
            return true;
        } else {
            $this->addErrors($model->getErrors());
            return false;
        }
    }

    public function delete()
    {
        $model = new ItemField();
        foreach ($this->fields() as $key) {
            $model->deleteSetting($this->item_id, $key);
        }
        return true;
    }

    public static function findOne($id)
    {
        $model = new ItemField();
        $product = new Product();
        foreach ($product->fields() as $key) {
            $product->{$key} = $model->findSetting($key, $id);
        }
        $product->item_id = $id;
        return $product;
    }
}
