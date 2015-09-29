<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Toko */

$this->title = 'Create Toko';
$this->params['breadcrumbs'][] = ['label' => 'Tokos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="toko-create">

    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
