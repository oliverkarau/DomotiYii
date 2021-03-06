<?php

/**
 * This is the model class for table "settings_ncid".
 *
 * The followings are the available columns in table 'settings_ncid':
 * @property integer $id
 * @property boolean $enabled
 * @property string $tcphost
 * @property boolean $debug
 * @property integer $tcpport
 */
class SettingsNcid extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SettingsNcid the static model class
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
		return 'settings_ncid';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'required'),
			array('id, tcpport', 'numerical', 'integerOnly'=>true),
			array('enabled, debug', 'boolean', 'trueValue'=>-1),
			array('tcphost', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, enabled, tcphost, debug, tcpport', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'enabled' => 'Enabled',
			'tcphost' => 'Tcphost',
			'debug' => 'Debug',
			'tcpport' => 'Tcpport',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('enabled',$this->enabled);
		$criteria->compare('tcphost',$this->tcphost,true);
		$criteria->compare('debug',$this->debug);
		$criteria->compare('tcpport',$this->tcpport);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
