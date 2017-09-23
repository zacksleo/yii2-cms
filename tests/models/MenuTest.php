<?php

namespace tests\models;

use zacksleo\yii2\cms\models\Menu;
use tests\TestCase;

class MenuTest extends TestCase
{
    public function testRules()
    {
        $model = new Menu();
        $this->assertTrue($model->isAttributeRequired('title'));
        $this->assertTrue($model->isAttributeRequired('url'));
    }

    public function testSave()
    {
        $model = new Menu();
        $model->title = 'name';
        $model->url = 'url';
        $model->order = 'order';
        $this->assertFalse($model->validate());
        $model->order = 0;
        $this->assertTrue($model->validate());
        $this->assertTrue($model->save());
    }

    public function testGetChildren()
    {
        $model = Menu::findOne(['id' => 1]);
        $this->assertNotEmpty($model->children);
        $this->assertArrayHasKey('title', $model->children[0]);
        $this->assertArrayHasKey('url', $model->children[0]);
    }

    public function testGetFather()
    {
        $model = Menu::findOne(2);
        $this->assertInstanceOf('zacksleo\yii2\cms\models\Menu', $model->father);
        $this->assertObjectHasAttribute('title', $model->father);
        $this->assertEquals($model->parent, $model->father->id);
    }
}
