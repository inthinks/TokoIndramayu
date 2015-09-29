<?php

use kartik\sidenav\SideNav;
use yii\helpers\Html;
use dosamigos\gallery\Carousel;
use yii\web\JsExpression;
use common\models\helper;
use frontend\models\Product;
use yii\data\ActiveDataProvider;
use yii\widgets\Menu;
use yii\widgets\ListView;

/* @var $this yii\web\View */
$this->title = 'Toko Indramayu';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-md-13">
               
                    <div class="col-md-2">
                      <?= SideNav::widget([
                            'type'=> SideNav::TYPE_DEFAULT,
                            'heading'=> 'Kategori',
                            'items' => $menuItems,
                      ]) ?>
                    </div>        
               
            <div class="col-md-7">
               <?php $items = [
    [
        'url' => Product::getLink('keranjang'),
        'src' => Product::getLink('keranjang'),
    ],
    [
        'url' => Product::getLink('jubol'),
        'src' => Product::getLink('jubol'),
    ],
    [
        'url' => Product::getLink('jb'),
        'src' => Product::getLink('jb'),
    ],
    
];?>
<?= dosamigos\gallery\Carousel::widget(['items' => $items,
                                        ]);?>
            </div>
            <div class="col-md-3">
            <?php
                 echo SideNav::widget([
                    'type' => SideNav::TYPE_DEFAULT,
                    'heading' => 'Toko',
                    'items' =>
                    helper::item(), 
                ]);
            ?>   
            </div>
            </div>
        </div>
        <hr/>
        <div class="container">
        <div class="row">
        <center><h3>Produk Terbaru</h3></center>
        <div class="col-md-13 col-md-13">
        <?php echo ListView::widget( [
            'dataProvider' => $productsDataProvider,
            'itemView' => '_item',
        ] ); ?>
        
        </div>
        </div>
        </div>
    </div>


        </div>

    </div>

    <hr/>

</div>

