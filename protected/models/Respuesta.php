<?php

/**
 * This is the model class for table "respuesta".
 *
 * The followings are the available columns in table 'respuesta':
 * @property integer $id
 * @property integer $pregunta_id
 * @property string $respuesta
 * @property integer $es_correcta
 *
 * The followings are the available model relations:
 * @property Pregunta $pregunta
 */
class Respuesta extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Respuesta the static model class
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
		return 'respuesta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pregunta_id, respuesta, es_correcta', 'required'),
			array('pregunta_id, es_correcta', 'numerical', 'integerOnly'=>true),
			array('respuesta', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, pregunta_id, respuesta, es_correcta', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'pregunta_id' => 'Pregunta',
			'respuesta' => 'Respuesta',
			'es_correcta' => 'Es Correcta',
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
		$criteria->compare('pregunta_id',$this->pregunta_id);
		$criteria->compare('respuesta',$this->respuesta,true);
		$criteria->compare('es_correcta',$this->es_correcta);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function cincuenta($pregunta_id)
	{
		$c 				= new CDbCriteria;
		$c->select 		= array('id');
		$c->addCondition('pregunta_id =' . $pregunta_id);
		$c->addCondition('es_correcta =' . 0);


		$r = $this->findAll($c);
		shuffle($r);
		if(count($r)>2) unset($r[0]);
		return $r;
	}
}
