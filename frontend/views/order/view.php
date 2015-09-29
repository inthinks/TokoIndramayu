<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model frontend\models\Order */

$this->title = $model->user->username;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

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
            'order_date',
            'address',
            'phone',
            'email:email',
            //'user_id',
            [
                'attribute'=>'user_id',
                'value'=>$model->user->username,
                /*'type'=>DetailView::INPUT_SELECT2, 
                'widgetOptions'=>[
                  'data'=>ArrayHelper::map(User::find()->orderBy('username')->asArray()->all(), 'id', 'username'),
                ]*/
            ],
            'bank_transfer',
            'payment_status',
            'note',
        ],
    ]) ?>

</div>
