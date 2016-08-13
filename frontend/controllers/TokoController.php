<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Toko;
use frontend\models\Profile;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use common\models\PermissionHelpers;
use common\models\RecordHelpers;
use common\models\ValueHelpers;
use yii\helpers\Url;
/**
 * TokoController implements the CRUD actions for Toko model.
 */
class TokoController extends Controller
{
    // public $layout = 'admins';
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [   
                        'allow' => true,
                        'actions' => ['guest','detailproduk','index'],
                        'roles' => ['?']
                    ],
                    [   
                        'allow' => true,
                        'actions' => ['index','detailproduk'],
                        'roles' => ['customer']
                    ],
                    [   
                        'allow' => true,
                        'actions' => ['view', 'create', 'update',],
                        'roles' => ['member']
                    ],
                    [   
                        'allow' => true,
                        'actions' => ['delete','index'],
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
     * Lists all Toko models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $product = new \frontend\models\Product;
        $productQuery = $product->find()->where(['toko_id' => $id]);
        $toko = new Toko();
        $profile = Profile::find()->where(['user_id'=>ValueHelpers::getTokoId($id)])->one();
        $user = \common\models\User::find()->where(['id'=>ValueHelpers::getTokoId($id)])->one();
        $productDataProvider = new ActiveDataProvider([
            'query' => $productQuery,
            'pagination' => [
                'pageSize' => 8,
            ],
            'sort' => [
                        'defaultOrder'=>['id' => SORT_DESC],
                        ],
        ]);

        return $this->render('profile', [
            'productDataProvider' => $productDataProvider,
            'profile' => $profile,
            'user' => $user,
            'toko' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single Toko model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(PermissionHelpers::userMustBeOwner('Toko', $id)){
            //if ($sudah_ada = RecordHelpers::userHas('profile')) {
            //if(Yii::$app->user->can('view-index')){
                return $this->render('view', [
                    'model' => $this->findModel($id),
                ]); } else {

                    throw new NotFoundHttpException("Error Processing Request", 1);
                    
                
            }
    }

    /**
     * Creates a new Toko model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Toko;
        //$model->production_id = $model->getProductId();
        //$model->product_id = $model->getProductId();
        //$model->profile_id = $model->getProfileId();
        $model->user_id = \Yii::$app->user->identity->id;
        if ($already_exists = RecordHelpers::userHas('toko')) {
            return $this->render('view', ['model' => $this->findModel($already_exists),
            ]);
        } elseif ($model->load(Yii::$app->request->post()) && $model->save()){
            return Yii::$app->getResponse()->redirect(Url::to(['profile/create']));
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
        
    }

    /**
     * Updates an existing Toko model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = Toko::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
        if(PermissionHelpers::userMustBeOwner('Toko', $id)){
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
              
        }
        throw new NotFoundHttpException("Error Processing Request", 1);
    }

    /**
     * Deletes an existing Toko model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    /*public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
*/
    /**
     * Finds the Toko model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Toko the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Toko::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDetailproduk($id)
    {
        $product = new \frontend\models\Product();
        $product1 = \frontend\models\Product::find()->where(['id'=> $id])->one();
        $productQuery = $product->find()->where(['toko_id' => ValueHelpers::getProduct($id)]);
        $profile = Profile::find()->where(['user_id'=>ValueHelpers::getProfile($id)])->one();
        $user = \common\models\User::find()->where(['id'=>ValueHelpers::getProfile($id)])->one();
        $toko = Toko::find()->where(['id' => ValueHelpers::getProduct($id)])->one();
        $productDataProvider = new ActiveDataProvider([
            'query' => $productQuery,
            'pagination' => [
                'pageSize' => 8,
            ],
            'sort' => [
                        'defaultOrder'=>['id' => SORT_DESC],
                        ],
        ]);

        return $this->render('detailproduk', [
                                'productDataProvider' => $productDataProvider,
                                'product' => $product->id[$id],
                                'product1' => $product1,
                                'toko' => $toko,
                                'user' => $user,
                                'profile' => $profile]);
    }
}
