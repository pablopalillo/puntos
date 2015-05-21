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
			 'actions'=>array('index','view','create','editPregunta','editRespuesta','delete'),
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
		$respuestas = new Respuesta;

		// Ajax validation
		$this->performAjaxValidation($pregunta);

		if( !empty($_POST['Pregunta'] ) )
		{

			$pregunta->attributes 	= $_POST['Pregunta'];
			$pregunta->estado 	= 1;


			if( !empty( $_POST['respuesta'] ) && count($_POST['respuesta']) > 1 )
			{

				if( $pregunta->save() )
				{

						foreach( $_POST['respuesta'] as $key => $value )
						{
							$respuesta = null ;
							$respuesta = new Respuesta ;
							$correcta  = 0;

							$respuesta->respuesta 	= $value;
							$correcta = ($key == $_POST['es_correcta'])?1:0;
							$respuesta->es_correcta = $correcta;
							$respuesta->pregunta_id	=	$pregunta->id;

							$respuesta->save();
						}

						$this->redirect(array('view', 'id'=>$pregunta->id));
				}
				else
				{
					Yii::app()->user->setFlash('error', "Error al guardar pregunta.");
				}

			}
			else
			{
				Yii::app()->user->setFlash('error', "Registre al menos (2) respuestas");
			}

		}

		$this->render('form', array('pregunta'=>$pregunta, 'respuesta'=>$respuestas));

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



	public function actionEditPregunta($id)
	{
			$pregunta 	= Pregunta::model()->findByPk($id);


				if( !empty($_POST['Pregunta'] ) )
				{

						$pregunta->attributes 	= $_POST['Pregunta'];
						$pregunta->estado 	= 1;

						$this->performAjaxValidation($pregunta);

						if( $pregunta->save() )
						{
							$this->redirect(array('view', 'id'=>$pregunta->id));
						}
						else
						{
							Yii::app()->user->setFlash('error', "Error al guardar pregunta.");
						}
				}

				$this->render('formEditar', array('pregunta'=>$pregunta));
		}

		public function actionEditRespuesta($id)
		{
				$respuesta 	= Respuesta::model()->findByPk($id);

					if( !empty($_POST['Respuesta'] ) )
					{
							$find = Respuesta::model()->find('es_correcta = 1 AND id = '.$respuesta->pregunta_id);
							if(!$find)
							{
								Yii::app()->user->setFlash('error', "No puede crear o modificar preguntas con multiples respuestas, para seleccionar esta como correcta primero tiene que quitar las respuestas verdaderas y volver a editar esta respuesta.");
							}
							else
							{
									$respuesta->attributes 	= $_POST['Respuesta'];

									$this->performAjaxValidation($respuesta);

									if( $respuesta->save() )
									{
										$this->redirect(array('view', 'id'=>$respuesta->pregunta_id));
									}
									else
									{
										Yii::app()->user->setFlash('error', "Error al guardar respuesta.");
									}
							}

					}

					$this->render('formEditarRespuesta', array('respuesta'=>$respuesta));
		}



	protected function performAjaxValidation($model)
	{
	    if(isset($_POST['ajax']) && $_POST['ajax']==='pregunta-form')
	    {
	        echo CActiveForm::validate($model);
	        Yii::app()->end();
	    }
	}

/**
* funcion en desarrollo para formatear las fechas
* d/m/Y
*
*/
	protected function formatearFecha($fecha)
	{
		$splitDate  = explode('/', $fecha);
		$newDate 		= date('Y-m-d', mktime(0, 0, 0, $splitDate[1], $splitDate[0], $splitDate[2]) );

		return $newDate;


	}







}