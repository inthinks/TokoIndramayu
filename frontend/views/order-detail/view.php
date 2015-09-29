<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\OrderDetail */

$this->title = $model->order->user->username;
$this->params['breadcrumbs'][] = ['label' => 'Order Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-detail-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php //Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'order_code',
            [
                'attribute' => 'order_id',
                'value' =>  $model->order->user->username,
            ],
            [
                'attribute' => 'product_id',
                'value' =>  $model->product->title,
            ],
            [
                'attribute' => 'toko_id',
                'value' =>  $model->toko->nama_toko,
            ],
            'email:email',
            'quantity',
            //'price',
            [
                'attribute' => 'price',
                'value' =>  "Rp.".number_format($model->price, 0, '', '.').',-',
            ],
            
        ],
    ]) ?>

</div>
