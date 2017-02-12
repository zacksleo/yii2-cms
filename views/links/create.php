<?php

use yii\helpers\Html;
use zacksleo\yii2\cms\Module;

/* @var $this yii\web\View */
/* @var $model zacksleo\yii2\cms\models\links */

$this->title = Module::t('links', 'Create');
$this->params['breadcrumbs'][] = ['label' => Module::t('links', 'Links'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="links-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
