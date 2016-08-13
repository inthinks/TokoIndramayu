<?php
use yii\bootstrap\Nav;
//  use common\models\User;

?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= yii::$app->user->identity->thumbnailTrue ?>" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?php echo Yii::$app->user->identity->username; ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <hr />

        <!-- search form -->
        <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form> -->
        <!-- /.search form -->

        <?=
        Nav::widget(
            [
                'encodeLabels' => false,
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    /*'<li class="header">Menu Yii2</li>',*/
                    ['label' => '<span class="fa fa-file-code-o"></span> Gii', 'url' => ['/gii']],
                    ['label' => '<span class="fa fa-dashboard"></span> Debug', 'url' => ['/debug']],
                    [
                        'label' => '<span class="glyphicon glyphicon-lock"></span> Sing in', //for basic
                        'url' => ['/site/login'],
                        'visible' =>Yii::$app->user->isGuest
                    ],
                ],
            ]
        );
        ?>

        <ul class="sidebar-menu">
           

                    <li><a href="<?= \yii\helpers\Url::to(['/user/index']) ?>"><span class="fa fa-file-code-o"></span> User</a>
                    </li>
                    <li><a href="<?= \yii\helpers\Url::to(['/toko/index']) ?>"><span class="fa fa-file-code-o"></span> Toko</a>
                    </li>
                    <li><a href="<?= \yii\helpers\Url::to(['/profile/index']) ?>"><span class="fa fa-dashboard"></span> Profile</a>
                    </li>
                    <li><a href="<?= \yii\helpers\Url::to(['/product/index']) ?>"><span class="fa fa-dashboard"></span> Product</a>
                    </li>
                    <li><a href="<?= \yii\helpers\Url::to(['/category/index']) ?>"><span class="fa fa-dashboard"></span> Category</a>
                    </li>
                    <li><a href="<?= \yii\helpers\Url::to(['/order/index']) ?>"><span class="fa fa-dashboard"></span> Pesanan</a>
                    </li>
                    <li><a href="<?= \yii\helpers\Url::to(['/order-detail/index']) ?>"><span class="fa fa-dashboard"></span> Detail Pesan</a>
                    </li>
                    <li><a href="<?= \yii\helpers\Url::to(['/role/index']) ?>"><span class="fa fa-file-code-o"></span> Role</a>
                    </li>
                    <li><a href="<?= \yii\helpers\Url::to(['/user-type/index']) ?>"><span class="fa fa-file-code-o"></span> User Type</a>
                    </li>
                    <li><a href="<?= \yii\helpers\Url::to(['/status/index']) ?>"><span class="fa fa-file-code-o"></span> Status</a>
                    </li>
                    <li>
                
        </ul>

    </section>

</aside>
