<?php

class ContenidoController extends Controller
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
						'actions'=> array('index','view','create','editPregunta','editRespuesta','delete'),
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
						'actions'=> array('index','view','create','editPregunta','editRespuesta','delete'),
						'users'=>array('*'),
						),
					);
		}

	}


	public function actionIndex()
	{
		//Modelo para obtener el contenido
		
		$contenido =  new Contenido('search');

		// render - 1. vista 2. array con los objetos de tipo CActiveRecord
		$this->render('index', array('model'=> $contenido));
	}

	public function actionView($id)
	{
		if( !empty( $id ) )
		{
			$contenido =  Contenido::model()->findByPk($id);
		}

		if(isset( $_POST['Contenido'])) 
		{

			$contenido->texto = $_POST['Contenido']['texto'];

			$log                = new Logs();

			try {

				$log->accion            = 'Edito el contenido  de '.$contenido->nombre.' como admin';
				$log->usuario           =  Yii::app()->user->id;
				$log->msg               = 'IP: '.$_SERVER['REMOTE_ADDR'].' : '.$_SERVER['REMOTE_PORT'];
				$log->fecha             = date('Y-m-d G:i:s');

				$log->save();

			} catch (Exception $e) 
			{
				$log->accion            = 'Error log';
				$log->msg               = '';
				$log->fecha             = '';

				$log->save();
			}   



			$contenido->save('update');

		}

		// render - 1. vista 2. array con los objetos de tipo CActiveReord
		$this->render('form', array('model'=>$contenido));
	}


	protected function performAjaxValidation($model)
	{
	    if(isset($_POST['ajax']) && $_POST['ajax']==='pregunta-form')
	    {
	        echo CActiveForm::validate($model);
	        Yii::app()->end();
	    }
	}








}
