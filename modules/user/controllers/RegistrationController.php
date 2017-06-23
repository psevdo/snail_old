<?php
namespace app\modules\user\controllers;

use Yii;
use app\modules\user\models\Signup;

class RegistrationController extends \yii\web\Controller {
	
	public $layout = '//registration';
	
	// регистрация аккаунта
	public function actionIndex() {
		
		if(!Yii::$app->user->isGuest)
			return $this->redirect($module->urlAfterLogin);
		
		$module = Yii::$app->getModule('user');
		
		$model = new Signup();
		if(Yii::$app->request->post('Signup')) {
			$model->attributes = Yii::$app->request->post('Signup');
			// echo '<pre>';
			// print_r($model);
			// echo '</pre>';
			if($model->validate() && $model->signup()) {
				$model = new Signup(); // просто обнуление данных формы
				Yii::$app->session->setFlash('success', 'Регистрация прошла успешно.');
				if($module->activationByEmail) {
					Yii::$app->session->setFlash('info', 'На Ваш email отправлено письмо со ссылкой для активации аккаунта.');
				}
			} else {
				Yii::$app->session->setFlash('error', 'Ошибка регистрации аккаунта.');
			}
		}
		
		return $this->render('index', [
			'module' => $module,
			'model' => $model
		]);
	}
	
	// активация аккаунта
	public function actionActivation() {
		if(!Yii::$app->request->get())
			return $this->goHome();
		
		$model = new Signup();
		if($model->activation(Yii::$app->request->get('email'), Yii::$app->request->get('token'))) {
			Yii::$app->session->setFlash('success', 'Аккаунт успешно активирован.');
		} else {
			Yii::$app->session->setFlash('error', 'Ошибка активации аккаунта.');
		}
		
		return $this->redirect(['/user/registration']);
	}
	
}