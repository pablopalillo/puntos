<?php

class UsuarioController extends Controller
{
	public $layout='//layouts/admin';


	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		if ( isset( Yii::app()->user->es_admin ) )
		{
		return array(
					array('allow', //si es admin es un tipo usuario configurado en UserIdentitty
						'actions'=> array('index'),
						'expression'=>'( Yii::app()->user->es_admin == 1 )',
					),
					array('deny',  // deny all users
					'users'=>array('*'),
					),
			);
		}
		else
		{
			return array(
						array('deny',  // deny all users
						'actions'=> array('index'),
						'users'=>array('*'),
						),
					);
		}

	}


	public function actionIndex()
	{
		//Modelo para obtener el contenido
		
		$jugadores =  new Jugador('search');

		// render - 1. vista 2. array con los objetos de tipo CActiveRecord
		$this->render('index', array('model'=> $jugadores));
	}


	protected function performAjaxValidation($model)
	{
	    if(isset($_POST['ajax']) && $_POST['ajax']==='usuario-form')
	    {
	        echo CActiveForm::validate($model);
	        Yii::app()->end();
	    }
	}








}
