<?php

use yii\helpers\Html;
use zacksleo\yii2\cms\models\Post;

/* @var $this yii\web\View */
/* @var $model zacksleo\yii2\cms\models\Post */

$this->title = '添加';
$this->params['breadcrumbs'][] = ['label' => '资讯', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$model->active = Post::STATUS_ACTIVE;
?>
<div class="post-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
