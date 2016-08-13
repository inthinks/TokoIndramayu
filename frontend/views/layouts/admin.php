<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AdminAsset;
use frontend\widgets\Alert;
use yii\widgets\Menu;
use yii\helpers\Url;
use frontend\assets\FontAwesomeAsset;



// AppAsset::register($this);
AdminAsset::register($this);
// FontAwesomeAsset::register($this);
?>
<?php $this->beginPage() ?>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <?= Html::csrfMetaTags() ?>
    <title>Admin</title>
    </head>
<body>
<?php $this->beginBody() ?>
<div id="admin-body">
    <div class="container">
        <div class="wrapper">
            <div class="header">
            	 <div class="nav">
                    <a href="<?= Url::to(['/']) ?>" class="pull-left"><i class="glyphicon glyphicon-home"></i> Home</a>
                    <a href="<?= Url::to(['/admin/sign/out']) ?>" class="pull-right"><i class="glyphicon glyphicon-log-out"></i>Logout</a>
                </div>
			</div>
			<div class="main">
                <div class="box sidebar">
                	<a href="<?= Url::to(['/admin/settings']) ?>" class="menu-item">
                        <i class="glyphicon glyphicon-cog"></i>
                        Settings
                    </a>
              	</div>
            <div class="box content">
                    <div class="page-title">
                        <?= $this->title ?>
                    </div>
                    <div class="container-fluid">
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

