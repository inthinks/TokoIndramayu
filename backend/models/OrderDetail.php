<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "order_detail".
 *
 * @property integer $id
 * @property string $order_code
 * @property integer $order_id
 * @property integer $product_id
 * @property integer $toko_id
 * @property string $email
 * @property integer $quantity
 * @property string $price
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
            [['order_code', 'product_id', 'toko_id', 'email'], 'required'],
            [['order_id', 'product_id', 'toko_id', 'quantity'], 'integer'],
            [['price'], 'number'],
            [['order_code'], 'string', 'max' => 13],
            [['email'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_code' => 'Order Code',
            'order_id' => 'Order ID',
            'product_id' => 'Product ID',
            'toko_id' => 'Toko ID',
            'email' => 'Email',
            'quantity' => 'Quantity',
            'price' => 'Price',
        ];
    }

    
    }
