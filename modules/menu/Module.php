<?php

namespace app\modules\menu;

use Yii;
use yii\helpers\Url;

/**
 * menu module definition class
 */
class Module extends \yii\base\Module {
	/**
	 * @inheritdoc
	 */
	public $controllerNamespace = 'app\modules\menu\controllers';

	/**
	 * @inheritdoc
	 */
	public function init() {
		parent::init();

		// custom initialization code goes here
		$this->registerTranslations();
	}
	
	public static function getBackendLinks() {
		return [
			'name' => 'Меню',
			'links' => [
				['link' => Url::toRoute('/menu/admin/menu/index', true), 'text' => 'Меню'],
				['link' => Url::toRoute('/menu/admin/menu/create', true), 'text' => 'Добавить меню']
			]
		];
	}
	
	public function registerTranslations() {
		Yii::$app->i18n->translations['modules/menu/*'] = [
			'class' => 'yii\i18n\PhpMessageSource',
			'sourceLanguage' => 'en-US',
			'basePath' => '@app/modules/menu/messages',
			'fileMap' => [
				'modules/menu/menu' => 'menu.php'
			],
		];
	}
	
	public static function t($category, $message, $params = [], $language = null) {
		return Yii::t('modules/menu/'.$category, $message, $params, $language);
	}
	
}
