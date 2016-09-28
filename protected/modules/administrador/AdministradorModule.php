<?php
/**
 * AdministracionModule 
 * 
 * @uses CWebModule
 * @author Victor Arias. <victor.arias@telemedellin.tv> 
 * @license /protected/modules/administrador/LICENSE
 */
class AdministradorModule extends CWebModule
{
	public $defaultController 	= 'admin';
	
	public function init()
	{
		/*$this->setImport(array(
			'trivia.models.*',
		));/**/
		Yii::app()->clientScript->registerCss('admincolor', 'color: #000 !important;');
	}
	
	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			Yii::app()->user->loginUrl = array('/administrador/ingresar');
			return true;
		}
		else
			return false;
	}
}