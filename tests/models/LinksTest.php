<?php

namespace tests\models;

use zacksleo\yii2\cms\models\Links;
use tests\TestCase;

class LinksTest extends TestCase
{
    public function testRules()
    {
        $model = new Links();
        $this->assertTrue($model->isAttributeRequired('name'));
        $this->assertTrue($model->isAttributeRequired('url'));
    }

    public function testSave()
    {
        $model = new Links();
        $model->name = 'name';
        $model->url = 'url';
        $model->order = 'order';
        $this->assertFalse($model->validate());
        $model->order = 0;
        $this->assertTrue($model->validate());
        $this->assertTrue($model->save());
        $this->assertInternalType('integer', $model->created_at);
        $this->assertInternalType('integer', $model->updated_at);
    }
}
