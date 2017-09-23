<?php

use yii\helpers\Html;
use yii\grid\GridView;
use zacksleo\yii2\cms\Module;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('cms', 'Menus');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Module::t('cms', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            'order',
            [
                'attribute' => 'parent',
                'value' => function ($model) {
                    return $model->father->title;
                }
            ],
            'url:url',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
