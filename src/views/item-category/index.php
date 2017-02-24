<?php
use zacksleo\yii2\cms\models\ItemCategory;

Yii::$app->getModule('treemanager')->treeViewSettings = [
    'nodeView' => '@vendor/zacksleo/yii2-cms/views/item-category/_form'
];
Yii::$app->getModule('treemanager')->init();

echo \kartik\tree\TreeView::widget([
    'query' => ItemCategory::find()->addOrderBy('root, lft'),
    'headingOptions' => ['label' => '商品类别'],
    'rootOptions' => ['label' => '<span class="text-primary">-</span>'],
    'fontAwesome' => true,
    'isAdmin' => true,
    'displayValue' => 1,
    'softDelete' => true,
    'cacheSettings' => ['enableCache' => true],
]);
?>
