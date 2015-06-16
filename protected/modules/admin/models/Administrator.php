<?php


class Administrator extends CActiveRecord
{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	public function tableName()
	{
		return 'pregunta';
	}

	public function rules()
	{

		return array(
			array('nivel_id, pregunta, estado', 'required'),
			array('nivel_id, estado', 'numerical', 'integerOnly'=>true),
			array('pregunta', 'length', 'max'=>255),
			array('id, nivel_id, pregunta, estado', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'nivel' => array(self::BELONGS_TO, 'Nivel', 'nivel_id'),
			'preguntaXRondas' => array(self::HAS_MANY, 'PreguntaXRonda', 'pregunta_id'),
			'respuestas' => array(self::HAS_MANY, 'Respuesta', 'pregunta_id'),
		);
	}


	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nivel_id' => 'Puntos',
			'pregunta' => 'Pregunta',
			'estado' => 'Estado',
		);
	}


	public function search()
	{

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('nivel_id',$this->nivel_id);
		$criteria->compare('pregunta',$this->pregunta,true);
		$criteria->compare('estado',$this->estado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function obtener_pregunta($nivel = 5, $pregunta_id = 0)
	{

		if($pregunta_id)
		{
			$pregunta = $this->findByPk($pregunta_id);
		}
		else
		{

			$pregunta = $this->pregunta_al_azar($nivel);

		}

		$rcriteria 				= new CDbCriteria;
		$rcriteria->select 		= array('id', 'respuesta');
		$rcriteria->condition 	= 'pregunta_id=:pregunta_id';
		$rcriteria->params 		= array(':pregunta_id' => $pregunta->id);


		$respuestas = Respuesta::model()->findAll($rcriteria);

		$result = array('pregunta' => $pregunta,
						'respuestas' => $respuestas);

		return $result;

	}

}
