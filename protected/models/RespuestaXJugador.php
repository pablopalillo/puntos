<?php

/**
 * This is the model class for table "respuesta_x_jugador".
 *
 * The followings are the available columns in table 'respuesta_x_jugador':
 * @property integer $id
 * @property integer $pregunta_id
 * @property integer $respuesta_id
 * @property integer $jugador_id
 * @property date $fecha
 *
 * The followings are the available model relations:
 * @property Pregunta $pregunta
 * @property Respuesta $respuesta
 * @property Jugador $jugador
 */
class RespuestaXJugador extends CActiveRecord
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
		return 'respuesta_x_jugador';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pregunta_id, respuesta_id, jugador_id, fecha', 'required'),
			array('pregunta_id, respuesta_id, jugador_id', 'numerical', 'integerOnly'=>true)
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
			'respuesta' => array(self::BELONGS_TO, 'Respuesta', 'respuesta_id'),
			'jugador' => array(self::BELONGS_TO, 'Jugador', 'jugador_id'),
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
			'respuesta_id' => 'Respuesta',
			'jugador_id' => 'Jugador',
			'fecha' => 'Fecha',
			'ip' => 'ip'
		);
	}
}