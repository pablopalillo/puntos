<?php

/**
 * This is the model class for table "jugador".
 *
 * The followings are the available columns in table 'jugador':
 * @property integer $id
 * @property string $nombre
 * @property integer $documento
 * @property integer $usuario_id
 * @property string $sexo
 * @property string $fecha_nacimiento
 * @property string $nombre_adulto
 * @property integer $documento_adulto
 * @property string $correo_adulto
 * @property string $telefono
 * @property integer $celular
 * @property string $direccion
 * @property integer $parentesco_id
 * @property string $fecha_registro
 * @property string $fecha_actualizacion
 * @property integer $puntaje
 *
 * The followings are the available model relations:
 * @property Parentesco $parentesco
 * @property Usuario $usuario
 * @property Ronda[] $rondas
 */
class Jugador extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Jugador the static model class
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
		return 'jugador';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('nombre, documento, sexo, fecha_nacimiento, telefono', 'required'),
			array('documento', 'unique'),
			array('documento, documento_adulto', 'numerical', 'integerOnly'=>true),
			array('documento','numerical','integerOnly'=>true),
			array('nombre, nombre_adulto', 'length', 'max'=>255),
			array('nombre','length','max'=>255),
			array('sexo', 'length', 'max'=>1),
			array('correo_adulto', 'length', 'max'=>100),
			array('telefono', 'length', 'max'=>45),
			array('id, nombre, documento, usuario_id, sexo, fecha_nacimiento, nombre_adulto, documento_adulto, correo_adulto, telefono, parentesco_id, fecha_registro, fecha_actualizacion, puntaje', 'safe', 'on'=>'search'),
			//array('id, nombre, documento, usuario_id, sexo, fecha_nacimiento,  telefono, fecha_registro, documento_adulto, fecha_actualizacion, puntaje', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'parentesco' => array(self::BELONGS_TO, 'Parentesco', 'parentesco_id'),
			'usuario' => array(self::BELONGS_TO, 'Usuario', 'usuario_id'),
			'rondas' => array(self::HAS_MANY, 'Ronda', 'jugador_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre' => 'Nombre completo',
			'documento' => 'Documento de identidad',
			'usuario_id' => 'Usuario',
			'sexo' => 'Sexo',
			'fecha_nacimiento' => 'Fecha de nacimiento',
		//	'colegio' => 'Colegio de Medellín',
			'nombre_adulto' => 'Nombre adulto responsable',
			'documento_adulto' => 'Documento adulto responsable',
			'correo_adulto' => 'Correo adulto responsable',
			'telefono' => 'Teléfono',
	//		'parentesco_id' => 'Parentesco',
			'fecha_registro' => 'Fecha de registro',
			'fecha_actualizacion' => 'Fecha de actualizacion',
			'puntaje' => 'Puntaje',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('documento',$this->documento);
		$criteria->compare('usuario_id',$this->usuario_id);
		$criteria->compare('sexo',$this->sexo,true);
		$criteria->compare('fecha_nacimiento',$this->fecha_nacimiento,true);
	//	$criteria->compare('colegio',$this->colegio,true);
		$criteria->compare('nombre_adulto',$this->nombre_adulto,true);
		$criteria->compare('documento_adulto',$this->documento_adulto);
		$criteria->compare('correo_adulto',$this->correo_adulto,true);
		$criteria->compare('telefono',$this->telefono,true);
		//$criteria->compare('parentesco_id',$this->parentesco_id);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('fecha_actualizacion',$this->fecha_actualizacion,true);
		$criteria->compare('puntaje',$this->puntaje);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getEdad()
	{
		 $date = new DateTime($this->fecha_nacimiento);
		 $now = new DateTime();
		 $interval = $now->diff($date);
		 return $interval->y;
	}

	public function getPuntos($jugador_id = 0)
	{
		 if($jugador_id == 0) $jugador_id = Yii::app()->user->id;
		 $jugador = $this->findByPk($jugador_id, array('select' => 'puntaje'));
		 return $jugador->puntaje;
	}

	public function setPuntos($puntaje, $jugador_id = 0)
	{
		if($jugador_id == 0) $jugador_id = Yii::app()->user->id;
		$jugador = $this->findByPk($jugador_id);
		$a = array('puntaje' => ($jugador->puntaje + $puntaje) );
		if( $jugador->updateByPk($jugador->id, $a) )
			return $this->getPuntos($jugador_id);
		else
			return false;
	}

	public function getRanking()
	{

		 $c = new CDbCriteria;
		 $c->addCondition('puntaje > 0');
		 $c->limit = 10;
		 $c->order = 'puntaje DESC';
		 $ninos = $this->findAllByAttributes(array('sexo' => 'M'), $c);
		 $ninas = $this->findAllByAttributes(array('sexo' => 'F'), $c);
		 $resultado = array('ninos' => $ninos, 'ninas' => $ninas);
		 return $resultado;

	}

	protected function beforeSave()
	{

        if($this->isNewRecord)
        {
        	$this->fecha_registro = date('Y-m-d H:i:s');
        	$this->puntaje = 0;
        }else
        {
        	$this->fecha_actualizacion = date('Y-m-d H:i:s');
        }

    	return true;
	}
}
