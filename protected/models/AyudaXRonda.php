<?php

/**
 * This is the model class for table "ayuda_x_ronda".
 *
 * The followings are the available columns in table 'ayuda_x_ronda':
 * @property integer $id
 * @property integer $ayuda_id
 * @property integer $ronda_id
 *
 * The followings are the available model relations:
 * @property Ronda $ronda
 * @property Ayuda $ayuda
 */
class AyudaXRonda extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AyudaXRonda the static model class
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
		return 'ayuda_x_ronda';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ayuda_id, ronda_id', 'required'),
			array('ayuda_id, ronda_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, ayuda_id, ronda_id', 'safe', 'on'=>'search'),
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
			'ronda' => array(self::BELONGS_TO, 'Ronda', 'ronda_id'),
			'ayuda' => array(self::BELONGS_TO, 'Ayuda', 'ayuda_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'ayuda_id' => 'Ayuda',
			'ronda_id' => 'Ronda',
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
		$criteria->compare('ayuda_id',$this->ayuda_id);
		$criteria->compare('ronda_id',$this->ronda_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getAyudasDia($rondasdia)
	{
		$a = array();
		foreach($rondasdia as $rondadia)
		{
			$ayudas = $this->findAll('ronda_id = ' . $rondadia->id);
			foreach($ayudas as $ayuda)
				$a[$ayuda->ayuda->nombre] = $ayuda->ayuda_id;
		}
		return $a;
	}//getAyudasDia
}