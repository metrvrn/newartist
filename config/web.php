<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
	
	
	    'session' => [
            'class' => 'yii\web\DbSession',
            // 'db' => 'mydb',  // the application component ID of the DB connection. Defaults to 'db'.
             'sessionTable' => 'session', // session table name. Defaults to 'session'.
        ],
	
	
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Alex21',
			'baseUrl'=> '',
        ],
        'cache' => [ 
             'class' => 'yii\caching\DbCache',
             // 'db' => 'mydb',
             // 'cacheTable' => 'my_cache',
         ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
			'enableSession' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            //'useFileTransport' => true,
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
        'db' => $db,
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
			//'catalog/'=>'catalog/index',			
			//'site/index/<section>/<element>'=>'catalog/index', 
			
			//'catalog/<section>/<element>'=>'catalog', 
			
			//'catalog' => 'catalog/index',
			//'catalog/index' => 'catalog/index', 
			//'catalog/index/<section>/<element>'=>'catalog/index', 
			'catalog/index/<section>/<element>/<page>/<view>'=>'catalog/index', 
            ],
        ],
       
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
/*     $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['213.129.100.58', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ]; */
}

return $config;
