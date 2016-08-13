<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "contact".
 *
 * @property integer $id
 * @property string $no_telp
 * @property string $email
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['no_telp', 'email'], 'required'],
            [['no_telp'], 'string', 'max' => 12],
            [['email'], 'string', 'max' => 30],
            [['user_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_telp' => 'No Telp',
            'email' => 'Email',
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
}
