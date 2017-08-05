<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\ItemCategory;
use vova07\imperavi\Widget as Imperavi;
use yii\helpers\Url;

$module = Yii::$app->getModule('pages');

$settings = [
    'minHeight' => 200,
    'plugins' => [
        'fullscreen',
    ],
];
if ($module->imperaviLanguage) {
    $settings['lang'] = $module->imperaviLanguage;
}
if ($module->addImage || $module->uploadImage) {
    $settings['plugins'][] = 'imagemanager';
}
if ($module->addImage) {
    $settings['imageManagerJson'] = Url::to(['images-get']);
}
if ($module->uploadImage) {
    $settings['imageUpload'] = Url::to(['image-upload']);
}
if ($module->addFile || $module->uploadFile) {
    $settings['plugins'][] = 'filemanager';
}
if ($module->addFile) {
    $settings['fileManagerJson'] = Url::to(['files-get']);
}
if ($module->uploadFile) {
    $settings['fileUpload'] = Url::to(['file-upload']);
}
/* @var $this yii\web\View */
/* @var $model app\models\Item */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'item_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(ItemCategory::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'market_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?php echo $form->field($model, 'description')->widget(Imperavi::className(), [
    'settings' => $settings,
    ]);?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
