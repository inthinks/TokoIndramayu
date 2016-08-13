<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Order;
use frontend\models\search\OrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\ValueHelpers;
use common\models\PermissionHelpers;
use yii\data\ActiveDataProvider;
use yii\web\ForbiddenHttpException;
/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
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
                        'actions' => [],
                        'roles' => ['customer']
                    ],
                    [   
                        'allow' => true,
                        'actions' => ['view', 'delete', 'update','index'],
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
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $order = Order::find()->where(['toko_id'=>ValueHelpers::getTokoValue(Yii::$app->user->identity->id)]);
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider = new ActiveDataProvider ([
            'query'=>$order,
            ]);
        if(PermissionHelpers::requireRole('member')){
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            //'dProvider' => $dProvider,
        ]);
        } else {
            throw new ForbiddenHttpException("Error Processing Request", 1);
            
        }
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $order = Order::find()->where(['id'=>$id])->one();
        if($order->toko_id == ValueHelpers::getTokoValue(Yii::$app->user->identity->id)){
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);} {
            throw new ForbiddenHttpException("Error Processing Request", 1);
            
        }
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*public function actionCreate()
    {
        $model = new Order();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }*/

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    /*public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }*/

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
       /* $order = Order::find()->where(['id'=>$id])->one();
        if($order->toko_id == ValueHelpers::getTokoValue(Yii::$app->user->identity->id)){*/
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
        /*} else {
            throw new ForbiddenHttpException("Error Processing Request", 1);
            
        }*/

    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
