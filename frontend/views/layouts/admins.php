<?php
use yii\helpers\Html;
use yii\helpers\Url;
use vendor\noumo\easyii\assets\AdminAsset;
use yii\bootstrap\Nav;
// use frontend\assets\AppAsset;

$asset = AdminAsset::register($this);
// AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= "Control Panel" ?> - <?= Html::encode($this->title) ?></title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <!-- <link rel="shortcut icon" href="<?= $asset->baseUrl ?>/favicon.ico" type="image/x-icon"> -->
    <!-- <link rel="icon" href="<?= $asset->baseUrl ?>/favicon.ico" type="image/x-icon"> -->
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div id="admin-body">
    <div class="container">
        <div class="wrapper">
            <div class="header">
                <div class="logo"> <!-- logo -->
                    <!-- <img src="<?= $asset->baseUrl ?>/img/logo_20.png"> -->
                    Control Panel
                </div>
                <div class="nav">
                    <a href="<?= Url::to(['/']) ?>" class="pull-left"><i class="glyphicon glyphicon-home"></i> <?= "Open Site" ?></a>
                    <a href="<?= Url::to(['/site/logout']) ?>" class="pull-right"><i class="glyphicon glyphicon-log-out"></i> <?= "logout" ?></a>
                </div>
            </div>
            <div class="main">
                <div class="box sidebar">
                    
                    <!-- <a href="<?= Url::to(['/Toko/index']) ?>" class="menu-item">
                        <i class="glyphicon glyphicon-cog"></i>
                        <?= "Toko" ?>
                    </a> -->
                    <?php //if(IS_ROOT) : ?>
                        <a href="<?= Url::to(['/profile/create']) ?>" class="menu-item">
                            <i class="glyphicon glyphicon-folder-close"></i>
                            <?= "Profil" ?>
                        </a>
                        <a href="<?= Url::to(['/product/index']) ?>" class="menu-item">
                            <i class="glyphicon glyphicon-user"></i>
                            <?= "Produk" ?>
                        </a>
                        <a href="<?= Url::to(['/order/index']) ?>" class="menu-item">
                            <i class="glyphicon glyphicon-hdd"></i>
                            <?= "Pesanan" ?>
                        </a>
                        <a href="<?= Url::to(['/order-detail/index']) ?>" class="menu-item">
                            <i class="glyphicon glyphicon-align-justify"></i>
                            <?= "Detail Pesanan" ?>
                        </a>
                    <?php //endif; ?>
                </div>
                <div class="box content">
                    <div class="page-title">
                        <?= $this->title ?>
                    </div>
                    <div class="container-fluid">
                        <?php //foreach(Yii::$app->session->getAllFlashes() as $key => $message) : ?>
                            <!-- <div class="alert alert-<?php //$key ?>"><?php //$message ?></div> -->
                        <?php //endforeach; ?>
                        <?= $content ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
