<?php
namespace app\modules\user;

use Yii;
use yii\helpers\Url;

class Module extends \yii\base\Module {
	
	public $controllerNamespace = 'app\modules\user\controllers';
	// public $backendLinks = [];
	
	public $loginField = 'username';			// username || email || phone
	public $activationByEmail = false;		// true || false
	public $recoveryPassword = true;		// true || false
											// need $activationByEmail = true || $loginField = 'email'
	public $autoGeneratePassword = true;	// true || false
											// need $activationByEmail = true || $loginField = 'email'
	public $defaultRole = 'user';			// default user
	
	public $urlAfterLogin = ['/'];			// ['/controller/action']  || ['module/controller/action']
	public $urlAfterLogout = ['/'];			// ['/controller/action']  || ['module/controller/action']
	
	public function init() {
		parent::init();
		
		// custom initialization code goes here
		$this->registerTranslations();
	}
	
	public static function getBackendLinks() {
		return [
			'name' => 'Пользователи',
			'links' => [
				['link' => Url::toRoute('/user/admin/role', true), 'text' => 'Роли'],
				['link' => Url::toRoute('/user/admin/permission', true), 'text' => 'Разрешения'],
				['link' => Url::toRoute('/user/admin/user', true), 'text' => 'Пользователи']
			]
		];
	}
	
	public function registerTranslations() {
		Yii::$app->i18n->translations['modules/user/*'] = [
			'class' => 'yii\i18n\PhpMessageSource',
			'sourceLanguage' => 'en-US',
			'basePath' => '@app/modules/user/messages',
			'fileMap' => [
				'modules/user/general' => 'general.php',
				'modules/user/role' => 'role.php',
				'modules/user/permission' => 'permission.php',
				'modules/user/user' => 'user.php',
			],
		];
	}
	
	public static function t($category, $message, $params = [], $language = null) {
		return Yii::t('modules/user/'.$category, $message, $params, $language);
	}
	
}