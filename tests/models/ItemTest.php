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
        $this->assertTrue($model->isAttributeRequired('category_id'));
        $this->assertTrue($model->isAttributeRequired('description'));
        $model->item_name = 'item_name';
        $model->subtitle = 'subtitle';
        $model->category_id = '1';
        $model->description = 'description';
        $this->assertTrue($model->save());
    }
}
