<?php
Yii::import('zii.widgets.CPortlet');
 
class JugadorMenu extends CPortlet
{
    public $usuario_id;
    /*public function init()
    {
        $this->title = CHtml::encode(Yii::app()->user->name);
        parent::init();
    }*/
 	
    public function getUsuario()
    {
    	return Usuario::model()->with('jugadors')->findByPk($this->usuario_id);
    }

    protected function renderContent()
    {
        
        $this->render('jugadorMenu');
    }
}
