<?php

namespace tests\models;

use tests\TestCase;
use zacksleo\yii2\cms\models\Item;

class ItemTest extends TestCase
{
    public function testRules()
    {
        $model = new Item();
        $this->assertTrue($model->isAttributeRequired('item_name'));
        $this->assertTrue($model->isAttributeRequired('subtitle'));
        $this->assertTrue($model->isAttributeRequired('categories'));
        $this->assertTrue($model->isAttributeRequired('description'));
        $model->item_name = 'item_name';
        $model->subtitle = 'subtitle';
        $model->categories = '1,2,3';
        $model->description = 'description';
        $model->logo_image = 'logo image';
        $this->assertTrue($model->save());
    }

    public function testGetItemCategory()
    {
        $model = Item::findOne(1);
        $category = $model->getItemCategory();
        $this->assertInstanceOf('zacksleo\yii2\cms\models\ItemCategory', $category);
    }

    public function testGetItemCategories()
    {
        $model = Item::findOne(1);
        $categories = $model->getItemCategories();
        foreach ($categories as $category) {
            $this->assertInstanceOf('zacksleo\yii2\cms\models\ItemCategory', $category);
        }
    }

    public function testGetItemCategoriesName()
    {
        $model = Item::findOne(1);
        $name = $model->getItemCategoriesName();
        $this->assertInternalType('string', $name);
    }

    public function testGetStatusList()
    {
        $list = Item::getStatusList();
        $this->assertSame(2, count($list));
    }
}
