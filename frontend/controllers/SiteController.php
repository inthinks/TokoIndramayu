<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use common\models\User;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use frontend\models\Toko;
use frontend\models\Category;
use frontend\models\Product;
use frontend\models\Image;
use yii\data\ActiveDataProvider;
use common\models\Auth;

/**
 * Site controller
 */
class SiteController extends Controller
{
     public $successUrl = '';
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup','test'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [   
                        'allow' => true,
                        'actions' => [ 'me'],
                        'roles' => ['customer']
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get','post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
                'successUrl'=>$this->successUrl,
            ],
        ];
    }

    /*public function successCallback($client)
    {
        $attributes = $client->getUserAttributes();
        // user login or signup comes here

        $user = \common\models\User::find()
        ->where(['email'=>$attributes['email'],])
        ->one();
    if(!empty($user)){
        Yii::$app->user->login($user);
    }
    else{
        //Simpen disession attribute user dari Google
        $session = Yii::$app->session;
        $session['attributes']=$attributes;
        // redirect ke form signup, dengan mengset nilai variabell global successUrl
        $this->successUrl = \yii\helpers\Url::to(['signup']);
        }  
    }*/
    public function onAuthSuccess($client)
    {
       $attributes = $client->getUserAttributes();
       
        $user = \common\models\User::find()
        ->where([
            'email'=>$attributes['email'],
        ])
        ->one();
    if(!empty($user)){
        Yii::$app->user->login($user);
    }
    else{
        //Simpen disession attribute user dari Google
        $session = Yii::$app->session;
        $session['attributes']=$attributes;
        // redirect ke form signup, dengan mengset nilai variabell global successUrl
        $this->successUrl = \yii\helpers\Url::to(['signup']);
    }   

        /** @var Auth $auth */
        /*$auth = Auth::find()->where([
            'source' => $client->getId(),
            'source_id' => $attributes['id'],
        ])->one();
        
        if (Yii::$app->user->isGuest) {
            if ($auth) { // login
                $user = $auth->user;
                Yii::$app->user->login($user);
            } else { // signup
                if (isset($attributes['email']) && isset($attributes['username']) && User::find()->where(['email' => $attributes['email']])->exists()) {
                    Yii::$app->getSession()->setFlash('error', [
                        Yii::t('app', "User with the same email as in {client} account already exists but isn't linked to it. Login using email first to link it.", ['client' => $client->getTitle()]),
                    ]);
                } else {
                    $password = Yii::$app->security->generateRandomString(6);
                    $user = new User([
                        'username' => $attributes['name'],
                        'email' => $attributes['email'],
                        'password' => $password,
                    ]);
                    $user->generateAuthKey();
                    $user->generatePasswordResetToken();
                    $transaction = $user->getDb()->beginTransaction();
                    if ($user->save()) {
                        $auth = new Auth([
                            'user_id' => $user->id,
                            'source' => $client->getId(),
                            'source_id' => (string)$attributes['id'],
                        ]);
                        if ($auth->save()) {
                            $transaction->commit();
                            Yii::$app->user->login($user);
                        } else {
                            print_r($auth->getErrors());
                        }
                    } else {
                        print_r($user->getErrors());
                    }
                }
            }
        } else { // user already logged in
            if (!$auth) { // add auth provider
                $auth = new Auth([
                    'user_id' => Yii::$app->user->id,
                    'source' => $client->getId(),
                    'source_id' => $attributes['id'],
                ]);
                $auth->save();
            }
        }*/
    }

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            Url::remember();
            return true;
        } else {
            return false;
        }
    }

    public function actionIndex($id = null)
    {
        $category = null;
        // $model = new Product();
        // $model->find()->all();
        $categories = Category::find()->indexBy('id')->orderBy('id')->all();
        $productsQuery = Product::find();
        if ($id !== null && isset($categories[$id])) {
            $category = $categories[$id];
            $productsQuery->where(['category_id' => $this->getCategoryIds($categories, $id)]);
        }

        $productsDataProvider = new ActiveDataProvider([
            'query' => $productsQuery,
            'pagination' => [
                'pageSize' => 8,
            ],
            'sort' => [
                'defaultOrder'=>['id' => SORT_ASC],
                ],
        ]);

        /*$rc = new Product();
        $r = get_class_methods($rc);*/

        return $this->render('index', [
            'category' => $category,
            'menuItems' => $this->getMenuItems($categories, isset($category->id) ? $category->id : null),
            'productsDataProvider' => $productsDataProvider,
            // 'model'=>$model,
            
        ]);
        // return $this->render('index');
    }

    private function getMenuItems($categories, $activeId = null)
    {
        $menuItems = [];
        foreach ($categories as $category) {
            if ($category->parent_id === null) {
                $menuItems[$category->id] = [
                    'active' => $activeId === $category->id,
                    'label' => $category->title,
                    'url' => ['site/index', 'id' => $category->id],
                ];
            } else {
                $this->placeCategory($category, $menuItems, $activeId);
            }
        }
        return $menuItems;
    }

    private function placeCategory($category, &$menuItems, $activeId = null)
    {
        foreach ($menuItems as $id => $navLink) {
            if ($category->parent_id === $id) {
                $menuItems[$id]['items'][$category->id] = [
                    'active' => $activeId === $category->id,
                    'label' => $category->title,
                    'url' => ['site/index', 'id' => $category->id],
                ];
                break;
            } elseif (!empty($menuItems[$id]['items'])) {
                $this->placeCategory($category, $menuItems[$id]['items']);
            }
        }
    }

    /**
     * Returns IDs of category and all its sub-categories
     *
     * @param Category[] $categories all categories
     * @param int $categoryId id of category to start search with
     * @param array $categoryIds
     * @return array $categoryIds
     */
    private function getCategoryIds($categories, $categoryId, &$categoryIds = [])
    {
        foreach ($categories as $category) {
            if ($category->id == $categoryId || $category->parent_id == $categoryId) {
                $categoryIds[] = $category->id;
            }
            if (isset($categories[$categoryId]['items'])) {
                foreach ($categories[$categoryId]['items'] as $subCategoryId => $subCategory)
                $this->getCategoryIds($categories, $subCategoryId, $categoryIds);
            }
        }
        return $categoryIds;
    }





    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSignup()
    {
        $model = new SignupForm();
                $session = Yii::$app->session;
            if (!empty($session['attributes'])){
                $model->username = $session['attributes']['first_name'];
                $model->email = $session['attributes']['email'];
            }
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    if(Yii::$app->user->identity->role_id==10){
                    //return //$this->goHome();
                        return Yii::$app->getResponse()->redirect(Url::to(['toko/create']));
                    } else {
                        return $this->goHome();
                    }
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    
    public function actionMe() {
        
        Yii::$app->util->tab = 5;
        $active = [];
        if ($sa=isset($_GET['tab'])){
            $_GET['tab'];
            }
            $tab = (int) $sa;     
            
        for ($i = 1; $i <= 3; $i++) {
            if ($i == $tab)
                $active[$i] = true;
            else
                $active[$i] = false;
        }
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }
        $user = Yii::$app->user->identity;
        Yii::$app->util->member = $user;

        $model = $user;
        $model->scenario = 'update';
        if ($model->loadWithFiles(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Well done! successfully to create data!  ');
        } else {

        }

        return $this->render('profile', [
                    'model' => $model,
                    'active' => $active
        ]);
    }

    public function actionTest(){
        $x=[1,4,5,2,6,3];
        rsort($x);
        $a = count($x);
        for ($b=0; $x<$a; $x++){
            return $x;
        }

    }

}

