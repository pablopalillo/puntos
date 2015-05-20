<?php

class AdministratorController extends Controller
{
	public $layout='//layouts/admin';

		/**
		 * Specifies the access control rules.
		 * This method is used by the 'accessControl' filter.
		 * @return array access control rules
		 */
	public function accessRules()
	{
		return array(
			array('allow',
			 'actions'=>array('index','view','create','update','admin','delete'),
				'users'=>array('*'),
			),
		);
	}


	public function actionIndex()
	{
		//Modelo para obtener las preguntas
		$preguntas =  new Pregunta('search');

		// render - 1. vista 2. array con los objetos de tipo CActiveRecord
		$this->render('index', array('model'=>$preguntas));
	}


	public function actionCreate()
	{

		$pregunta 	= new Pregunta ;
		$respuestas = new Respuesta ;
echo '<pre>';
print_r($_POST);
echo '</pre>';

		if( !empty($_POST['Pregunta'] ) )
		{

			$pregunta->attributes 	= $_POST['Pregunta'];
			$pregunta->estado 			= 1;

			if( $pregunta->save() )
			{
				if( !empty( $_POST['Respuesta'] ))
				{

					$respuestas->attributes 	= $_POST['Respuesta'];
					$respuestas->pregunta_id	=	$pregunta->id;

					if( $respuestas->save() )
					{
						$this->redirect(array('view','id'=>$pregunta->id));
					}
					else
					{
						Yii::app()->user->setFlash('error', "Error al guardar las respuestas.");
					}

				}

			}
			else
			{
				Yii::app()->user->setFlash('error', "Error al guardar pregunta.");
			}
		}

		$this->render('form',array('pregunta'=>$pregunta, 'respuesta'=>$respuestas));
	}



	public function actionView($id)
	{

		if( !empty( $id ) )
		{
			$pregunta =  Pregunta::model()->findByPk($id);

			$respuestas = 	new CActiveDataProvider('Respuesta', array(
				'criteria'=>array(
					'with'=> array('pregunta'),
					'condition'=> "pregunta_id = $id ",
				),
			));


		}

		// render - 1. vista 2. array con los objetos de tipo CActiveReord
		$this->render('view', array('pregunta'=>$pregunta, 'dataProvider'=>$respuestas));
	}




}
