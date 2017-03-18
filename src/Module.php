<?php

namespace zacksleo\yii2\cms;

use yii;
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
        $this->registerTranslations();
    }

    /**
     * Registers the translation files
     */
    protected function registerTranslations()
    {
        Yii::$app->i18n->translations['zacksleo/yii2/cms/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@zacksleo/yii2/cms/messages',
            'fileMap' => [
                'zacksleo/yii2/cms/cms' => 'cms.php',
                'zacksleo/yii2/cms/tree' => 'tree.php',
            ],
        ];
    }

    /**
     * Translates a message. This is just a wrapper of Yii::t
     *
     * @see Yii::t
     *
     * @param $category
     * @param $message
     * @param array $params
     * @param null $language
     * @return string
     */
    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('zacksleo/yii2/cms/' . $category, $message, $params, $language);
    }
}
