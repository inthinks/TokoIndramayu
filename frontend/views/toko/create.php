<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Toko */

$this->title = 'Buat Toko';
$this->params['breadcrumbs'][] = ['label' => 'Toko', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="toko-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
