<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use frontend\models\Provinsi;

/* @var $this yii\web\View */
/* @var $model frontend\models\Profile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Pengelola') ?>

    <?= $form->field($model, 'phone')->textInput() ?>

    <?php echo $form->field($model, 'province_id')->dropDownList(Provinsi::getOptions(), ['id'=>'provinsi_id', 'class'=>'input-large form-control']) ?>

    <?php echo $form->field($model, 'city_id')->widget(\kartik\depdrop\DepDrop::classname(), [
                                        'options'=>['id'=>'kota_id'],
                                        'pluginOptions'=>[
                                            'depends'=>['provinsi_id'],
                                            'placeholder'=>'Pilih kota',
                                            'url'=>Url::to(['/profile/kokab']),
                                            ],
                                        ]) ?>

    <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php //echo $form->field($model, 'image')->fileInput();?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
