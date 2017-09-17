<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use zacksleo\yii2\cms\models\Page;

/* @var $this yii\web\View */
/* @var $model zacksleo\yii2\cms\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->radioList(Page::getStatusList()) ?>

    <?= \nemmo\attachments\components\AttachmentsInput::widget([
        'id' => 'file-input', // Optional
        'model' => $model,
        'options' => [ // Options of the Kartik's FileInput widget
            'multiple' => false, // If you want to allow multiple upload, default to false
        ],
        'pluginOptions' => [ // Plugin options of the Kartik's FileInput widget
            'maxFileCount' => 1 // Client max files
        ]
    ]) ?>

    <?= $form->field($model, 'content')->widget('kucha\ueditor\UEditor', []); ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => $model->isNewRecord ? 'btn btn - success' : 'btn btn - primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
