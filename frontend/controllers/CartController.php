<?php

namespace frontend\controllers;

use frontend\models\Order;
use common\models\User;
use common\models\ValueHelpers;
use frontend\models\OrderDetail;
use frontend\models\Product;
use yz\shoppingcart\ShoppingCart;
use common\models\PermissionHelpers;
use Yii;
use yii\helpers\Url;
use yii\filters\VerbFilter;

class CartController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [   
                        'allow' => true,
                        'actions' => ['add'],
                        'roles' => ['?']
                    ],
                    [   
                        'allow' => true,
                        'actions' => ['list','add','update','order','remove'],
                        'roles' => ['customer']
             
                    ],
                    /*[   
                        'allow' => true,
                        'actions' => ['view', 'create', 'update','delete','index'],
                        'roles' => ['member']
                    ],*/
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

    public function actionAdd($id)
    {
        $product = Product::findOne($id);
        if((!Yii::$app->user->isGuest) && PermissionHelpers::requireRole('customer')) {
            if ($product) {
                \Yii::$app->cart->put($product);
                return $this->goBack();
            }
        }
            return Yii::$app->getResponse()->redirect(Url::to(['site/login']));;
    }

    public function actionList()
    {
        /* @var $cart ShoppingCart */
        $cart = \Yii::$app->cart;

        $products = $cart->getPositions();
        $total = $cart->getCost();

        return $this->render('list', [
           'products' => $products,
           'total' => $total,
        ]);
    }

    public function actionRemove($id)
    {
        $product = Product::findOne($id);
        if ($product) {
            \Yii::$app->cart->remove($product);
            $this->redirect(['cart/list']);
        }
    }

    public function actionUpdate($id, $quantity)
    {
        $product = Product::findOne($id);
        if ($product) {
            \Yii::$app->cart->update($product, $quantity);
            $this->redirect(['cart/list']);
        }
    }

    public function actionOrder()
    {
        $order = new Order();
        $user =  User::find()->where(['id' => Yii::$app->user->identity->id])->one();

        /* @var $cart ShoppingCart */
        $cart = \Yii::$app->cart;

        /* @var $products Product[] */
        $products = $cart->getPositions();
        $total = $cart->getCost();

        $order->email = $user->email;
        $order->address = $user->address;
        $order->phone = $user->phone;
        $order->user_id = Yii::$app->user->identity->id;
        $order->order_code = $order->getCode() + 1;
        
        if ($order->load(\Yii::$app->request->post()) && $order->validate()) {
            $transaction = $order->getDb()->beginTransaction();
            $order->save(false);

            foreach($products as $product) {
                $OrderDetail = new OrderDetail();
                $OrderDetail->order_code = $order->getCode();
                $OrderDetail->order_id = $order->id;
                $OrderDetail->toko_id = $product->toko_id;  //ValueHelpers::getTokoId($product->id);
                $OrderDetail->product_id = $product->id;
                $OrderDetail->quantity = $product->getQuantity();
                $OrderDetail->price = $product->getPrice();
                $OrderDetail->email = $order->email;
                $order->toko_id = $product->toko_id;
                    $order->save(false);
                if (!$OrderDetail->save(false)) {

                    $transaction->rollBack();
                    \Yii::$app->session->addFlash('error', 'Order Gagal. Silahkan hubungi Admin.');
                    return Yii::$app->getResponse()->redirect(Url::to(['site/index']));
                }
            }

            $transaction->commit();
            \Yii::$app->cart->removeAll();

            \Yii::$app->session->addFlash('success', 'Terimakasih sudah Order. Kami akan menghubungi Anda segera!.');
            $order->sendEmail();

            return Yii::$app->getResponse()->redirect(Url::to(['site/index']));;
        }

        return $this->render('order', [
            'order' => $order,
            'products' => $products,
            'total' => $total,
        ]);
    }
}
