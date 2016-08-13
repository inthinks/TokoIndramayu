<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tokos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="toko-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Toko', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'nama_toko',
            'production_id',
            'profile_id',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
