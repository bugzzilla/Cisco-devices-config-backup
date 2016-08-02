<?php
use yii\base\Module;
use yii;

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'name' => 'Cisco devices config backuper',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
	//	'gii' =>  [
	//		'class' => 'yii\gii\Module',
	//		'allowedIPs' => [
	//			'127.0.0.1',
	//			'172.23.80.139',
	//			'localhost',
	//		],
	//	],
  //  	'debug' => [
   // 		'class' => 'yii\debug\Module',
    //		'allowedIPs' => [
   // 			'127.0.0.1',
   // 			'172.23.80.139',
    //			'localhost',
    //		],
    //	],
    ],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
   		'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => false,
            'showScriptName' => false,
        	'baseUrl' => '',
            'rules' => [
           		'' => 'site/index',
				'signup' => 'site/signup',
            	'login' => 'site/login',
				'<controller>' => '<controller>/index',
//            	'<controller>/<id:\d+>/action:(create|view|update|delete)>' => '<controller>/<action>',
//            	'<controller>/<id:\d+>' => '<controller>/<action>',				            		
//            	'<controller>/<id:\d+>' => '<controller>/update',            		
            		
            		
            ],
        ],
        
    ],
    'params' => $params,
];
