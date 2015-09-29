<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Category;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\PermissionHelpers;
use yii\helpers\Url;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
{
    public $layout = 'admins';
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    /*[   
                        'allow' => true,
                        'actions' => ['guest'],
                        'roles' => ['?']
                    ],*/
                    /*[   
                        'allow' => true,
                        'actions' => ['view', 'create', 'update'],
                        'roles' => ['customer']
                    ],*/
                    /*[   
                        'allow' => true,
                        'actions' => ['view', 'create', 'update','index','delete'],
                        'roles' => ['member']
                    ],*/
                    [   
                        'allow' => true,
                        'actions' => ['*'],
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
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        
        $dataProvider = new ActiveDataProvider([
            'query' => Category::find(),
        ]);
        if(PermissionHelpers::requireRole('admin')){
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);}
    } 

    /**
     * Displays a single Category model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(PermissionHelpers::userMustBeOwner('Category', $id)){
                return $this->render('view', [
                    'model' => $this->findModel($id),
                ]); } else {

                    throw new NotFoundHttpException("Error Processing Request", 1);
                    
            }
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category;
        $model->user_id = \Yii::$app->user->identity->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()){
            return Yii::$app->getResponse()->redirect(Url::to(['product/create']));/*, 'id'=>$model->id]);*/
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
        
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = Category::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
        if(PermissionHelpers::userMustBeOwner('category', $id)){
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
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
