<?php

namespace zacksleo\yii2\cms\tests\models;

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
}
