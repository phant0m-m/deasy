<?php
/**
 * @author Phant0m_m
 */

class Vhost extends CActiveRecord
{
    /**
   	 * The followings are the available columns in table 'users':
   	 * @var integer $id
     * @var integer $owner_id
   	 * @var string $hostname
   	 * @var string $path_to
   	 * @var string $aliases
     * @var string $info
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
   		return 'vhosts';
   	}

    /**
   	 * @return array validation rules for model attributes.
   	 */
   	public function rules()
   	{
   		return array(
   			array('hostname, path_to, owner_id', 'required'),
   			array('hostname', 'length', 'max'=>64),
            array('path_to, aliases', 'length', 'max'=>256),
            array('info', 'length', 'max'=>500),
   		);
   	}

    /**
   	 * @return array relational rules.
   	 */
   	public function relations()
   	{
   		return array(
   			'owner_id' => array(self::BELONGS_TO, 'User', 'id'),
   		);
   	}

    /**
   	 * @return array customized attribute labels (name=>label)
   	 */
   	public function attributeLabels()
   	{
   		return array(
   			'id' => 'Id',
   			'owner_id' => 'Host owner identifier',
   			'hostname' => 'Hostname',
   			'path_to' => 'Disc path to installation',
            'aliases' => 'Host aliases',
            'info' => 'Additional host information',
   		);
   	}

    public function getFullUrl()
    {
        return $this->hostname . '.' . Yii::app()->user->getName() . '.' . Yii::app()->params['serverBaseHost'];
    }
}
