<?php

namespace tests;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\db\Schema;

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
                ],
                'attachments' => [
                    'class' => \nemmo\attachments\Module::className(),
                    'tempPath' => '@tests/data/uploads/temp',
                    'storePath' => '@tests/data/uploads/store',
                    'rules' => [ // Rules according to the FileValidator
                        'maxFiles' => 5, // Allow to upload maximum 3 files, default to 3
                        //'mimeTypes' => 'image/png, image/jpg', // Only png images
                        'extensions' => ['png', 'jpg', 'gif'],
                        'maxSize' => 600 * 1024 // 1 MB
                    ],
                    'tableName' => '{{%attachments}}' // Optional, default to 'attach_file'
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
        $db->createCommand()->createTable('item', [
            'id' => 'pk',
            'item_name' => 'string(125) not null',
            'subtitle' => 'string(125) not null',
            'categories' => 'string not null',
            'market_price' => 'decimal(10,2) not null default 0',
            'price' => 'integer not null default 0',
            'description' => 'text not null',
            'logo_image' => 'string not null',
            'status' => 'boolean not null default 1',
            'created_at' => 'integer not null',
            'updated_at' => 'integer not null',
        ])->execute();
        $db->createCommand()->createTable('item_field', [
            'item_id' => 'integer pk',
            'type' => 'string not null',
            'key' => 'string not null',
            'value' => 'text',
        ])->execute();
        $db->createCommand()->createTable('item_category', [
            'id' => 'pk',
            'root' => 'integer',
            'lft' => 'integer not null',
            'rgt' => 'integer not null',
            'lvl' => 'smallint not null',
            'name' => 'string(60) not null',
            'icon' => 'string(255)',
            'icon_type' => 'smallint not null default 1',
            'active' => 'boolean not null default true',
            'selected' => 'boolean not null default false',
            'disabled' => 'boolean not null default false',
            'readonly' => 'boolean not null default false',
            'visible' => 'boolean not null default true',
            'collapsed' => 'boolean not null default false',
            'movable_u' => 'boolean not null default true',
            'movable_d' => 'boolean not null default true',
            'movable_l' => 'boolean not null default true',
            'movable_r' => 'boolean not null default true',
            'removable' => 'boolean not null default true',
            'removable_all' => 'boolean not null default false',
        ])->execute();
        $db->createCommand()->createTable('links', [
            'id' => 'pk',
            'category' => 'string',
            'name' => 'string not null',
            'description' => 'string',
            'url' => 'string not null',
            'logo' => 'string',
            'order' => 'smallint not null default 0',
            'created_at' => 'integer not null',
            'updated_at' => 'integer not null',
        ])->execute();

        $db->createCommand()->createTable('menu', [
            'id' => 'pk',
            'title' => 'string not null',
            'order' => 'smallint',
            'parent' => 'integer not null default 0',
            'url' => 'string not null',
        ])->execute();
        $db->createCommand()->createTable('post', [
            'id' => 'pk',
            'title' => 'string not null',
            'image' => 'string',
            'content' => 'text not null',
            'active' => 'boolean not null',
            'source' => 'string',
            'visits' => 'smallint',
            'category_id' => 'integer',
            'categories' => 'string',
            'created_at' => 'integer not null',
            'updated_at' => 'integer not null',
        ])->execute();
        $db->createCommand()->createTable('post_category', [
            'id' => 'pk',
            'root' => 'integer',
            'lft' => 'integer not null',
            'rgt' => 'integer not null',
            'lvl' => 'smallint not null',
            'name' => 'string(60) not null',
            'icon' => 'string(255)',
            'icon_type' => 'smallint not null default 1',
            'active' => 'boolean not null default true',
            'selected' => 'boolean not null default false',
            'disabled' => 'boolean not null default false',
            'readonly' => 'boolean not null default false',
            'visible' => 'boolean not null default true',
            'collapsed' => 'boolean not null default false',
            'movable_u' => 'boolean not null default true',
            'movable_d' => 'boolean not null default true',
            'movable_l' => 'boolean not null default true',
            'movable_r' => 'boolean not null default true',
            'removable' => 'boolean not null default true',
            'removable_all' => 'boolean not null default false',
            'slug' => 'string default 1 not null',
        ])->execute();
        $db->createCommand()->createTable('attachments', [
            'id' => 'pk',
            'name' => 'string not null',
            'model' => 'string not null',
            'itemId' => 'integer not null',
            'hash' => 'string not null',
            'size' => 'integer not null',
            'type' => 'string not null',
            'mime' => 'string not null',
        ])->execute();
        // Data :

        $db->createCommand()->batchInsert('menu', [
            'id',
            'title',
            'order',
            'parent',
            'url',
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
            ],
            [
                'id' => 3,
                'title' => 'catalog2',
                'order' => 2,
                'parent' => 1,
                'url' => 'https://lianluo.com',
            ],
        ])->execute();

        $db->createCommand()->batchInsert('item_category', [
            'id',
            'root',
            'lft',
            'rgt',
            'lvl',
            'name',
        ], [
            [
                'id' => 1,
                'root' => 1,
                'lft' => 1,
                'rgt' => 4,
                'lvl' => 0,
                'name' => 'necessary'
            ],
            [
                'id' => 2,
                'root' => 2,
                'lft' => 1,
                'rgt' => 4,
                'lvl' => 0,
                'name' => 'beer'
            ],
            [
                'id' => 3,
                'root' => 3,
                'lft' => 1,
                'rgt' => 4,
                'lvl' => 0,
                'name' => 'food'
            ],
        ])->execute();
        $db->createCommand()->batchInsert('item', [
            'id',
            'item_name',
            'subtitle',
            'categories',
            'description',
            'logo_image',
            'created_at',
            'updated_at'
        ], [
            [
                'id' => 1,
                'item_name' => 'goods',
                'subtitle' => 'goods',
                'categories' => '1,2,3',
                'description' => 'goods',
                'logo_image' => 'logo.png',
                'created_at' => time(),
                'updated_at' => time(),
            ],
        ])->execute();

        $db->createCommand()->createTable('tag', [
            'id' => 'pk',
            'name' => 'string not null',
            'frequency' => 'integer not null',
        ])->execute();

        $db->createCommand()->createTable('page', [
            'id' => 'pk',
            'title' => 'string not null',
            'slug'=>'string not null',
            'status' => 'boolean default 1',
            'content' => 'text not null',
            'created_at' => 'integer not null',
            'updated_at' => 'integer not null',
        ])->execute();
    }

    /**
     * Create runtime folder
     */
    protected function createRuntimeFolder()
    {
        FileHelper::createDirectory(dirname(__DIR__) . '/tests/runtime');
    }
}
