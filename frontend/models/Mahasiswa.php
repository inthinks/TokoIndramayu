<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mahasiswa".
 *
 * @property integer $id
 * @property string $nama
 * @property string $nim
 */
class Mahasiswa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mahasiswa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'nim'], 'required'],
            [['nama'], 'string', 'max' => 100],
            [['nim'], 'string', 'max' => 15]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'nim' => 'Nim',
        ];
    }
}
