<?php
namespace app\modules\page;

class Bootstrap implements \yii\base\BootstrapInterface {
	
	public function bootstrap($app) {
		$app->getUrlManager()->addRules([
			'page/<id:[\w-]+>' => 'page/default/index',
			
			'admin/page' => 'page/admin/page/index',
			'admin/page/create' => 'page/admin/page/create',
			'admin/page/update/<id:\d+>' => 'page/admin/page/update',
		], false);
	}
	
}