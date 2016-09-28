<?php

class PreguntaController extends Controller
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
				'actions'=>array('update', 'crear', 'view', 'delete'),
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

		$pregunta = new Pregunta;
		
		if(isset($_POST['Pregunta'])){
			$pregunta->attributes = $_POST['Pregunta'];
			$pregunta->partido_id = $id;
			if($pregunta->validate()){
				if( !$pregunta->save() )
				{
					Yii::app()->user->setFlash('mensaje', 'La pregunta ' . $pregunta->pregunta . ' no se pudo guardar');
				}else
				{
					$this->redirect( array('view', 'id' => $pregunta->getPrimaryKey()) );
				}

			}//if($preguntaForm->validate())

		} //if(isset($_POST['Pregunta']))/**/

		$this->render('crear',array(
			'model'=>$pregunta,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{

		$pregunta = Pregunta::model()->findByPk($id);
		
		if(isset($_POST['Pregunta'])){
			$pregunta->attributes = $_POST['Pregunta'];
			if($pregunta->validate()){
				if( !$pregunta->save() )
				{
					Yii::app()->user->setFlash('mensaje', 'La pregunta ' . $pregunta->pregunta . ' no se pudo guardar');
				}else
				{
					$this->redirect( array('view', 'id' => $pregunta->getPrimaryKey()) );
				}

			}//if($preguntaForm->validate())

		} //if(isset($_POST['Pregunta']))/**/

		$this->render('modificar',array(
			'model'=>$pregunta,
		));
	}

	public function actionView($id)
	{
		$model = Pregunta::model()->findByPk($id);
				
		$respuestas = new CActiveDataProvider( 'Respuesta', array(
													    'criteria'=>array(
													        'condition'=>'pregunta_id = '.$id,
													    )) );
		
		$this->render('ver', array(
			'model' => $model,
			'respuestas' => $respuestas,
		));
	}

	public function actionDelete($id)
	{
		$pregunta = Pregunta::model()->findByPk($id);
		$pregunta->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : '../');
	}
}