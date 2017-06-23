<?php

namespace app\modules\page;

use Yii;
use yii\helpers\Url;

/**
 * page module definition class
 */
class Module extends \yii\base\Module{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\page\controllers';

    /**
     * @inheritdoc
     */
    public function init(){
        parent::init();

        // custom initialization code goes here
		$this->registerTranslations();
    }
	
	public static function getBackendLinks() {
		return [
			'name' => 'Страницы',
			'links' => [
				['link' => Url::toRoute('/page/admin/page/index', true), 'text' => 'Все страницы'],
				['link' => Url::toRoute('/page/admin/page/create', true), 'text' => 'Добавить страницу']
			]
		];
	}
	
	public function registerTranslations() {
		Yii::$app->i18n->translations['modules/page/*'] = [
			'class' => 'yii\i18n\PhpMessageSource',
			'sourceLanguage' => 'en-US',
			'basePath' => '@app/modules/page/messages',
			'fileMap' => [
				'modules/page/page' => 'page.php'
			],
		];
	}
	
	public static function t($category, $message, $params = [], $language = null) {
		return Yii::t('modules/page/'.$category, $message, $params, $language);
	}
}
