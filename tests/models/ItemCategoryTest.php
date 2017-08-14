<?php

namespace tests\models;

use tests\TestCase;
use zacksleo\yii2\cms\models\ItemCategory;

class ItemCategoryTest extends TestCase
{
    public function testRules()
    {
        $model = new ItemCategory();
        $this->assertTrue($model->isAttributeRequired('lft'));
        $this->assertTrue($model->isAttributeRequired('rgt'));
        $this->assertTrue($model->isAttributeRequired('lvl'));
        $this->assertTrue($model->isAttributeRequired('name'));
        $model->lft = '1';
        $model->rgt = '1';
        $model->lvl = '0';
        $model->name = 'name';
        $model->icon = 'icon';
        $this->assertTrue($model->save());
        $this->assertArrayHasKey('active', $model->getAttributes());
    }
}
