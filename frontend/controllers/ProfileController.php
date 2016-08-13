<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Profile;
use backend\models\search\Profile as ProfileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\ValueHelpers;
use common\models\RecordHelpers;
use common\models\PermissionHelpers;
use common\models\User;
use yii\helpers\Url;
use yii\web\UploadedFile;
use yii\helpers\Json;
/**
 * ProfileController implements the CRUD actions for Profile model.
 */
class ProfileController extends Controller
{
   
   public $layout = 'admins';
   
    public function behaviors()
    {
        return [
        'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [   
                        'allow' => true,
                        'actions' => ['guest'],
                        'roles' => ['?']
                    ],
                    [   
                        'allow' => true,
                        'actions' => [ 'createCustomer', 'update','kokab'],
                        'roles' => ['customer']
                    ],
                    [   
                        'allow' => true,
                        'actions' => ['view', 'create', 'update',''],
                        'roles' => ['member']
                    ],
                    [   
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => ['admin']
                    ],                    
                    [
                        'allow' => true,
                        'roles' => ['admin']
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
    
    /**
     * Lists all Profile models.
     * @return mixed
     */
    /*public function actionIndex()
    {
        $searchModel = new ProfileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }*/

    /**
     * Displays a single Profile model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(PermissionHelpers::userMustBeOwner('Profile', $id)){
            //if ($sudah_ada = RecordHelpers::userHas('profile')) {
            //if(Yii::$app->user->can('view-index')){
                return $this->render('view', [
                    'model' => $this->findModel($id),
                ]); } else {

                    throw new NotFoundHttpException("Error Processing Request", 1);
                    
                
            }
    }
    /**
     * Creates a new Profile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Profile();
        $user = User::find()->where(['id' => Yii::$app->user->identity->id])->one();
        $model->user_id = \Yii::$app->user->identity->id;
        $user->scenario = 'create';
        if ($already_exists = RecordHelpers::userHas('profile')) {
            return $this->redirect(['update', 'id' => $already_exists
                ]);}
         if ($model->load(Yii::$app->request->post())) {
             $model->image = UploadedFile::getInstance($model, 'image');
              $model->upload();
              
              $model->save(false);
              $user->address = $model->alamat;
              $user->city_id = $model->city_id;
              $user->province_id = $model->province_id;
              //$user->avatar = $model->image;  
              $user->name = $model->Pengelola;
              $user->phone = $model->phone;
              $user->save(false);


              Yii::$app->session->setFlash('success', 'Profil Anda Berhasil disimpan!  ');  
            // return Yii::$app->getResponse()->redirect(Url::to(['profile/profile']));
              return $this->redirect(['update', 'id' => $model->id
                ]);
          } else {

            return $this->render('create', [
                'model' => $model,
                'user' => $user,
            ]); }
        
        
    }

    /**
     * Updates an existing Profile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $user = User::find()->where(['id' => Yii::$app->user->identity->id])->one();
        $model = Profile::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
        $user->scenario = 'update';

        if(PermissionHelpers::userMustBeOwner('Profile',$id)){
            if ($model->load(Yii::$app->request->post())) {
          // if(Yii::$app->request->post()){  
              $model->image = UploadedFile::getInstance($model, 'image');
              if($model->upload()){
                Yii::$app->session->setFlash('success', 'Image!  ');
              } else {
                Yii::$app->session->setFlash('success', 'Image gagal!  ');
              }
              $model->save(false);
              $user->address = $model->alamat;
              $user->city_id = $model->city_id;
              $user->province_id = $model->province_id;
              $user->avatar = $model->image;  
              $user->name = $model->Pengelola;
              $user->phone = $model->phone;
              $user->save(false);
                 Yii::$app->session->setFlash('success', 'Profil Anda Berhasil disimpan!  ');
            }

            return $this->render('profile', [
                    'model' => $model,
                ]);
        }
        throw new NotFoundHttpException("Error Processing Request", 1);
    }
    

    /**
     * Deletes an existing Profile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    /*public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }*/

    /**
     * Finds the Profile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Profile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Profile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUser($id)
    {
           
        $model = Profile::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
        // $model->scenario = 'update';
        if(PermissionHelpers::userMustBeOwner('Profile', $id)){
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Well done! successfully to create data!  ');
            //return $this->redirect(['index', 'username' => $user->username]);
        } else {

//            return $this->render('profile', [
//                        'model' => $model,
//                        'active' => $active
//            ]);
        }

        return $this->render('profile', [
                    'model' => $model,
                    // 'active' => $active
        ]);
    }
    }

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
