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
			$contenido->save('update');

		}

		// render - 1. vista 2. array con los objetos de tipo CActiveReord
		$this->render('form', array('model'=>$contenido));
	}


	public function actionCreate()
	{

		$pregunta 	= new Pregunta ;
		$respuestas = null;


		// Fecha con formato de la bd de mysql
		$formatoFecha = Yii::app()->dateFormatter->format(
			'yyyy-MM-dd',
			CDateTimeParser::parse( $pregunta->fecha, 'dd/MM/yyyy')
			); 

		// Ajax validation
		$this->performAjaxValidation($pregunta);

		if( !empty($_POST['Pregunta'] ) )
		{

			$pregunta->attributes 	= $_POST['Pregunta'];
			$pregunta->estado 	= 1;

			foreach( $_POST['respuesta'] as $key => $value )
			{
				if( isset($_POST['es_correcta']) )
				{
					$correcta = ($key == $_POST['es_correcta'])?1:0;	
				}
				else
				{
					$correcta = 0;
				}
				$respuestas[] = array('respuesta' => $value, 'es_correcta' => $correcta);
			}

			if( !isset( $_POST['es_correcta'] ) )
			{
				Yii::app()->user->setFlash('error', "Seleccione una respesta correcta.");
			}
			else
			{
				if( !empty( $_POST['respuesta'] ) && count( array_values(array_diff( $_POST['respuesta'], array('') )) ) > 1 )
				{

					$fechaForm 		 = $pregunta->fecha;
					$pregunta->fecha = $formatoFecha;

					if( $pregunta->save(false,'save') )
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
						$pregunta->fecha = $fechaForm;
						Yii::app()->user->setFlash('error', "Error al guardar pregunta.");
					}

				}
				else
				{
					$pregunta->fecha = $fechaForm;
					Yii::app()->user->setFlash('error', "Registre al menos (2) respuestas");
				}
			}
		}

		$this->render('form', array('pregunta'=>$pregunta, 'respuestas'=>$respuestas));

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
