<?php

namespace tests\models;

use tests\TestCase;
use zacksleo\yii2\cms\models\Page;

class PageTest extends TestCase
{
    public function testSave()
    {
        $model = new Page();
        $model->title = 'page title';
        $model->content = 'content';
        $model->slug = 'about';
        $model->status = 1;
        $this->assertTrue($model->save());
    }

    public function testGetStatusList()
    {
        $list = Page::getStatusList();
        $this->assertEquals($list[0], '隐藏');
    }

    public function testGetUrl()
    {
        $model = new Page();
        $model->slug = 'about';
        $this->assertContains('page/view?slug=about', $model->url);
    }
}
