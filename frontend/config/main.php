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
		'gii' =>  [
			'class' => 'yii\gii\Module',
			'allowedIPs' => [
				'127.0.0.1',
				'172.23.80.139',
				'localhost',
			],
		],
    	'debug' => [
    		'class' => 'yii\debug\Module',
    		'allowedIPs' => [
    			'127.0.0.1',
    			'172.23.80.139',
    			'localhost',
    		],
    	],
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
    	'formatter' => [
    		'class' => 'yii\\i18n\\Formatter',
   			//date & time format in ICU
    		'dateFormat' => 'dd MMM y',
    		'datetimeFormat' => 'dd MMM y H:i:s',    			
    		'timeFormat' => 'H:i:s',
    		'nullDisplay' => '<span class="not-set">(not set)</span>',
    		'booleanFormat' => ['<span class="glyphicon glyphicon-remove"></span> Unsuccess', '<span class="glyphicon glyphicon-ok"></span> Success']
    	],		    		
    		
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];
