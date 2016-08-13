<?php

namespace frontend\models;

use Yii;
use frontend\models\Toko;

/**
 * This is the model class for table "production".
 *
 * @property integer $id
 * @property string $JenisProduksi
 */
class Production extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'production';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['JenisProduksi'], 'required'],
            [['JenisProduksi'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'JenisProduksi' => 'Jenis Produksi',
        ];
    }

    public function getToko()
    {
        return $this->hasOne(Toko::className(), ['Production_id' => 'id']);
    }

     public function getTokoId()
    {
        return $this->production ? $this->production->id : 'none';
    }
}
