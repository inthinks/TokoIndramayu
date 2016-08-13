<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property string $order_code
 * @property string $order_date
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property integer $user_id
 * @property string $bank_transfer
 * @property string $payment_status
 * @property string $note
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_code', 'order_date', 'user_id', 'bank_transfer'], 'required'],
            [['order_date'], 'safe'],
            [['user_id'], 'integer'],
            [['order_code'], 'string', 'max' => 17],
            [['address', 'email', 'payment_status', 'note'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 14],
            [['bank_transfer'], 'string', 'max' => 50]
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
            'order_date' => 'Order Date',
            'address' => 'Address',
            'phone' => 'Phone',
            'email' => 'Email',
            'user_id' => 'User ID',
            'bank_transfer' => 'Bank Transfer',
            'payment_status' => 'Payment Status',
            'note' => 'Note',
        ];
    }

    
    }
