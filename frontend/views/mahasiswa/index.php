<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mahasiswas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mahasiswa-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Mahasiswa', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nama',
            'nim',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php $form = \yii\widgets\ActiveForm::begin([
        'options' => [
            'enctype'=> 'multipart/form-data',
        ],
        'action' => ['import'],
        'action'=>['export'],
    ]) ?>
    <?= $form->field($modelImport,'fileImport')->fileInput() ?>
    <?= Html::a('Export Excel', ['export-excel'], ['class'=>'btn btn-info']); ?>  
    <?= Html::a('Export Excel2', ['export-excel2'], ['class'=>'btn btn-info']); ?>  
    <?= Html::a('Export pdf', ['export-pdf'], ['class'=>'btn btn-info']); ?> 

    <?= Html::submitButton('Import',['class'=>'btn btn-primary']) ?>
    <?php \yii\widgets\ActiveForm::end() ?>
<!-- EXAMPLE FORM IMPORT -->
</div>



