<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Toko */

$this->title = 'Update Toko: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tokos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="toko-update">

    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
