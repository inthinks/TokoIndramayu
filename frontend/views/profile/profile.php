<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;
use kartik\widgets\SwitchInput;
use yii\helpers\Url;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;
use frontend\models\Provinsi;



/**
 * @var yii\web\View $this
 * @var common\models\Blog $model
 */
$this->title = 'Settings ' . $model->Pengelola . ' - ' . $model->Pengelola;
$this->params['breadcrumbs'][] = ['label' => 'Update ', 'url' => ['profile/update']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="page-header" style="padding-left: 10px;">
            <h1><?= Html::encode($this->title) ?></h1>
            <small>Silahkan edit profile toko Anda!</small>
        </div>
    </div>
    <div class="panel-body">
        <?php
        $form = ActiveForm::begin([
                    'type' => ActiveForm::TYPE_VERTICAL,
                    'options' => ['enctype' => 'multipart/form-data']   // important, needed for file upload
        ]);
        ?>
        <div class="page-header-line">
    <h3>Profile Toko</h3>
    <small>Anda Dapat mengubah 
        <label class="label label-info">Nama Pengelola</label>,
        <label class="label label-warning">No. Telp</label>, <label class="label label-danger">Deskripsi Toko Anda</label> dan yang lainnya.</small>
        </div>
        <hr/>
        <div class="row">
    <div class="col-md-6">
        <?php echo $form->field($model, 'Pengelola')->textInput(['placeholder'=>'Username']); ?>
        <?php echo $form->field($model, 'phone')->textInput(['placeholder'=>'Telephone']); ?>
        <?php echo $form->field($model, 'province_id')->dropDownList(Provinsi::getOptions(), ['id'=>'provinsi_id', 'class'=>'input-large form-control']) ?>
        <?php if ($model->image === null){
            echo "Silahkan tambahkan foto Anda";
        } else { ?>
        <div>
            <div>
            <?php echo Html::img($model->getUrl(),['width' => '50%']);?>
            </div>
        </div>
        <?php } ?>
        <?= $form->field($model, 'image')->fileInput();?>
    </div>
    <div class="col-md-6">
        <?php echo $form->field($model, 'city_id')->widget(\kartik\depdrop\DepDrop::classname(), [
                                        'options'=>['id'=>'kota_id'],
                                        'pluginOptions'=>[
                                            'depends'=>['provinsi_id'],
                                            'placeholder'=>'Pilih kota',
                                            'url'=>Url::to(['/profile/kokab']),
                                            ],
                                        ]) ?>
        <?php echo $form->field($model, 'alamat')->textInput(['placeholder'=>'+62']); ?>
        <?php echo $form->field($model, 'description')->textArea(['placeholder'=>' email'],['rows' => 6]); ?>
    </div>
    
    </div>
        <hr/>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-9">
                <?=
                Html::submitButton('Update', ['class' => 'btn btn-primary btn-block']);
                // Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']); 
                ActiveForm::end();
                ?>
            </div>
        </div>

    </div>
</div>
</div>

<?php //echo "<pre>".print_r($model->getUrl(),true); ?>
