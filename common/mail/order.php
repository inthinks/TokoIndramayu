<?php
/* @var $order common\models\Order */
use yii\helpers\Html;
?>

<h1>New order #<?= $order->id ?></h1>

<h2>Contact</h2>

<ul>
    <li>Phone: <?= Html::encode($order->phone) ?></li>
    <li>Email: <?= Html::encode($order->email) ?></li>
</ul>

<h2>Notes</h2>

<?= Html::encode($order->note) ?>

<h2>Items</h2>

<ul>
<?php
$sum = 0;
foreach ($order->orderDetail as $item): ?>
    <?php $sum += $item->quantity * $item->price ?>
    <li><?= Html::encode($item->product_id . ' x ' . $item->quantity . ' x ' . $item->price . '$') ?></li>
<?php endforeach ?>
</ul>

<p><string>Total: </string> <?php echo $sum?>$</p>

