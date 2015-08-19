<?php

class ParticiparController extends CController
{

    private $_token = 0;

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
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('participar', 'responder', 'respuesta'),
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actionParticipar()
    {
        if( $this->validarCuentas() ) 
        {     
            $preguntas = Pregunta::model()->findAll('fecha = ?', array(0 => date('Y-m-d')));
            $this->generateToken();
            $preguntas = $this->validarTiempo($preguntas);
            $this->render('participar', array('preguntas' => $preguntas));
        }
        else
        {
            // Codigo 3 debe estar en el contenido de la base de datos .
            $this->redirect(array('site/contenido', 'id' => 3 ));
            Yii::app()->end();
        }

    }

    public function actionResponder()
    {
        $this->layout = "single";
        if (!Yii::app()->request->isAjaxRequest) throw new CHttpException('403', 'Forbidden access.');

        $id = Yii::app()->request->restParams['id'];

        $pregunta = Yii::app()->request->restParams['pregunta'];
        $respuestas = Respuesta::model()->findAll('pregunta_id = ?', array(0 => $id));

        $datos = array(
            'respuestas' => $respuestas,
            'pregunta' => $pregunta
        );

        $html = $this->render('responder', $datos, true);

        header('Content-Type: application/json; charset="UTF-8"');
        echo CJSON::encode(array('html' => $html));
        Yii::app()->end();
    }

    public function actionRespuesta()
    {

        $this->layout = "single"; 
        if (!Yii::app()->request->isAjaxRequest) throw new CHttpException('403', 'Forbidden access.');
        $id = Yii::app()->request->restParams['id'];


        // Validar token

        if( $this->validarToken() )
        {

           if( $this->validarCuentas() ) 
           {
                $respuesta  = Respuesta::model()->find('id = ?', array(0 => $id));
                $pregunta   = Pregunta::model()->find('id = ?', array(0 => $respuesta->pregunta->id));
                $puntos     = $respuesta->pregunta->nivel->puntos;
                //$pregunta->estado = 0;
                //$pregunta->save();

                $respuestaJugador   = new RespuestaXJugador();
                $log                = new Logs();
                $respuestaJugador->pregunta_id  = $respuesta->pregunta->id;
                $respuestaJugador->respuesta_id = $id;
                $respuestaJugador->jugador_id   = Yii::app()->session['jugador_id'];
                $respuestaJugador->fecha        = date('Y-m-d G:i:s');
                $respuestaJugador->ip           = $_SERVER['REMOTE_ADDR'].' : '.$_SERVER['REMOTE_PORT'];

                try {

                    $log->accion            = 'Contesto Pregunta #'.$respuesta->pregunta->id;
                    $log->usuario           = Yii::app()->session['jugador_id'];
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


                $respuestaJugador->save();
                $respuesta = Respuesta::model()->find('id = ?', array(0 => $id));

                $r = array();

                switch (($respuesta->es_correcta == 1))
                {
                    case true:
                        $r['message']   = 'Felicitaciones, tu respuesta es correcta.';
                        $r['status']    = 'success';
                        break;
                    case false:
                        $r['message']   = '¡Lo sentimos! Tu respuesta fue incorrecta.';
                        $r['status']    = 'error';
                        break;
                }
                $r['puntos'] = $puntos;
                $this->clearTokenVal();
           }
           else
           {
               $r = array();
               $r['message']    = 'Moral error: No puedes jugar aun.';
               $r['status']     = 'error';
               // Codigo 3 debe estar en el contenido de la base de datos .
               $this->redirect(array('site/contenido', 'id' => 3 ));
               Yii::app()->end();
           }

        }
        else
        {
            $r = array();
            $r['message']    = 'Error , token de seguridad invalido.';
            $r['status']     = 'error';
        }

        
        header('Content-Type: application/json; charset="UTF-8"');
        echo CJSON::encode($r);
        Yii::app()->end();
    }

    private function generateToken()
    {
       $this->_token                =   bin2hex(rand(0, 40000)).'abc1234*';
       $this->setTokenVal($this->_token);
    }

    private function setTokenVal($pass)
    {
        Yii::app()->session['token'] = $pass;
    }

    private function getTokenVal()
    {
        return  $this->_token ;
    }

    private function clearTokenVal()
    {
        Yii::app()->session['token'] = '';
    }

    private function validarToken()
    {
        if( isset(Yii::app()->session['token']) && !empty(Yii::app()->session['token']) 
            && !empty(Yii::app()->session['token']) )
        {
            if( substr(Yii::app()->session['token'], -8) === 'abc1234*' )
            {
              return true;    
            }
            else
            {
                return false;
            }
             
        }
        else
        {
            return false;
        }
    }

    private function validarCuentas()
    {
        if( isset(Yii::app()->session['jugador_id'] ) && !empty(Yii::app()->session['jugador_id'] ) )
        {

            $rj = RespuestaXJugador::model()->find("( TIMESTAMPDIFF(MINUTE,fecha,?) <= 10 AND jugador_id <> ? ) AND RTRIM( SUBSTR(ip, 1, (INSTR(ip, ':')-1)) ) = ?",
                                                    array(  0 => date('Y-m-d G:i:s'),
                                                            1 => Yii::app()->session['jugador_id'] ,
                                                            2=> $_SERVER['REMOTE_ADDR']) 
                                                         );
            if($rj === null)
            {
                return true;
            }
            else
            {
                return false;
            }

        }
        else
        {
            
            if( Yii::app()->user->id )
            {
                $jugador = Jugador::model()->find('usuario_id = ' . Yii::app()->user->id);

                if ($jugador != null)
                {
                    $jugador_id = $jugador->id;
                    Yii::app()->session['jugador_id']   = $jugador_id;
                            // Metodo recursivo.
                    if( !empty(Yii::app()->session['jugador_id']) )
                    {
                        $this->validarCuentas();    
                    }

                }
            }

            return false;
        }

    }

    
    public function validarTiempo($preguntas)
    {
        foreach ($preguntas as $key => $value)
        {
            $hora_inicio = date('G:i:s', strtotime($value['hora_inicio']));
            $hora_inicio = explode(':', $hora_inicio);
            $hora_inicio = join('', $hora_inicio);

            $hora_fin = date('G:i:s', strtotime($value['hora_fin']));
            $hora_fin = explode(':', $hora_fin);
            $hora_fin = join('', $hora_fin);

            $hora_actual = date('G:i:s', time());
            $hora_actual = explode(':', $hora_actual);
            $hora_actual = join('', $hora_actual);

            $respuesta = RespuestaXJugador::model()->findAll('pregunta_id = ? AND jugador_id = ?', array(0 => $value->id, 1 => Yii::app()->user->id));

            if (count($respuesta) == 0)
            {
                if ($hora_actual >= $hora_inicio && $hora_actual <= $hora_fin)
                    $preguntas[$key]->estado = 1;
                else
                    $preguntas[$key]->estado = 0;

                $preguntas[$key]->save();
            }
            else
                $preguntas[$key]->estado = 2;
        }

        return $preguntas;
    }


}