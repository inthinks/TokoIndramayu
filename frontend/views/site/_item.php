<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Markdown;

?>

            
            <div class="col-lg-3 col-lg-3">
            <ul class="thumbnail-list">
                        
                <li> <a href="<?php echo Url::to(['toko/detailproduk', 'id' => $model->id]);?>" class=""><img src="<?php echo $model->getUrl();?>" class="img-responsive img-thumbnail"</a>

                    <h4 class=""><?= Html::encode($model->title);
                                   // echo Markdown::process($model->description); ?> </h4>
                        <div class="product-price"><!--  <span class="cut-price">MYR290.00</span> -->
                            
                            <span class="normal-price">Rp.<?= number_format($model->price, 0, '', '.').',-'; ?></span>

                        </div>
                        <?= Html::a('Keranjangkan', ['cart/add', 'id' => $model->id], ['class' => 'btn btn-default navbar-btn'])?>
                </li>
            
            </ul>
            </div>
            