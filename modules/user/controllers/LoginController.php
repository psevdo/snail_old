<?php
namespace app\modules\user\controllers;

use Yii;
use app\controllers\AdminController;
use app\modules\user\models\Login;
use app\modules\user\models\PasswordRecovery;
use yii\web\HttpException;

class LoginController extends AdminController {
	public $layout = '//login';
	public function actionIndex() {
		$module = Yii::$app->getModule('user');
		
		if(!Yii::$app->user->isGuest) {
			return $this->redirect($module->urlAfterLogin);
		}
		
		$model = new Login();
		
		if(Yii::$app->request->post('Login')) {
			$model->attributes = Yii::$app->request->post('Login');
			if($model->validate()) {
				Yii::$app->user->login($model->getUser());
				return $this->redirect($module->urlAfterLogin);
			}
			
		}
		
		return $this->render('index', [
			'module' => $module,
			'model' => $model,
		]);
	}
	
	public function actionLogout() {
		Yii::$app->user->logout();
			
		$module = Yii::$app->getModule('user');
		return $this->redirect($module->urlAfterLogout);
	}
	
	public function actionRecoverypassword() {
		$module = Yii::$app->getModule('user');
		
		if(!Yii::$app->user->isGuest) {
			return $this->redirect($module->urlAfterLogin);
		}
		
		// разрешено ли восстановление пароля
		if(!$module->recoveryPassword || ($module->loginField != 'email' && !$module->activationByEmail)) {
			throw new HttpException(404);
		}
		
		$module = Yii::$app->getModule('user');
		$model = new PasswordRecovery();
		
		if(Yii::$app->request->post('PasswordRecovery')) {
			$model->attributes = Yii::$app->request->post('PasswordRecovery');
			if($model->validate()) {
				if($model->recovery()) {
					$model = new PasswordRecovery(); // просто обнуление данных формы
					Yii::$app->session->setFlash('success', 'Восстановление пароля прошло успешно.');
				} else {
					Yii::$app->session->setFlash('error', 'Ошибка восстановления пароля.');
				}
			}
		}
		
		return $this->render('recoverypassword', [
			'module' => $module,
			'model' => $model,
		]);
	}
	
}