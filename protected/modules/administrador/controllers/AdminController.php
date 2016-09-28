<?php

class AdminController extends Controller
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
				'actions'=>array('index', 'view', 'crear', 'update', 'delete'),
				//'users'=>array('@'),
				'expression' => 'strpos(Yii::app()->user->getState("correo"), "@telemedellin.tv")',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex()
	{
		
		$model = new Partido('search');
		
		if(isset($_GET['Partido']))
			$model->attributes = $_GET['Partido'];

		$this->render('index', array(
			'model' => $model,
		));
	}

	public function actionView($id)
	{
		$model = Partido::model()->findByPk($id);
				
		$preguntas = new CActiveDataProvider( 'Pregunta', array(
													    'criteria'=>array(
													        'condition'=>'partido_id = '.$id,
													        'with'=>array('respuestas'),
													    )) );
		
		$this->render('ver', array(
			'model' => $model,
			'preguntas' => $preguntas,
		));
	}

	public function actionCrear()
	{

		$ronda = new Partido;
		if(isset($_POST['Partido'])){
			$ronda->attributes = $_POST['Partido'];
			if($ronda->validate()){
				if( !$ronda->save() )
				{
					Yii::app()->user->setFlash('mensaje', 'La ronda del ' . $ronda->nombre . ' no se pudo guardar');
				}else
				{
					Yii::app()->user->setFlash('mensaje', 'La ronda del ' . $ronda->nombre . ' se guardó exitosamente');
					$this->redirect( $this->createUrl('view', array('id' => $ronda->getPrimaryKey()) ));
				}
			}//if($preguntaForm->validate())

		} //if(isset($_POST['Pregunta']))/**/

		$this->render('crear',array(
			'model'=>$ronda,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{

		$ronda = Partido::model()->findByPk($id);
		
		if(isset($_POST['Partido'])){
			$ronda->attributes = $_POST['Partido'];
			if($ronda->validate()){
				if( !$ronda->save() )
				{
					Yii::app()->user->setFlash('mensaje', 'La ronda del ' . $ronda->nombre . ' no se pudo guardar');
				}else
				{
					Yii::app()->user->setFlash('mensaje', 'La ronda del ' . $ronda->nombre . ' se guardó exitosamente');
					$this->redirect( $this->createUrl('view', array('id' => $id)) );
				}
			}//if($preguntaForm->validate())

		} //if(isset($_POST['Pregunta']))/**/

		$this->render('modificar',array(
			'model'=>$ronda,
		));
	}

	public function actionDelete($id)
	{
		$partido = Partido::model()->findByPk($id);
		$partido->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : '../');
	}
}