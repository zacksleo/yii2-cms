<?php

namespace tests\models;

use tests\data\models\Product;
use tests\TestCase;

class ItemFieldTest extends TestCase
{
    public function testSave()
    {
        $model = new Product();
        $model->item_id = 2;
        $model->freight = 23;
        $model->sales = 999;
        $this->assertTrue($model->save());
    }

    public function testFind()
    {
        $model = Product::findOne(1);
        $this->assertArrayHasKey('freight', $model->toArray());
        $this->assertArrayHasKey('sales', $model->toArray());
    }

    public function testDelete()
    {
        $model = Product::findOne(1);
        $this->assertTrue($model->delete());
    }
}
