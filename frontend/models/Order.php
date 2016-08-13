<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use common\models\User;
// use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property string $order_code
 * @property string $order_date
 * @property integer $address_id
 * @property integer $user_id
 * @property string $bank_transfer
 * @property integer $payment_status
 */
class Order extends \yii\db\ActiveRecord
{

    const STATUS_NEW = 'New';
    const STATUS_IN_PROGRESS = 'In progress';
    const STATUS_DONE = 'Done';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    public function behaviors()
    {
        return [
            'timestamp'=>[
                'class'=>'yii\behaviors\TimestampBehavior',
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>['order_date'],
                    ],
                'value'=> new Expression('NOW()'),
                ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['order_code', 'order_date',  'user_id', 'bank_transfer'/*, 'payment_status'*/], 'required'],
            //[['order_date'], 'safe'],
            [['toko_id'], 'integer'],
            [['user_id'], 'safe'],
            [['bank_transfer'], 'number'],
            [['order_code'], 'integer', 'max' => 17],
            [['payment_status'], 'string', 'max' => 50],
            [['note'], 'string', 'max' => 250],
            //[['address'], 'string', 'max' => 250],
            //[['phone'], 'number', 'max' => 14],
            //[['email'],'filter','filter'=>'trim'],
            //[['email'],'required'],
            //[['email'],'email'],
            //[['email'],'unique'],
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
            'order_date' => 'Tanggal Order',
            'address' => 'Alamat',
            'phone' => 'No Telp',
            'note' => 'Note',
            'user_id' => 'Pemesan',
            'email' => 'Email',
            'bank_transfer' => 'No. Rekening',
            'payment_status' => 'Status Pembayaran',
        ];
    }

    public function getCode()
    {
        $no = $this->id + 9;
        return Rand(5, $no);
    }


    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->payment_status = self::STATUS_NEW;
            }
            return true;
        } else {
            return false;
        }
    }

    public static function getStatuses()
    {
        return [
            self::STATUS_DONE => 'Done',
            self::STATUS_IN_PROGRESS => 'In progress',
            self::STATUS_NEW => 'New',
        ];
    }

    public function sendEmail()
    {
        return Yii::$app->mailer->compose('order', ['order' => $this])
            ->setTo(Yii::$app->params['adminEmail'])
            ->setFrom(Yii::$app->params['adminEmail'])
            ->setSubject('New order #' . $this->id)
            ->send();
    }

    /*public function getOrder()
    {
        return $this->hasOne(OrderDetail::className(), ['id' => 'order_id']);
    }*/

    //Relation AR

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getOrderDetail()
    {
        return $this->hasMany(OrderDetail::className(), ['order_id' => 'id']);
    }
}
