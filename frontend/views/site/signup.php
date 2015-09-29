<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = 'Daftar';
$this->params['breadcrumbs'][] = $this->title;
$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];

$fieldOptions3 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-user form-control-feedback'></span>"
];
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Silahkan Isi Form Registrasi Anda:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?= $form->field($model, 'username', $fieldOptions3)
                                            ->textinput(['placeholder' => $model->getAttributeLabel('username')]) ?>
                <?= $form->field($model, 'email', $fieldOptions1)
                                            ->textinput(['placeholder' => $model->getAttributeLabel('email')]) ?>
                <?= $form->field($model, 'user')->dropDownList(common\models\User::$roles,
                                                ['prompt' => '']) ?>
                <?= $form->field($model, 'password', $fieldOptions2)
                                            //->label(false)
                                            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>
                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

