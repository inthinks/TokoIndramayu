<?php

namespace backend\models;

use Yii;

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

    
    }
