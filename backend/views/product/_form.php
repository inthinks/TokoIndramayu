<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;
use kartik\widgets\FileInput;
use kartik\widgets\SwitchInput;
use mihaildev\ckeditor\CKEditor;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php     $form = ActiveForm::begin([
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'options' => ['enctype' => 'multipart/form-data']   // important, needed for file upload
    ]);?>


            <div class="row">
        <div class="col-md-6">
        <?= $form->field($model, "description")->widget(CKEditor::className(), ["editorOptions" => [ "preset" => "full", "inline" => false]]);?>
            <?= $form->field($model, 'category_id')->textInput() ?>

            <?= $form->field($model, 'user_id')->textInput() ?>
        </div>

        <div class="col-md-6">
        
            <?= $form->field($model, 'title')->textInput(['maxlength' => 50]) ?>

            <?= $form->field($model, 'price')->textInput(['maxlength' => 18]) ?>

            <?= $form->field($model, 'stock')->textInput() ?>
        </div>

    </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

        <?php ActiveForm::end(); ?>

</div>
