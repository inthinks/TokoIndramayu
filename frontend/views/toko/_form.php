<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Toko;

/* @var $this yii\web\View */
/* @var $model frontend\models\Toko */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="toko-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_toko')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'production_id')->dropDownList(Toko::getproductionList(),
    														 ['prompt'=>'Silahkan Pilih salah satu']) ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
