<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $Pengelola
 * @property string $alamat
 * @property string $description
 */
class Profile extends \yii\db\ActiveRecord
{
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
            [['user_id', 'Pengelola', 'alamat', 'description'], 'required'],
            [['user_id'], 'integer'],
            [['alamat', 'description'], 'string'],
            [['Pengelola'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'Pengelola' => 'Pengelola',
            'alamat' => 'Alamat',
            'description' => 'Description',
        ];
    }

    
    }
