<?php

use yii\helpers\Html;
use zacksleo\yii2\cms\Module;

/* @var $this yii\web\View */
/* @var $model zacksleo\yii2\cms\models\Menu */

$this->title = Module::t('cms', 'Update {modelClass}: ', [
        'modelClass' => 'Menu',
    ]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Module::t('cms', 'Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Module::t('cms', 'Update');
?>
<div class="menu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
