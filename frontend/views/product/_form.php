<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Product;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model frontend\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true,
                                        'class'=>'number',
                                        'size'=>10
                                        ]) ?>

    <?= $form->field($model, 'category_id')->dropDownList(Product::getCategoryList(),
                                                ['prompt'=>'Pilih Kategori']) ?>


    <?=  $form->field($model, 'image')->fileInput() ?>    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
       $('input.number').keyup(function(event) {
       // skip for arrow keys
       if(event.which >= 37 && event.which <= 40) return;
       // format number
       $(this).val(function(index, value) {
             return value
            .replace(/\D/g, '')
            .replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            ;
       });
});
</script>