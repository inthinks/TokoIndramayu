<?php

namespace frontend\models;

use Yii;
/*use frontend\models\Toko;
use frontend\models\Order;
use frontend\models\Product;*/


/**
 * This is the model class for table "order_detail".
 *
 * @property integer $id
 * @property string $order_code
 * @property integer $order_id
 * @property integer $product_id
 * @property integer $qty
 * @property integer $subtotal
 */
class OrderDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['quantity'], 'number'],
            [['product_id', 'toko_id'], 'integer'],
            // [['product_id','toko_id'], 'safe'],
            /*[['toko_id'], 'integer'],
            [['toko_id'], 'safe'],*/
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_code' => 'Kode Order',
            'order_id' => 'Order ID',
            'toko_id' => 'Toko ID',
            'product_id' => 'Product ID',
            'quantity' => 'Quantity',
            'price' => 'Harga',
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    public function getToko()
    {
        return $this->hasOne(Toko::className(), ['id' => 'toko_id']);
    }

    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }
}
