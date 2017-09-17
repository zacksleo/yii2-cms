<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use zacksleo\yii2\cms\models\Post;
use kartik\tree\TreeViewInput;
use zacksleo\yii2\cms\models\PostCategory;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model zacksleo\yii2\cms\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin([
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <label class="control-label" for="post-title">分类</label>
        <?= TreeViewInput::widget([
            'query' => PostCategory::find()->addOrderBy('root, lft'),
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
    </div>
    <?= $form->field($model, 'tagValues[]')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\zacksleo\yii2\cms\models\Tag::findAll([]), 'name', 'name'),
        'language' => 'zh-CN',
        'options' => ['placeholder' => '请输入标签 ...'],
        'pluginOptions' => [
            'allowClear' => true,
            'tags' => true,
            'multiple' => true,
        ],
    ]);
    ?>
    <?= \nemmo\attachments\components\AttachmentsInput::widget([
        'id' => 'file-input', // Optional
        'model' => $model,
        'options' => [ // Options of the Kartik's FileInput widget
            'multiple' => true, // If you want to allow multiple upload, default to false
        ],
        'pluginOptions' => [ // Plugin options of the Kartik's FileInput widget
            'maxFileCount' => 10 // Client max files
        ]
    ]) ?>

    <?= $form->field($model, 'content')->widget('kucha\ueditor\UEditor', []); ?>

    <?= $form->field($model, 'active')->radioList(
        Post::getStatusList(), [
            'default' => 1
        ]
    ) ?>
    <?= $form->field($model, 'source')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'visits')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
