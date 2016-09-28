<?php

class RespuestaController extends Controller
{
	/**
	 * @var string the default layout for the views.
	 */
	public $layout='//layouts/admin';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			//array('CrugeAccessControlFilter'), 
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', 
				'actions'=>array('update', 'crear', 'delete'),
				//'users'=>array('@'), 
				'expression' => 'strpos(Yii::app()->user->getState("correo"), "@telemedellin.tv")',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionCrear($id)
	{

		$respuesta = new Respuesta;
		
		if(isset($_POST['Respuesta'])){
			$respuesta->attributes = $_POST['Respuesta'];
			$respuesta->pregunta_id = $id;
			if($respuesta->validate()){
				if( !$respuesta->save() )
				{
					Yii::app()->user->setFlash('mensaje', 'La respuesta ' . $respuesta->respuesta . ' no se pudo guardar');
				}else
				{
					$this->redirect( array('pregunta/view', 'id' => $respuesta->pregunta_id) );
				}
			}//if($preguntaForm->validate())

		} //if(isset($_POST['Pregunta']))/**/

		$this->render('crear',array(
			'model'=>$respuesta,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{

		$respuesta = Respuesta::model()->findByPk($id);
		
		if(isset($_POST['Respuesta'])){
			$respuesta->attributes = $_POST['Respuesta'];
			if($respuesta->validate()){
				if( !$respuesta->save() )
				{
					Yii::app()->user->setFlash('mensaje', 'La respuesta ' . $respuesta->respuesta . ' no se pudo guardar');
				}else
				{
					$this->redirect( array('pregunta/view', 'id' => $respuesta->pregunta_id) );
				}

			}//if($respuestaForm->validate())

		} //if(isset($_POST['Respuesta']))/**/

		$this->render('modificar',array(
			'model'=>$respuesta,
		));
	}

	public function actionDelete($id)
	{
		$respuesta = Respuesta::model()->findByPk($id);
		$respuesta->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : '../');
	}
}