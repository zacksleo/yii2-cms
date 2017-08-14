<?php

namespace tests;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;

/**
 * This is the base class for all yii framework unit tests.
 */
class TestCase extends \PHPUnit\Framework\TestCase
{
    protected function setUp()
    {
        parent::setUp();
        $this->mockApplication();

        $this->setupTestDbData();

        $this->createRuntimeFolder();
    }

    protected function tearDown()
    {
        $this->destroyApplication();
    }

    /**
     * Populates Yii::$app with a new application
     * The application will be destroyed on tearDown() automatically.
     *
     * @param array $config The application configuration, if needed
     * @param string $appClass name of the application class to create
     */
    protected function mockApplication($config = [], $appClass = '\yii\web\Application')
    {
        new $appClass(ArrayHelper::merge([
            'id' => 'testapp',
            'basePath' => __DIR__,
            'vendorPath' => $this->getVendorPath(),
            'components' => [
                'db' => [
                    'class' => 'yii\db\Connection',
                    'dsn' => 'sqlite::memory:',
                ],
                'request' => [
                    'hostInfo' => 'http://domain.com',
                    'scriptUrl' => 'index.php',
                ],
                'i18n' => [
                    'translations' => [
                        'zacksleo/yii2/cms/*' => [
                            'class' => 'yii\i18n\PhpMessageSource',
                            'basePath' => '@zacksleo/yii2/cms/messages',
                            'sourceLanguage' => 'en-US',
                            'fileMap' => [
                                'zacksleo/yii2/cms/cms' => 'cms.php',
                                'zacksleo/yii2/cms/tree' => 'tree.php',
                            ],
                        ]
                    ],
                ],
            ],
            'modules' => [
                'cms' => [
                    'class' => 'zacksleo\yii2\cms\Module',
                ],
                'treemanager' => [
                    'class' => '\kartik\tree\Module',
                ]
            ],
        ], $config));
    }

    /**
     * @return string vendor path
     */
    protected function getVendorPath()
    {
        return dirname(__DIR__) . '/vendor';
    }

    /**
     * Destroys application in Yii::$app by setting it to null.
     */
    protected function destroyApplication()
    {
        Yii::$app = null;
    }

    /**
     * Setup tables for test ActiveRecord
     */
    protected function setupTestDbData()
    {
        $db = Yii::$app->getDb();

        // Structure :

        $db->createCommand()->createTable('links', [
            'id' => 'pk',
            'category' => 'string',
            'name' => 'string not null',
            'description' => 'string',
            'url' => 'string not null',
            'logo' => 'string',
            'order' => 'smallint not null default 0',
            'createdAt' => 'integer not null',
            'updatedAt' => 'integer not null',
        ])->execute();

        $db->createCommand()->createTable('menu', [
            'id' => 'pk',
            'title' => 'string not null',
            'order' => 'smallint',
            'parent' => 'integer not null default 0',
            'url' => 'string not null',
        ])->execute();
        // Data :

        $db->createCommand()->batchInsert('menu', [
            'id', 'title', 'order', 'parent', 'url',
        ], [
            [
                'id' => 1,
                'title' => 'home',
                'order' => 1,
                'parent' => 0,
                'url' => 'https://lianluo.com',
            ],
            [
                'id' => 2,
                'title' => 'catalog',
                'order' => 1,
                'parent' => 1,
                'url' => 'https://lianluo.com',
            ], [
                'id' => 3,
                'title' => 'catalog2',
                'order' => 2,
                'parent' => 1,
                'url' => 'https://lianluo.com',
            ],
        ]);
    }

    /**
     * Create runtime folder
     */
    protected function createRuntimeFolder()
    {
        FileHelper::createDirectory(dirname(__DIR__) . '/tests/runtime');
    }
}
