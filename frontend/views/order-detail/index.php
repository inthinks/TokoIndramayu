<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\OrderDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Order Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-detail-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Order Detail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'order_code',
            [
                'attribute' => 'order_id',
                'label' => 'Pemesan',
                'value' => function($model, $index, $dataColumn) {
                    return $model->order->user->username; },
            ],
            [
                'attribute' => 'product_id',
                'label' => 'Nama Produk',
                'value' => function($model) {
                        return $model->product->title; },
            ],
            [
                'attribute' => 'toko_id',
                'label' => 'Toko',
                'value' => function($model) {
                    return $model->toko->nama_toko; },
            ],
            'email:email',
            'quantity',
            'price',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{delete}', 
            ],
        ],
    ]); ?>

</div>
<?php 
// $rc = new $dataProvider;
// echo "<pre>".print_r(get_class_methods($rc),true);
// echo \yii\helpers\VarDumper::dump($rc);

?>

