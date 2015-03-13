<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',
	'theme'=>'default',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.components.pay.*',
		'application.components.pay.api.*',
	),
	"defaultController"=>"login",
	'modules'=>array(
		// uncomment the following to enable the Gii tool
		/*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Enter Your Password Here',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		*/
	),

	// application components
	'components'=>array(
		'errorHandler'=>array(
				'errorAction'=>'site/error',
		),
		'user'=>array(
			'loginUrl'=>array('http://www.cswadmin.com'),
			'allowAutoLogin'=>true,
		),
		'cache'=>array(
			'class'=>'CFileCache',
		),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host=192.168.100.199;dbname=caishan',
			'emulatePrepare' => true,
			'username' => 'caishan',
			//'password' => '0a4f1f4758',
			'password' => 'zJ34bKPNwC8pVQuu',
			'charset' => 'utf8',
			'tablePrefix'=>'cs_',
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'    => 'CFileLogRoute',
					'levels'   => 'error, warning, info, trace',
					'logFile' => 'console.log',
					'categories'=>'system.db.*',
				),
				// uncomment the following to show log messages on web pages
				
				/*array(
					'class'=>'CWebLogRoute',
				),*/
				
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		'pay'=>require 'pay.php',
		'adminEmail'=>'webmaster@example.com',
		//'ddcurl'=>'http://192.168.100.199',
		'ddcurl'=>'http://http://www.newcsw.com/',
	),
);