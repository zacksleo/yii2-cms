<?php

namespace tests\models;

use tests\TestCase;
use zacksleo\yii2\cms\models\Post;

class PostTest extends TestCase
{
    public function testRules()
    {
        $model = new Post();
        $this->assertTrue($model->isAttributeRequired('title'));
        $this->assertTrue($model->isAttributeRequired('content'));
        $this->assertTrue($model->isAttributeRequired('active'));
        $model->title = 'title';
        $model->content = 'content';
        $model->active = 0;
        $model->category_id = 1;
        $model->categories = '1,2,3,4';
        $this->assertTrue($model->save());
    }
}
