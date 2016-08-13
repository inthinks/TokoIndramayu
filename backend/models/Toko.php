<?php

namespace backend\models;

use Yii;

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
            [['nama_toko', 'production_id', 'profile_id'], 'required'],
            [['production_id', 'profile_id', 'user_id'], 'integer'],
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
            'production_id' => 'Production ID',
            'profile_id' => 'Profile ID',
            'user_id' => 'User ID',
        ];
    }

    
    }
