<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use yii\widgets\Menu;
use yii\helpers\Url;
use common\models\PermissionHelpers;
use frontend\assets\FontAwesomeAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
FontAwesomeAsset::register($this);

if (Yii::$app->controller->action->id === 'login') { 
    
            NavBar::begin([
                'brandLabel' => '<i class="fa fa-home"></i>',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
           
            $menuItems = [
                // ['label' => 'Home', 'url' => ['/site/index']],
                // ['label' => 'About', 'url' => ['/site/about']],
                // ['label' => 'Contact', 'url' => ['/site/contact']],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
                $menuItems[] = [
                    'label' => 'logout ('. Yii::$app->user->identity->username.')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => '<span class="glyphicon glyphicon-home"></span> TokoIndramayu',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $itemsInCart = Yii::$app->cart->getCount();
            $menuItems = [
                // ['label' => 'Home', 'url' => ['/site/index']],
                // ['label' => 'About', 'url' => ['/site/about']],
                // ['label' => 'Contact', 'url' => ['/site/contact']],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
                if(PermissionHelpers::requireRole('customer')){
                $menuItems[] =
                [
                    'label' => '<span class="glyphicon glyphicon-user"></span> Profile',
                    'url' => ['/site/me', 'id'=>Yii::$app->user->identity->id],
                    'linkOptions' => ['data-method' => 'post']
                ];
                $menuItems[] =
                [
                    'label'=>'<i class="glyphicon glyphicon-shopping-cart"></i> Keranjang' . ($itemsInCart ? " ($itemsInCart)" : ''),
                    'url'=>['cart/list'],
                    'linkOptions' => ['data-method' => 'post']
                    //'icon'=> 'glyphicon glyphicon-shopping-cart',
                    // 'options' => [
                    //     'class' => 
                    //             ],
                ];}
                if(PermissionHelpers::requireRole('member')){
                $menuItems[] = [
                    'label' => 'Control panel',
                    'url' => ['/profile/create'],//, 'id'=>Yii::$app->user->identity->id],
                    'linkOptions' => ['data-method' => 'post']
                ];}
                $menuItems[] = [
                    'label' => '<span class="glyphicon glyphicon-log-out"></span> Logout ('. Yii::$app->user->identity->username.')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'encodeLabels'=>false,
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>
        
        <div class="container">
        <?php if (!(Yii::$app->controller->action->id === 'login' or Yii::$app->controller->action->id === 'signup')){ 
                    if((Yii::$app->user->isGuest) or PermissionHelpers::requireRole('customer')) { ?>
        <header>
        <!-- <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-menu">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?= Url::home() ?>"><i class="fa fa-home"></i></a>
                </div>
 -->
                <!-- <div class="collapse navbar-collapse" id="navbar-menu"> -->
                    <?php //Menu::widget([
                        /*'options' => ['class' => 'nav navbar-nav'],
                        'items' => [
                            // ['label' => 'Home', 'url' => ['site/index']],
                            ['label' => 'Shop', 'url' => ['shop/index']],
                            ['label' => 'News', 'url' => ['news/index']],
                            ['label' => 'Articles', 'url' => ['articles/index']],
                            ['label' => 'Gallery', 'url' => ['gallery/index']],
                            ['label' => 'Guestbook', 'url' => ['guestbook/index']],
                            ['label' => 'FAQ', 'url' => ['faq/index']],
                            ['label' => 'Contact', 'url' => ['/contact/index']],
                        ],
                    ]); */?>
                    <!-- ['label' => 'My cart' . ($itemsInCart ? " ($itemsInCart)" : ''), 'url' => ['/cart/list']], -->
                    <?php //$itemsInCart = Yii::$app->cart->getCount() ?>
                    <!-- <div class="navbar-fixed-top"> -->
                    <!-- <a href="<?php
                    //if(!(Yii::$app->user->isGuest) && PermissionHelpers::requireRole('customer')){
                    //echo Url::to(['cart/list']);
                    // } else { //echo Url::to(['site/login']);} ?>" class="btn btn-default navbar-btn navbar-right" title="Complete order">
                        <i class="glyphicon glyphicon-shopping-cart"></i>
                    <?php //'My cart' . ($itemsInCart ? " ($itemsInCart)" : '') ?>
                    </a>
                    </div> -->
                <!-- </div> -->
            <!-- </div>
        </nav> -->
    </header>
    <?php } }?>

    <main>
        <?php if($this->context->id != 'site') : ?>
            <br/>
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ])?>
        <?php endif; ?>
        <?= Alert::widget() ?>
        <?= $content ?>
        <div class="push"></div>
    </main>
    </div>
</div>

    <footer class="footer  nav-navbar-default">
        <div class="container">
        <p class="pull-left">&copy; Inthinks Company <?= date('Y') ?><br /><?php if(Yii::$app->user->isGuest){
           echo Html::a('Admin', 'http://admin.tokoindramayu.co.id');} ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<?php } ?>
