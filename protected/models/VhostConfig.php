<?php
/**
 * @author Phant0m_m
 */

class VhostConfig extends CActiveRecord
{
    /**
   	 * The followings are the available columns in table 'users':
     * @var integer $id
   	 * @var integer $vhost_id
   	 * @var string $config
   	 */

   	/**
   	 * Returns the static model of the specified AR class.
   	 * @return CActiveRecord the static model class
   	 */
   	public static function model($className=__CLASS__)
   	{
   		return parent::model($className);
   	}

    public function getDefaultConfig()
    {
        $config = new VhostConfig();
        $config->config = file_get_contents(Yii::app()->params['configTemplatePath']);
        return $config;
    }

   	/**
   	 * @return string the associated database table name
   	 */
   	public function tableName()
   	{
   		return 'custom_vhosts_configs';
   	}

   	/**
   	 * @return array validation rules for model attributes.
   	 */
   	public function rules()
   	{
   		return array(
   			array('config,vhost_id', 'required'),

   		);
   	}

   	/**
   	 * @return array relational rules.
   	 */
   	public function relations()
   	{
   		return array(
   			'vhost' => array(self::BELONGS_TO, 'Vhost', 'vhost_id'),
   		);
   	}

   	/**
   	 * @return array customized attribute labels (name=>label)
   	 */
   	public function attributeLabels()
   	{
   		return array(
   			'vhost_id' => 'Id',
   			'config' => 'Config',
   		);
   	}

}