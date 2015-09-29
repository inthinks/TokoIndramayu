<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Product;
use yii\base\DynamicModel;

/* @var $this yii\web\View */
/* @var $model frontend\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //$form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php //$form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'category_id')->dropDownList(Product::getCategoryList(),
                                                //['prompt'=>'Pilih Kategori']) ?>

    <?php // $form->field($model, 'stock')->textInput() ?>

    <?= $form->field($modelhitung, 'hargaAwal')->textInput() ?>

    <?= $form->field($modelhitung, 'hargaAkhir')->textInput() ?>

    <div class="form-group">
        <?php Html::submitButton($modelhitung, 'Simpan' , 'Ubah', ['class' => $modelhitung, 'btn btn-success' : 'btn btn-primary']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
