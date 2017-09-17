<?php

use yii\helpers\Html;
use zacksleo\yii2\cms\models\Page;

/* @var $this yii\web\View */
/* @var $model zacksleo\yii2\cms\models\Page */

$this->title = '添加';
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$model->status = Page::STATUS_ACTIVE;
?>
<div class="page-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
