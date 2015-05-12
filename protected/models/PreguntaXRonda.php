<?php

/**
 * This is the model class for table "pregunta_x_ronda".
 *
 * The followings are the available columns in table 'pregunta_x_ronda':
 * @property integer $id
 * @property integer $ronda_id
 * @property integer $pregunta_id
 *
 * The followings are the available model relations:
 * @property Pregunta $pregunta
 * @property Ronda $ronda
 */
class PreguntaXRonda extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PreguntaXRonda the static model class
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
		return 'pregunta_x_ronda';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ronda_id, pregunta_id', 'required'),
			array('ronda_id, pregunta_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, ronda_id, pregunta_id', 'safe', 'on'=>'search'),
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
			'pregunta' => array(self::BELONGS_TO, 'Pregunta', 'pregunta_id'),
			'ronda' => array(self::BELONGS_TO, 'Ronda', 'ronda_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'ronda_id' => 'Ronda',
			'pregunta_id' => 'Pregunta',
			'estado' => 'Estado',
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
		$criteria->compare('ronda_id',$this->ronda_id);
		$criteria->compare('pregunta_id',$this->pregunta_id);
		$criteria->compare('estado',$this->estado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}