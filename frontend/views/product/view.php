<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Tambah Produk', ['product/create'], ['class' => 'btn btn-primary']) ?>
        <?php /*Html::a('Hapus', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger'],
            ['data' => 
                    ['confirm' => 'Do you want to delete this product?',
                    'method' => 'post',]
            
        ])*/ ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'title',
            'description:ntext',
            'price',
            'category.title',
            //'stock',      
            // 'image',
                [
                    'format' => 'raw',
                    'attribute' => 'image',
                    'value' => /*function ($model, $key, $index, $column) {
                    // * @var $model common\models\Image 
                    return Html::img($model->getUrl());
                  }  */ $model->image,
                ],
            ],
    ]) ?>

</div>
