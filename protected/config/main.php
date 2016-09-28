<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Puntos TM',
	'sourceLanguage' => '00',
	'language' => 'es',
	'timeZone' => 'America/Bogota',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'ext.YiiMailer.YiiMailer',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		/*'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'asdf1234*',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),/**/

		'admin' => array(
			'defaultController' => 'administrator'
		),
	),

	// application components
	'components'=>array(
		//'cache' => array('class' => 'system.caching.CDummyCache'),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName' => false,
			'rules'=>array(
				'cerrar-sesion'			=> 'site/logout',
				'perfil'				=> 'jugador/perfil',
				'como-jugar'			=> 'site/page/view/instrucciones',
				'convocatoria'			=> 'site/page/view/convocatoria',
				'inscripcion'			=> 'site/registro',
				'inscripcion-cerrada'	=> 'site/page/view/inscripcion-cerrada',
				'terminos-y-condiciones'=> 'site/page/view/terminos-y-condiciones',
				'premio'				=> 'site/page/view/premio',
                'jugar'        			=> 'participar/participar',
				'editar-perfil'			=> 'jugador/update',
				'puntajes'				=> 'site/puntajes',
                'consultar-ranking' 	=> 'site/consultar',
				'recuperar-contrasena'	=> 'site/recuperarcontrasena',
				'verificar/<llave_activacion:\w+>'=>'site/verificar',
				'validar-identidad/<llave_activacion:\w+>'=>'site/validaridentidad',
				'terminos-y-condiciones' 								=>'site/page/view/terminos-y-condiciones',
				//'<controller:\w+>/<action:\w+>/<llave_activacion:\w+>'=>'<controller>/<action>',
				'<controller:\w\->/<id:\d+>'=>'<controller>/view',
				'<controller:\w\->/<action:\w\->/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w\->/<action:\w\->'=>'<controller>/<action>',
			),
		),
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		*/
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=puntostm',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'emerson.gutierrez@telemedellin.tv',
		'preguntasxnivel' => 4,
	),
);