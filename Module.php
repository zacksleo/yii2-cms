<?php

namespace zacksleo\yii2\cms;

use yii\base\Module as BaseModule;

/**
 * portal module definition class
 */
class Module extends BaseModule
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'zacksleo\yii2\cms\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }

}
