<?php

class AdministratorController extends Controller
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
		//Modelo para obtener las preguntas
		$preguntas =  new Pregunta('search');

		// render - 1. vista 2. array con los objetos de tipo CActiveRecord
		$this->render('index', array('model'=>$preguntas));
	}


	public function actionCreate()
	{

		$pregunta 	= new Pregunta ;
		$respuestas = null;

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

					// Fecha con formato de la bd de mysql
					$formatoFecha = Yii::app()->dateFormatter->format(
						'yyyy-MM-dd',
						CDateTimeParser::parse( $pregunta->fecha, 'dd/MM/yyyy')
						); 

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

        				$log                = new Logs();


						try {

				            $log->accion            = 'Creo una pregunta como admin';
				            $log->usuario           = 'Admin id: '.Yii::app()->user->id;
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

					$fechaForm = $_POST['Pregunta']['fecha'];
					// Fecha con formato de la bd de mysql
					$formatoFecha = Yii::app()->dateFormatter->format(
						'yyyy-MM-dd',
						CDateTimeParser::parse( $fechaForm, 'dd/MM/yyyy')
						); 

						$pregunta->attributes 	= $_POST['Pregunta'];
						$pregunta->estado 	= 1;

						$this->performAjaxValidation($pregunta);
						$pregunta->fecha = $formatoFecha;
						if( $pregunta->save(false,'update') )
						{

							$log                = new Logs();


							try {

					            $log->accion            = 'Edito la pregunta '.$pregunta->pregunta.' como admin';
					            $log->usuario           = 'Admin id : '.Yii::app()->user->id;
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


							$this->redirect(array('view', 'id'=>$pregunta->id));
						}
						else
						{
							Yii::app()->user->setFlash('error', "Error al guardar pregunta.");
						}
				}

							// Fecha con formato de la bd de mysql
			$pregunta->fecha = Yii::app()->dateFormatter->format(
				'dd/MM/yyyy',
				CDateTimeParser::parse( $pregunta->fecha, 'yyyy-MM-dd')
				); 
				$this->render('formEditar', array('pregunta'=>$pregunta));
		}

		public function actionEditRespuesta($id)
		{
				$respuesta 	= Respuesta::model()->findByPk($id);

					if( !empty($_POST['Respuesta'] ) )
					{
							$condicion = "( es_correcta = 1 AND id != $id) "
													 ."AND pregunta_id = $respuesta->pregunta_id";

							$find = Respuesta::model()->find($condicion);
							if($find && !empty($_POST['Respuesta']['es_correcta']))
							{
								Yii::app()->user->setFlash('error', "No puede crear o modificar preguntas con multiples respuestas, para seleccionar esta como correcta primero tiene que quitar las respuestas verdaderas y volver a editar esta respuesta.");
							}
							else
							{
									$respuesta->attributes 	= $_POST['Respuesta'];
									$this->performAjaxValidation($respuesta);

									if( $respuesta->save() )
									{

										$log                = new Logs();

										try {

								            $log->accion            = 'Edito la respuesta '.$respuesta->respuesta.' como admin';
								            $log->usuario           = Yii::app()->user->id;
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


		public function actionDelete($id)
		{
				$prx = new PreguntaXRonda;
				$rxj = new RespuestaXJugador;
				$res = new Respuesta;
				$pre = new Pregunta;


				$criteria = new CDbCriteria;
				$criteria->join = 'inner join pregunta p ON respuesta_x_jugador.pregunta_id = p.id';
				$criteria->condition = 'p.id='.$id;

				$prx->deleteAll("pregunta_id = $id");
				$rxj->deleteAll($criteria);
				$res->deleteAll("pregunta_id = $id");
				$pre->deleteAll("id = $id");


				$log                = new Logs();

				try {

					$log->accion            = 'Elimino la pregunta id #'.$id.' como admin';
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


				$this->redirect(array('index'));
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
