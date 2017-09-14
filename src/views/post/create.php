<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model zacksleo\yii2\cms\models\Post */

$this->title = '添加';
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
