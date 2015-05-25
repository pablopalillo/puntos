<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'

		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model = new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes = $_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}

		// display the login form
		$this->render('participar',array('model'=>$model));

	}


	public function actionLogout()
	{
		Yii::app()->user->logout();
		Yii::app()->session->clear();
		Yii::app()->session->destroy();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionRegistro()
	{
		Yii::app()->user->setFlash('error', "Estamos revisando los resultados");
		//	$this->redirect('puntajes');
		$usuario = new Usuario;
		$jugador = new Jugador;

		if(isset($_POST['Usuario'], $_POST['Jugador']))
		{
			$usuario->attributes = $_POST['Usuario'];
			$jugador->attributes = $_POST['Jugador'];

			$jugador->colegio 	 				= '';
			$jugador->parentesco_id 		= '7';
			$jugador->nombre_adulto = '';

			$valid = false;

			if($usuario->validate() && $jugador->validate())
			{
				$valid = true;
			}


			if($valid)
			{
				$usuario->save(false);
				$jugador->usuario_id = $usuario->id;
				$jugador->save(false);

				if( $jugador->nombre_adulto )
				{
					$datos = array(	'nombre' 			=> $jugador->nombre,
					'nombre_adulto'		=> $jugador->nombre_adulto,
					'correo' 			=> $usuario->correo,
					'correo_adulto'		=> $jugador->correo_adulto,
					'llave_activacion' 	=> $usuario->llave_activacion
					);

					$this->verificarCorreoAdulto($datos);
				}
				else
				{
						$datos = array(	'nombre' 	=> $jugador->nombre,
						'correo' => $usuario->correo,
						'llave_activacion' 	=> $usuario->llave_activacion
					);

					$this->verificarCorreo($datos);
				}



					Yii::app()->end();
				}
			}


		$this->render('registro', array(
			'usuario' => $usuario,
			'jugador' => $jugador,
		)
		);
	}

	public function actionPuntajes()
	{
		//$ranking = Jugador::model()->getRanking();

        $total_mes = Jugador::model()->getRanking('mes',null,true);
        $total_anho = Jugador::model()->getRanking('anho',null,true);

		$this->render('ranking', array(
                'total_mes' => $total_mes,
                'total_anho' => $total_anho
            )
        );
	}

	public function actionVerificar($llave_activacion)
	{
		$verificar = Usuario::model()->verificarLlave($llave_activacion);
		if($verificar)
		{
			$mensaje = 'correcto';
			//FALTA ENVIAR CORREO
		}else{
			$mensaje = 'fallido';
			//FALTA MENSAJE DE FALLA
		}
		$this->render('verificar', array('mensaje' => $mensaje));
	}

	public function actionRecuperarContrasena()
	{
		$model = new RecuperarForm;

		if(isset($_POST['RecuperarForm']))
		{
			$model->attributes = $_POST['RecuperarForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->generarToken())
				$this->render('recuperar-mensaje', array('mensaje' => 'Por favor revisa tu correo electrónico'));
			else
				$this->render('recuperar',array('model'=>$model));
		}else{
			$this->render('recuperar',array('model'=>$model));
		}

	}

	public function actionValidarIdentidad($llave_activacion)
	{


		$recuperar = Usuario::model()->validarToken($llave_activacion);
		if($recuperar)
		{
			$model = new Usuario;
			if(isset($_POST['Usuario']))
			{
				$model->attributes = $_POST['Usuario'];
				$model->actualizarClave($recuperar->id);
				$this->render('recuperar-mensaje', array('mensaje' => 'Tu nueva contraseña se ha guardado'));
			}
			else
			{
				$this->render('form-recuperar', array('model' => $model));
			}
		}
		else
		{
			$this->render('recuperar-mensaje', array('mensaje' => 'Ooops!'));
		}


	}

	private function verificarCorreo($datos)
    {

				$mnino    = new YiiMailer();
				$mnino->SMTPDebug = 2;
				$mnino->IsSendmail();
        $mnino->setView('verificar-correo');
        $mnino->setData( array('datos' => $datos) );

        $mnino->render();

				$mnino->Subject    = 'Verifica tu registro en Puntos Telemedellín';
        $mnino->AddAddress($datos['correo']);
        $mnino->From = 'contacto@concursomedellin2018.com';
        $mnino->FromName = 'Puntos Telemedellín';
        $mnino->Send();

				if ($mnino->Send())
				{
					$mnino->ClearAddresses();
					Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');

				} else {
					Yii::app()->user->setFlash('error','Error while sending email: '.$mnino->ErrorInfo);

				}


				$this->render('verificar_correo', array('datos' => $datos) );


    }


		private function verificarCorreoAdulto($datos)
		{

			$madulto    = new YiiMailer();
			$madulto->IsSendmail();
			$madulto->SMTPDebug = 2;
			$madulto->setView('notificacion-adulto');
			$madulto->setData( array('datos' => $datos) );
			$madulto->render();
			$madulto->Subject  = strtok($datos['nombre'], ' ') . ' te inscribió como adulto responsable en el concurso Viaja a Suiza con Medellín 2018';
			$madulto->AddAddress($datos['correo_adulto']);
			$madulto->From = 'contacto@concursomedellin2018.com';
			$madulto->FromName = 'Puntos Telemedellín';

			if ($madulto->Send())
			{
				$madulto->ClearAddresses();
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');

			} else {
				Yii::app()->user->setFlash('error','Error while sending email: '.$madulto->ErrorInfo);
			}


			$this->render('verificar_correo', array('datos' => $datos) );

		}

    public function actionConsultar()
    {
        if (!Yii::app()->request->isAjaxRequest) throw new CHttpException('403', 'Forbidden access.');

        $mes = Yii::app()->request->restParams['mes'];
        $ranking = Jugador::model()->getRanking('mes',$mes,true,null);

        header('Content-Type: application/json; charset="UTF-8"');
        $r = array('r' => $ranking);
        echo CJSON::encode($r);
        Yii::app()->end();
    }
}
