<?php

use yii\helpers\Html;
use kartik\tree\TreeViewInput;
use yii\widgets\ActiveForm;
use zacksleo\yii2\cms\models\ItemCategory;
use yii\helpers\Url;
use zacksleo\yii2\cms\models\Item;

/* @var $this yii\web\View */
/* @var $model zacksleo\yii2\cms\models\Item */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'item_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subtitle')->textInput(['maxlength' => true]) ?>

    <?= TreeViewInput::widget([
        'query' => ItemCategory::find()->addOrderBy('root, lft'),
        'headingOptions' => ['label' => '类别'],
        'name' => $model->formName() . '[categories]',    // input name
        'value' => $model->categories,
        'asDropdown' => true,            // will render the tree input widget as a dropdown.
        'multiple' => true,            // set to false if you do not need multiple selection
        'fontAwesome' => true,            // render font awesome icons
        'rootOptions' => [
            'label' => '<i class="fa fa-tree"></i>',
            'class' => 'text-success'
        ],                                      // custom root label
    ]);
    ?>

    <?= $form->field($model, 'market_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'description')->widget('kucha\ueditor\UEditor', []); ?>

    <?= $form->field($model, 'status')->textInput()->radioList(
        Item::getStatusList(), [
            'default' => 1
        ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
