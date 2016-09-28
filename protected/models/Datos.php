<?php

/**
 * This is the model class for table "datos".
 *
 * The followings are the available columns in table 'datos':
 * @property string $id
 * @property string $usuario_id
 * @property string $pregunta_id
 * @property string $respuesta_id
 *
 * The followings are the available model relations:
 * @property Usuario $usuario
  * @property Pregunta $pregunta
   * @property Respuesta $respuesta
 */
class Datos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Datos the static model class
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
		return 'datos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('usuario_id, pregunta_id, respuesta_id', 'required'),
			array('usuario_id, pregunta_id', 'length', 'max'=>10),
			array('respuesta_id', 'length', 'max'=>19),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, usuario_id, pregunta_id, respuesta_id', 'safe', 'on'=>'search'),
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
			'usuario' => array(self::BELONGS_TO, 'Usuario', 'usuario_id'),
			'pregunta' => array(self::BELONGS_TO, 'Pregunta', 'pregunta_id'),
			'respuesta' => array(self::BELONGS_TO, 'Respuesta', 'respuesta_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'usuario_id' => 'Usuario',
			'pregunta_id' => 'Pregunta',
			'respuesta_id' => 'Fecha',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('usuario_id',$this->usuario_id,true);
		$criteria->compare('pregunta_id',$this->pregunta_id,true);
		$criteria->compare('respuesta_id',$this->respuesta_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

}