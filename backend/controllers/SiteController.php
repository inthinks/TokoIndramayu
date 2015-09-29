<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use common\models\ValueHelpers;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\helpers\Json;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','me'],
                        'allow' => true,
                        'roles' => ['member'],
                    ],
                    [
                        'actions' => [''],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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
        ];
    }

    public function actionIndex()
    {
        if(yii::$app->user->isGuest){
            $this->redirect['site/login'];
        }
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        /*$is_admin = ValueHelpers::getRoleValue('admin');
        if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id = $is_admin) {
            return $this->goHome();
        }*/

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && ($model->loginAdmin())) {
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

    /*public function actionChange_password() {
        Yii::$app->util->tab = 5;
        $user = Yii::$app->user->identity;
        $token = Yii::$app->security->generateRandomString() . '_' . time();
        //echo $token; exit(0);
        $user->password_reset_token = $token;
        $user->save();
        Yii::$app->util->member = $user;
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('_change_password', ['model' => $model, 'user' => $user]);
    }*/
    /*
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }*/

    public function actionKokab()
    {
      $out = [];
        if(isset($_POST['depdrop_parents'])){
          $parents = $_POST['depdrop_parents'];
          if($parents != null){
            $cat_id = $parents[0];
            $model = \frontend\models\Kota::find()->asArray()->where(['provinsi_id'=>$cat_id])->all();
            foreach ($model as $key => $value) {
              $out[] = ['id'=>$value['kota_id'], 'name'=>$value['kokab_nama']];
            }
            echo Json::encode(['output'=>$out,'selected'=>'']);
            return;
          }
        }
        echo Json::encode(['output'=>'','selected'=>'']);
    }
}
