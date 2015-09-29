<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "master_kokab".
 *
 * @property integer $kota_id
 * @property string $kokab_nama
 * @property integer $provinsi_id
 *
 * @property MasterProvinsi $provinsi
 */
class Kota extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'master_kokab';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provinsi_id'], 'integer'],
            [['kokab_nama'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kota_id' => 'Kota ID',
            'kokab_nama' => 'Kokab Nama',
            'provinsi_id' => 'Provinsi ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvinsi()
    {
        return $this->hasOne(Provinsi::className(), ['provinsi_id' => 'provinsi_id']);
    }

    public function getProvince()
    {
        return $this->hasMany(Profile::className(), ['province_id' => 'kota_id']);
    }

    public static function getOptionsbyProvince($province_id)
    {
        $data = static::find()->where(['provinsi_id'=>$province_id])->select(['kota_id','kota_nama'])->asArray()->all();
        $value = (count($data)==0) ? [''=>''] : $data;

        return $value;
    }
}
