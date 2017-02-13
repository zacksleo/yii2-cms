<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use zacksleo\yii2\cms\Module;

/* @var $this yii\web\View */
/* @var $model zacksleo\yii2\cms\models\Menu */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Module::t('cms', 'Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Module::t('cms', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Module::t('cms', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Module::t('cms', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'order',
            'parent',
            'url:url',
        ],
    ]) ?>

</div>
