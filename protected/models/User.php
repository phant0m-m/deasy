<?php
/**
 * @author Phant0m_m
 */

class User extends CActiveRecord
{
    /**
   	 * The followings are the available columns in table 'users':
   	 * @var integer $id
   	 * @var string $name
   	 * @var string $password
   	 * @var string $user_type
   	 */

   	/**
   	 * Returns the static model of the specified AR class.
   	 * @return CActiveRecord the static model class
   	 */
   	public static function model($className=__CLASS__)
   	{
   		return parent::model($className);
   	}

   	/**
   	 * @return string the associated database table name
   	 */
   	public function tableName()
   	{
   		return 'users';
   	}

   	/**
   	 * @return array validation rules for model attributes.
   	 */
   	public function rules()
   	{
   		return array(
   			array('username, password, user_type', 'required'),
   			array('username, password, user_type', 'length', 'max'=>128),
   		);
   	}

   	/**
   	 * @return array relational rules.
   	 */
   	public function relations()
   	{
   		return array(
   			'vhosts' => array(self::HAS_MANY, 'Vhost', 'owner_id'),
   		);
   	}

   	/**
   	 * @return array customized attribute labels (name=>label)
   	 */
   	public function attributeLabels()
   	{
   		return array(
   			'id' => 'Id',
   			'username' => 'Username',
   			'password' => 'Password',
   			'user_type' => 'User type',
   		);
   	}

   	/**
   	 * Checks if the given password is correct.
   	 * @param string the password to be validated
   	 * @return boolean whether the password is valid
   	 */
   	public function validatePassword($password)
   	{
   		return $this->hashPassword($password) === $this->password;
   	}

   	/**
   	 * Generates the password hash.
   	 * @param string password
   	 * @return string hash
   	 */
   	public function hashPassword($password)
   	{
   		return md5($password);
   	}
}