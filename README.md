# yii2-cms

> the Project is in development 
## 基于 Yii2 的 CMS 系统

- [x] yii2-cms
  - [x] Item & ItemCategory  产品和产品类别栏目
  - [x] Links  友情链接
  - [x] Menu   菜单 
  - [x] Post & Post Category 文章及文章栏目
- [x] yii2-backend  后台
  - [x] layout  布局
- [x] yii2-ad    广告
- [x] yii2-gallery  图库
- [ ] item-field  产品字段
- [x] 通用后台框架，默认使用 Metronic 主题
- [x] 插件模块
- [x] 使用 composer 管理依赖模块和多主题

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
