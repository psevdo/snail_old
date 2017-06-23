<?php
namespace app\modules\user\models;

use Yii;

class PasswordRecovery extends \app\modules\user\models\Login {
	
	public function rules() {
		$rules = [];

		$module = Yii::$app->getModule('user');
		if($module->loginField == 'username') {
			$rules = array_merge($rules, [
				['username', 'required'],
				['username', 'string', 'min' => 2, 'max' => 250]
			]);
		}
		if($module->loginField == 'email') {
			$rules = array_merge($rules, [
				['email', 'required'],
				['email', 'email']
			]);
		}
		if($module->loginField == 'phone') {
			$rules = array_merge($rules, [
				['phone', 'required'],
				['phone', 'validatePhone']
			]);
		}

		return $rules;
	}
	

	public function recovery() {
		$user = $this->getUser();
		$password = $user->generatePassword();
		$user->save();
		$this->_sendNewPassword($user->email, $password);
		
		return true;
	}
	
	// отправка нового пароля
	private function _sendNewPassword($email, $password) {
		return Yii::$app->mailer->compose(['html' => '@app/modules/user/mail/sendNewPassword'], ['password' => $password])
			->setFrom(Yii::$app->params['supportEmail'])
			->setTo($email)
			->setSubject('Восстановление пароля')
			->send();
	}
	
	
}