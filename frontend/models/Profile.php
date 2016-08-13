<?php

namespace frontend\models;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\User;
use frontend\models\Toko;
use frontend\models\Provinsi;
use yii\web\UploadedFile;
/**
 * This is the model class for table "profile".
 *
 * @property integer $id
 * @property string $Pengelola
 * @property string $alamat
 * @property string $description
 */
class Profile extends \yii\db\ActiveRecord
{
    public $country;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Pengelola', 'alamat', 'description', 'user_id','province_id','city_id','phone'], 'required', 'on'=>'update'],
            [['alamat', 'description'], 'string'],
            [['user_id'], 'integer'],
            [['Pengelola'], 'string', 'max' => 45],
            [['province_id'], 'integer'],
            [['city_id'], 'integer'],
            //[['phone'], 'number'],
            [['phone'], 'udokmeci\yii2PhoneValidator\PhoneValidator','country'=>'ID'],
            [['country'], 'string', 'max' => 45],
            //[['image'], 'safe'],
            [['image'], 'file','skipOnEmpty'=>false, 'extensions' => 'jpg,png,gif', 'on' => 'update'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Pengelola' => 'Pengelola',
            'alamat' => 'Alamat',
            'description' => 'Deskripsi Toko',
            'city_id' => 'Kota',
            'province_id' => 'Propinsi',
            'phone' => 'Telp',
        ];
    }

     public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

     public function getUserId()
    {
        return $this->user ? $this->user->id : 'none';
    }

     public function getToko()
    {
        return $this->hasOne(Toko::className(), ['profile_id' => 'id']);
    }

     public function getTokoId()
    {
        return $this->toko ? $this->toko->id : 'none';
    }

    public function upload()
    {
        if ($this->validate()) {
            $file = UploadedFile::getInstance($this, 'image');
            if($this->save())
            {
                if(!empty($file)){
            
            $file->saveAs(Yii::$app->basePath.'/web/profil/' . $file->baseName .'.'.  $file->extension);
                }
            }

            // $this->image->saveAs(\Yii::$app->basePath . DIRECTORY_SEPARATOR.'/web/produk/'.$file->baseName.'.'.$file->extension);
            return true;
        } else {
            return false;
        }
    }

    public function getUrl()
    {
        return Yii::getAlias('@frontendWebroot/profil/'.$this->image);
    }

    public function getProvinsi()
    {
        return $this->hasOne(Provinsi::className(), ['provinsi_id'=>'province_id']);
    }

    public function getKota()
    {
        return $this->hasOne(Kota::className(), ['kota_id'=>'city_id']);
    } 

}
