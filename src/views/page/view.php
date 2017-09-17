<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use zacksleo\yii2\cms\models\Page;

/* @var $this yii\web\View */
/* @var $model zacksleo\yii2\cms\models\Page */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-view">

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'slug',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return Page::getStatusList()[$model->status];
                }
            ],
            'content:html',
            'created_at:date',
            'updated_at:date',
        ],
    ]) ?>

</div>
