<?php

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\models\Provinsi;

//use dosamigos\tinymce\TinyMce;
//https://github.com/2amigos/yii2-tinymce-widget/issues/1
//http://pixabay.com/zh/blog/posts/direct-image-uploads-in-tinymce-4-42/
//
?>
<div class="page-header-line">
    <h3>Profile</h3>
    <small>Silahkan update profile Anda!
        <label class="label label-info">username</label>, <label class="label label-success">fullname</label>, 
        <label class="label label-warning">hobby</label>, <label class="label label-danger">description about you</label> and the other's</small>
</div>
<hr/>

<div class="row">
    <div class="col-md-6">
        <?php echo $form->field($model, 'username')->textInput(['placeholder'=>'input your fullname']); ?>
        <?php echo $form->field($model, 'phone')->textInput(['placeholder'=>'input your phone']); ?>
        <?php echo $form->field($model, 'email')->textInput(['placeholder'=>'input your email']); ?>

    </div>
    <div class="col-md-6">
        <?php echo $form->field($model, 'province_id')->dropDownList(Provinsi::getOptions(), ['id'=>'provinsi_id', 'class'=>'input-large form-control']) ?>

    <?php echo $form->field($model, 'city_id')->widget(\kartik\depdrop\DepDrop::classname(), [
                                        'options'=>['id'=>'kota_id'],
                                        'pluginOptions'=>[
                                            'depends'=>['provinsi_id'],
                                            'placeholder'=>'Pilih kota',
                                            'url'=>Url::to(['site/kokab']),
                                            ],
                                        ]) ?>
    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>
    </div>
</div>