<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use zacksleo\yii2\cms\models\Item;

/* @var $this yii\web\View */
/* @var $model app\models\Item */

$this->title = $model->item_name;
$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCss('td img{max-width:640px;display:block;}');
?>
<div class="item-view">

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
            'item_name',
            [
                'attribute' => 'categories',
                'value' => function ($model) {
                    return $model->getItemCategoriesName();
                }
            ],
            'market_price',
            'price',
            'description:html',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return Item::getStatusList()[$model->status];
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
