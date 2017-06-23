<?php
namespace app\modules\user;

class Bootstrap implements \yii\base\BootstrapInterface {
	
	public function bootstrap($app) {
		$app->getUrlManager()->addRules([
			'login' => 'user/login',
			'logout' => 'user/login/logout',
			'recoverypassword' => 'user/login/recoverypassword',
			
			// [
				// 'pattern' => 'registration',
				// 'route' => 'user/registration',
				// 'suffix' => '/',
				// 'normalizer' => true, // disable normalizer for this rule
			// ],
			'registration' => 'user/registration',
			'activation' => 'user/registration/activation',
			
			'admin/role' => 'user/admin/role',
			'admin/role/create' => 'user/admin/role/create',
			'admin/role/update/<id:\w+>' => 'user/admin/role/update',
			'admin/role/delete/<id:\w+>' => 'user/admin/role/delete',
			
			'admin/permission' => 'user/admin/permission',
			'admin/permission/create' => 'user/admin/permission/create',
			'admin/permission/update/<id:\w+>' => 'user/admin/permission/update',
			'admin/permission/delete/<id:\w+>' => 'user/admin/permission/delete',
			
			'admin/user' => 'user/admin/user',
			'admin/user/create' => 'user/admin/user/create',
			'admin/user/update/<id:\d+>' => 'user/admin/user/update',
			'admin/user/delete/<id:\d+>' => 'user/admin/user/delete',
		], false);
	}
	
}