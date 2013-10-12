<?php

/**
 * This is the model class for table "settings_rrdtool".
 *
 * The followings are the available columns in table 'settings_rrdtool':
 * @property integer $id
 * @property integer $polltime
 * @property boolean $enabled
 * @property boolean $debug
 * @property string $rra
 */
class SettingsRrdtool extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SettingsRrdtool the static model class
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
		return 'settings_rrdtool';
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
			array('id, polltime', 'numerical', 'integerOnly'=>true),
			array('enabled, debug', 'boolean', 'trueValue'=>-1),
			array('rra', 'length', 'max'=>256),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, polltime, enabled, debug, rra', 'safe', 'on'=>'search'),
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
			'polltime' => 'Polltime',
			'enabled' => 'Enabled',
			'debug' => 'Debug',
			'rra' => 'Rra',
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
		$criteria->compare('polltime',$this->polltime);
		$criteria->compare('enabled',$this->enabled);
		$criteria->compare('debug',$this->debug);
		$criteria->compare('rra',$this->rra,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}