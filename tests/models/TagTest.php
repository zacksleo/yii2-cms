<?php

namespace tests\models;

use tests\TestCase;
use zacksleo\yii2\cms\models\Tag;

/**
 * Class TagTest
 * @package tests\models
 * @auth zacksleo <zacksleo@gmail.com>
 */
class TagTest extends TestCase
{
    public function testSave()
    {
        $model = new Tag();
        $model->name = 'tag';
        $model->frequency = 100;
        $this->assertTrue($model->save());
    }

    public function testAttributeLabels()
    {
        $model = new Tag();
        $labels = $model->attributeLabels();
        $this->assertArrayHasKey('name', $labels);
        $this->assertArrayHasKey('frequency', $labels);
    }
}
