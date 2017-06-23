<?php

$params = require(__DIR__ . '/params.php');

require(__DIR__ . '/tools.php');
$modules = moduleList();

$bootstrap = [];
foreach($modules as $key => $val) { $bootstrap[] = 'app\modules\\'.$key.'\Bootstrap'; }

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
	'sourceLanguage' => 'en-US',
	'language' => 'ru-RU',
    'bootstrap' => array_merge(['log'], $bootstrap),
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'pj2pQGx8l6ndbOnPs6dklm70uGwS3dFw',
			'baseUrl'=> '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\modules\user\models\User',
			// 'enableAutoLogin' => true,
			'loginUrl' => ['/user/login'],
        ],
		// 'authClientCollection' => [
			// 'class' => 'yii\authclient\Collection',
			
		// ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
        ],*/
		'mail' => [
			'class' => 'yii\swiftmailer\Mailer',
			'useFileTransport' => false,
			'transport' => [
				'class' => 'Swift_SmtpTransport',
				'host' => 'smtp.gmail.com',
				'username' => 'psevdo85@gmail.com',
				'password' => '2730170685',
				'port' => '465',
				'encryption' => 'tls',
			],
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
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
			'normalizer' => [
				'class' => 'yii\web\UrlNormalizer',
				'collapseSlashes' => true,
				'normalizeTrailingSlash' => true,
            ],
            'rules' => [
				'<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],
		'authManager' => [
			'class' => 'yii\rbac\DbManager',
		],
    ],
	'modules' => $modules,
	// 'modules' => [
		// 'page' => [
			// 'class' => 'app\modules\page\Module'
		// ],
		// 'user' => [
			// 'class' => 'app\modules\user\Module',
		// ],
	// ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
