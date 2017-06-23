<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class AdminController extends Controller{
	
	public $layout = '//admin';
	public $backendModulesLinks = [];
	
	public function init() {

		// получаем список модулей и ссылок для админки
		$this->_getBackenModuledLinks();
	}
	
	// получаем список модулей и ссылок для админки
	private function _getBackenModuledLinks() {
		foreach(Yii::$app->modules as $_moduleId => $_module) {
			if(!class_exists('app\modules\\'.$_moduleId.'\Module')) continue;
			
			$module = 'app\modules\\'.$_moduleId.'\Module';
			$this->backendModulesLinks[] = $module::getBackendLinks();
		}
	}
	
}
