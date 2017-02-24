<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use zacksleo\yii2\cms\Module;

/* @var $this yii\web\View */
/* @var $model zacksleo\yii2\cms\models\links */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="links-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'category')->textInput() ?>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'url')->textInput(['maxlength' => true, 'type' => 'url']) ?>
            <?= $form->field($model, 'logo')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'order')->textInput(['type' => 'number']) ?>
        </div>
    </div>
</div>
<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? Module::t('cms', 'Create') : Module::t('cms', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>
</div>
