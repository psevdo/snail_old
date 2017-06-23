<?php
namespace app\modules\menu;

class Bootstrap implements \yii\base\BootstrapInterface {
	
	public function bootstrap($app) {
		$app->getUrlManager()->addRules([
			// 'page/<id:[\w-]+>' => 'page/default/index',
			
			'admin/menu' => 'menu/admin/menu/index',
			'admin/menu/create' => 'menu/admin/menu/create',
			'admin/menu/update/<id:\w+>' => 'menu/admin/menu/update',
			'admin/menu/delete/<id:\w+>' => 'menu/admin/menu/delete',
		], false);
	}
	
}