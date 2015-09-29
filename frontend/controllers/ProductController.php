<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Product;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use common\models\RecordHelpers;
use common\models\ValueHelpers;
use common\models\Util;
use common\models\PermissionHelpers;
use yii\helpers\Url;
use yii\base\DynamicModel;
use yii\helpers\VarDumper;
use frontend\models\ProductSearch;
/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
                        'actions' => ['guest', 'hitung'],
                        'roles' => ['?']
                    ],
                    /*[   
                        'allow' => true,
                        'actions' => ['view', 'create', 'update'],
                        'roles' => ['customer']
             
                    ],*/
                    [   
                        'allow' => true,
                        'actions' => ['view', 'create', 'update','delete','index'],
                        'roles' => ['member']
                    ],
                    [   
                        'allow' => true,
                        'actions' => [''],
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find()->where(['user_id' => Yii::$app->user->identity->id]),
        ]);
        $searchModel = new ProductSearch();
        if(PermissionHelpers::harusPemilik('Product')){
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);}
        else {
            $this->redirect('create');
            // \Yii::$app->session->addFlash('success', 'Silahkan Tambahkan Produk Anda!');
           // throw new ForbiddenHttpException("Produk Kosong atau belum ditambahkan", 1);
            //echo Html::a('Tambah Product', ['create'], ['class' => 'btn btn-success']);
        }
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(PermissionHelpers::userMustBeOwner('Product', $id)){
            //if ($sudah_ada = RecordHelpers::userHas('profile')) {
                return $this->render('view', [
                    'model' => $this->findModel($id),
                ]);} 
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product;
        $model->toko_id = ValueHelpers::getTokoValue(Yii::$app->user->identity->id);
        if(PermissionHelpers::requireRole('member')){
        if ($model->load(Yii::$app->request->post())){ 
            $model->price = $model->convert_to_number($model->price);
            $model->user_id = \Yii::$app->user->identity->id;
            $model->upload();
            $model->image = \yii\web\UploadedFile::getInstance($model, 'image');

                

                    if($model->save(false)){
                     
                    return $this->redirect([
                            'view','id'=>$model->id]);
                    }
                }
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
    }
        
    

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $file = \yii\web\UploadedFile::getInstance($model, 'image');

        if(PermissionHelpers::userMustBeOwner('product', $id)){
            if ($model->load(Yii::$app->request->post())) {
                $model->image = \yii\web\UploadedFile::getInstance($model, 'image');

                $model->upload();

                    if($model->save(false)){
                     
                    return $this->redirect([
                            'view','id'=>$model->id]);
                    }
                }
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
              
        

        throw new ForbiddenHttpException;
    }

    public function convert_to_number($rupiah)
    {
        return intval(preg_replace('/,.*|[^0-9]/', '', $rupiah));
    }

    /**
     * Deletes an existing Product model.
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
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new ForbiddenHttpException('The requested page does not exist.');
        }
    }

    // in controller
public function actionCoba()
{
    $model = new DynamicModel([
        'nama', 'file_id'
        ]);
 
    // behavior untuk upload file
    $model->attachBehavior('upload', [
        'class' => 'mdm\upload\UploadBehavior',
        'attribute' => 'file',
        'savedAttribute' => 'file_id' // coresponding with $model->file_id
    ]);
 
    // rule untuk model
    $model->addRule('nama', 'string')
        ->addRule('file', 'file', ['extensions' => 'jpg']);
 
    if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        if ($model->saveUploadedFile() !== false) {
            Yii::$app->session->setFlash('success', 'Upload Sukses');
        }
    }
    return $this->render('upload',['model' => $model]);
}    
}
