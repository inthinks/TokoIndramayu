<?php

namespace frontend\models;

use Yii;
use common\models\User;
use frontend\models\Contact;
use frontend\models\Profile;
use frontend\models\Product;
use frontend\models\Production;
use yii\helpers\ArrayHelper;
use yii\db\Expression;
/**
 * This is the model class for table "toko".
 *
 * @property integer $id
 * @property string $nama_toko
 * @property integer $production_id
 * @property integer $profile_id
 * @property integer $product_id
 * @property integer $user_id
 */
class Toko extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'toko';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_toko'], 'required'],
            [['production_id', 'profile_id', 'user_id'], 'integer'],
            [['production_id'],'in', 'range'=>array_keys($this->getProductionList())],
            ['nama_toko','unique'],
            [['date_join'], 'safe'],
            [['nama_toko'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_toko' => 'Nama Toko',
            'production_id' => 'Jenis Produksi',
            'profile_id' => 'Profile',
            'user_id' => 'User ID',
            'date_join' => 'Bergabung'
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp'=>[
                'class'=>'yii\behaviors\TimestampBehavior',
                'attributes'=>[
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT=>['date_join'],
                    ],
                'value'=> new Expression('CURDATE()'),
                ],
            ];
    }

    public static function getProductionList()
    {
        $droptions = Production::find()->asArray()->all();
        return Arrayhelper::map($droptions,'id','JenisProduksi');
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

     public function getUserId()
    {
        return $this->user ? $this->user->id : 'none';
    }

     public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['id' => 'profile_id']);
    }

     public function getProfileId()
    {
        return $this->profile ? $this->profile->id : 'none';
    }

    /* public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

     public function getProductId()
    {
        return $this->product ? $this->product->id : 'none';
    }*/

    public function getProduction()
    {
        return $this->hasOne(Production::className(), ['id' => 'production_id']);
    }

     public function getProductionId()
    {
        return $this->production ? $this->production->id : 'none';
    }

    public function getOrderDetail()
    {
        return $this->hasMany(OrderDetail::className(), ['toko_id' => 'id']);
    }
}
