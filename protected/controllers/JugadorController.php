<?php

class JugadorController extends Controller
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
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
			/*array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index', 'perfil'),
				'users'=>array('*'),
			),*/
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('perfil', 'update'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionPerfil()
	{
		$usuario_id = Yii::app()->user->id;
		$jugador = Jugador::model()->with('usuario', 'parentesco')->findByAttributes(array('usuario_id' => $usuario_id));
        
        $mes = date('m');
        $anho = date('Y');

        $ranking_mes = Jugador::model()->getRanking('mes',$mes,false);
        $ranking_anho = Jugador::model()->getRanking('anho',$anho,false);
        
        $p_m = 0;
        $p_a = 0;
        $r_m = 0;
        $r_a = 0;

        foreach ($ranking_mes as $mes)
        {
            if ($mes['id'] == $usuario_id)
            {
                $p_m = $mes['puntaje'];
                $r_m = $mes['top'];
            }
        }

        foreach ($ranking_anho as $anho)
        {
            if ($anho['id'] == $usuario_id)
            {
                $p_a = $anho['puntaje'];
                $r_a = $anho['top']; 
            }
        }

		$this->render('perfil', array('jugador' => $jugador, 'ranking_mes' => $r_m, 'ranking_anho' => $r_a, 'puntaje_mes' => $p_m, 'puntaje_anho' => $p_a));
	}


	public function actionUpdate()
	{
		$model = $this->loadModel( Yii::app()->user->id);

		if(isset($_POST['Jugador']))
		{
			$model->attributes=$_POST['Jugador'];
			if($model->save())
			$this->redirect(array('perfil','id'=>$model->id));
		}

		$this->render('_form',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Comment the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model = Jugador::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function actionRecuperarAcceso()
	{

	}

}
