<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use zacksleo\yii2\cms\Module;
use zacksleo\yii2\cms\models\Menu;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model zacksleo\yii2\cms\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'order')->textInput(['type' => 'number']) ?>

            <?= $form->field($model, 'parent')->dropDownList(ArrayHelper::map(Menu::findAll(['parent' => 0]), 'id', 'title'), ['prompt' => '---' . Module::t('cms', 'Select Data') . '---']); ?>

            <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Module::t('cms', 'Create') : Module::t('cms', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
