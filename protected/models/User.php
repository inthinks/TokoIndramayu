<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $saltPassword
 * @property string $email
 * @property string $joinDate
 * @property integer $level_id
 * @property string $avatar
 *
 * The followings are the available model relations:
 * @property Comment[] $comments
 * @property News[] $news
 * @property Raputation[] $raputations
 * @property Raputation[] $raputations1
 * @property Thread[] $threads
 * @property Threadstar[] $threadstars
 * @property Level $level
 */
class User extends CActiveRecord
{
	public $password2;
	public $verifyCode;
	/*
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/*
	 * @return array validation rules for model attributes.
	 */
	/*public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, email, password2, verifyCode',/** saltPassword, joinDate, level_id',*//* 'required','message'=>'{attribute}Tidak boleh kosong'),
			array('verifyCode','captcha','allowEmpty'=>!extension_loaded('gd')),
			array('level_id', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>20),
			array('password, saltPassword, email', 'length', 'max'=>50),
			array('avatar','file','types'=>'gif,png,jpg'),// 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password, saltPassword, email, joinDate, level_id, avatar, isActive', 'safe', 'on'=>'search'),
		);
	}*/

	public function rules()
	{
	return array(
	array('username, password, 
	email,password2,verifyCode', 'required','message'=>'{attribute} 
	Tidak Boleh Kosong'),
	array('verifyCode', 'captcha',
	'allowEmpty'=>!extension_loaded('gd')),
	array('level_id', 'numerical', 'integerOnly'=>true),
	array('username', 'length', 'max'=>20),
	array('password, saltPassword, email', 'length',
	'max'=>50),
	array('avatar','file', 'types'=>'gif,png,jpg'),
	array('id, username, password, saltPassword, email, 
	joinDate, level_id, avatar, isActive', 'safe', 'on'=>'search'),
	);
	}
	/*
	public function validatePassword($password)
	{
		return $thi->hashPassword($password,$this->saltPassword)===$this->password;
	}

	public function hashPassword($password,$salt)
	{
		return md5($salt.$password);
	}

	public function generateSalt()
	{
		return uniqid('',true);
	}
	*/
	/*
	 * @return array relational rules.
	 */
	public function validatePassword($password)
	{
	return $this->hashPassword($password,$this->saltPassword)===$this->password;
	}
	public function hashPassword($password,$salt)
	{
	return md5($salt.$password);
	}
	public function generateSalt()
	{
	return uniqid('',true);
	}


	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'comments' => array(self::HAS_MANY, 'Comment', 'user_id'),
			'news' => array(self::HAS_MANY, 'News', 'user'),
			'raputations' => array(self::HAS_MANY, 'Raputation', 'pemberi_id'),
			'raputations1' => array(self::HAS_MANY, 'Raputation', 'penerima_id'),
			'threads' => array(self::HAS_MANY, 'Thread', 'user_id'),
			'threadstars' => array(self::HAS_MANY, 'Threadstar', 'user_id'),
			'level' => array(self::BELONGS_TO, 'Level', 'level_id'),
		);
	}

	/*
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'saltPassword' => 'Salt Password',
			'email' => 'Email',
			'joinDate' => 'Join Date',
			'level_id' => 'Level',
			'avatar' => 'Avatar',
		);
	}

	/*
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('saltPassword',$this->saltPassword,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('joinDate',$this->joinDate,true);
		$criteria->compare('level_id',$this->level_id);
		$criteria->compare('avatar',$this->avatar,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/*
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
