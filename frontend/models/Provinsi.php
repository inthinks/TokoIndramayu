<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "master_provinsi".
 *
 * @property integer $provinsi_id
 * @property string $provinsi_nama
 *
 * @property MasterKokab[] $masterKokabs
 */
class Provinsi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'master_provinsi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provinsi_nama'], 'string', 'max' => 30],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'provinsi_id' => 'Provinsi ID',
            'provinsi_nama' => 'Provinsi Nama',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKota()
    {
        return $this->hasMany(Kota::className(), ['provinsi_id' => 'provinsi_id']);
    }

    public function getCity()
    {
        return $this->hasMany(Profile::className(), ['city_id','provinsi_id']);
    }

    public static function getOptions()
    {
        $data = static::find()->all();
        $value = (count($data)==0) ? [''=>'']: yii\helpers\ArrayHelper::map($data, 'provinsi_id', 'provinsi_nama');
        return $value;
    }

    
}
