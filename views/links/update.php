<?php

use yii\helpers\Html;
use zacksleo\yii2\cms\Module;

/* @var $this yii\web\View */
/* @var $model zacksleo\yii2\cms\models\links */

$this->title = Module::t('links', 'Update', [
        'modelClass' => 'Links',
    ]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('links', 'Links'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('links', 'Update');
?>
<div class="links-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
