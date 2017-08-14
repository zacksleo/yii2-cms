<?php

namespace tests\models;

use tests\TestCase;
use zacksleo\yii2\cms\models\PostCategory;

class PostCategoryTest extends TestCase
{
    public function testRules()
    {
        $model = new PostCategory();
        $this->assertTrue($model->isAttributeRequired('lft'));
        $this->assertTrue($model->isAttributeRequired('rgt'));
        $this->assertTrue($model->isAttributeRequired('lvl'));
        $this->assertTrue($model->isAttributeRequired('name'));
        $model->name = 'name';
        $model->slug = 'slug';
        $this->assertTrue($model->makeRoot());
        $this->assertArrayHasKey('active', $model->getAttributes());
    }
}