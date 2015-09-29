<?php

namespace frontend\controllers;

use Yii;
use frontend\models\contact;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\RecordHelpers;
/**
 * ContactController implements the CRUD actions for contact model.
 */
class ContactController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    /*[   
                        'allow' => true,
                        'actions' => ['view', 'create', 'update'],
                        'roles' => ['customer']
                    ],*/
                    [   
                        'allow' => true,
                        'actions' => ['view', 'create', 'update'],
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
     * Lists all contact models.
     * @return mixed
     */
    /*public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => contact::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }*/

    /**
     * Displays a single contact model.
     * @param integer $id
     * @return mixed
     */
     public function actionView($id)
    {
        if(PermissionHelpers::userMustBeOwner('contact', $id)){
            //if ($sudah_ada = RecordHelpers::userHas('profile')) {
            //if(Yii::$app->user->can('view-index')){
                return $this->render('view', [
                    'model' => $this->findModel($id),
                ]); } else {

                    throw new NotFoundHttpException("Error Processing Request", 1);                    
            }
    }

    /**
     * Creates a new contact model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Contact;
        //$model->user_id = \Yii::$app->user->identity->id;
        if ($already_exists = RecordHelpers::userHas('contact')) {
            return $this->render('view', ['model' => $this->findModel($already_exists),
            ]);
        } elseif ($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->redirect(['view', 'id'=>$model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
        
    }

    /**
     * Updates an existing contact model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = Contact::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
        if(PermissionHelpers::userMustBeOwner('Contact', $id)){
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
     * Deletes an existing contact model.
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
     * Finds the contact model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return contact the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = contact::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
