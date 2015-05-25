<?php

class ParticiparController extends CController
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
        $preguntas = Pregunta::model()->findAll('fecha = ?', array(0 => date('Y-m-d')));
        

        $this->validarTiempo($preguntas);

        $this->render('participar', array('preguntas' => $preguntas));
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

        $respuesta = Respuesta::model()->find('id = ?', array(0 => $id));
        $pregunta = Pregunta::model()->find('id = ?', array(0 => $respuesta->pregunta->id));
        $puntos = $respuesta->pregunta->nivel->puntos;
        //$pregunta->estado = 0;
        //$pregunta->save();

        $respuestaJugador = new RespuestaXJugador();
        $respuestaJugador->pregunta_id = $respuesta->pregunta->id;
        $respuestaJugador->respuesta_id = $id;
        $respuestaJugador->jugador_id = Yii::app()->session['jugador_id'];
        $respuestaJugador->fecha = date('Y-m-d G:i:s');
        $respuestaJugador->save();

        $respuesta = Respuesta::model()->find('id = ?', array(0 => $id));

        $r = array();

        switch (($respuesta->es_correcta == 1))
        {
            case true:
                $r['message'] = 'Felicitaciones, tu respuesta es correcta.';
                $r['status'] = 'success';
                break;
            case false:
                $r['message'] = 'Esa no era la respuesta, lo sentimos :(';
                $r['status'] = 'error';
                break;
        }

        $r['puntos'] = $puntos;

        header('Content-Type: application/json; charset="UTF-8"');
        echo CJSON::encode($r);
        Yii::app()->end();
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

            $respuesta = RespuestaXJugador::model()->findAll('pregunta_id = ? AND jugador_id = ?', array(0 => $value->id, 1 => Yii::app()->session['jugador_id']));

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
    }
}