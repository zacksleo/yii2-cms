# yii2 cms

[![Latest Stable Version](https://poser.pugx.org/zacksleo/yii2-cms/version)](https://packagist.org/packages/zacksleo/yii2-cms)
[![Total Downloads](https://poser.pugx.org/zacksleo/yii2-cms/downloads)](https://packagist.org/packages/zacksleo/yii2-cms)
[![License](https://poser.pugx.org/zacksleo/yii2-cms/license)](https://packagist.org/packages/zacksleo/yii2-cms)
![](https://styleci.io/repos/81707082/shield?branch=master)
![](https://api.travis-ci.org/zacksleo/yii2-cms.svg?branch=master)
[![Code Climate](https://img.shields.io/codeclimate/github/zacksleo/yii2-cms.svg)]()

## Quick Start

### install by composer

```
   composer require zacksleo/yii2-cms
   
```
### migration

```

   yii migrate/up --migrationPath=@vendor/zacksleo/yii2-cms/migrations

```

### component

```

'component'=>[
        
    'user' => [
        'identityClass' => 'zacksleo\yii2\backend\models\Admin',
        'enableAutoLogin' => true,
        'loginUrl' => ['site/login'],
        'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true, 'path' => '/admin'],
    ],
    'cache' => [
        'class' => 'yii\caching\ApcCache',
        'useApcu' => true,
    ],
    'settings' => [
        'class' => 'pheme\settings\components\Settings',
    ],
    'plugin' => [
        'class' => 'zacksleo\yii2\plugin\components.HookRender'
    ],
    'authManager' => [
        'class' => 'yii\rbac\PhpManager',
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'admin/*'
        ]
    ]
]

```
