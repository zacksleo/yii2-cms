<?php
use zacksleo\yii2\cms\models\PostCategory;

Yii::$app->getModule('treemanager')->treeViewSettings = [
    'nodeView' => '@vendor/zacksleo/yii2-cms/views/post-category/_form'
];
Yii::$app->getModule('treemanager')->init();

echo \kartik\tree\TreeView::widget([
    'query' => PostCategory::find()->addOrderBy('root, lft'),
    'headingOptions' => ['label' => '文章类别'],
    'rootOptions' => ['label' => '<span class="text-primary">-</span>'],
    'fontAwesome' => true,
    'isAdmin' => true,
    'displayValue' => 1,
    'softDelete' => true,
    'cacheSettings' => ['enableCache' => true],
]);
