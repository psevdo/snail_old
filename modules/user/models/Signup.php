<?php
namespace app\modules\user\models;

use Yii;
use yii\helpers\Url;

class Signup extends \yii\base\Model {
	
	public $email;
	public $username;
	public $phone;
	public $password;
	public $password_repeat;
	public $status;
	public $token;
	
	private $_autoGeneratePassword = false;
	
	public function rules() {
		$module = Yii::$app->getModule('user');
		$this->_autoGeneratePassword = $module->autoGeneratePassword;
		
		$rules = [
			[['password', 'password_repeat'], 'required', 'when' => function($modele) { return $modele->_autoGeneratePassword != true; }],
			[['password', 'password_repeat'], 'string', 'min' => 2, 'max' => 10, 'when' => function($modele) { return $modele->_autoGeneratePassword != true; }],
			['password_repeat', 'compare', 'compareAttribute' => 'password', 'when' => function($modele) { return $modele->_autoGeneratePassword != true; }],
		];

		if($module->loginField == 'username') {
			$rules = array_merge($rules, [
				['username', 'required'],
				['username', 'unique', 'targetClass' => 'app\modules\user\models\User'],
				['username', 'string', 'min' => 2, 'max' => 250]
			]);
			// if($module->activationByEmail) {
				// $rules = array_merge($rules, [
					// ['email', 'required'],
					// ['email', 'unique', 'targetClass' => 'app\modules\user\models\User'],
					// ['email', 'email']
				// ]);
			// }
		}
		if($module->loginField == 'email' || $module->activationByEmail) {
			$rules = array_merge($rules, [
				['email', 'required'],
				['email', 'unique', 'targetClass' => 'app\modules\user\models\User'],
				['email', 'email']
			]);
		}
		if($module->loginField == 'phone') {
			$rules = array_merge($rules, [
				['phone', 'required'],
				['phone', 'unique', 'targetClass' => 'app\modules\user\models\User'],
				['phone', 'validatePhone']
			]);
			// if($module->activationByEmail) {
				// $rules = array_merge($rules, [
					// ['email', 'required'],
					// ['email', 'unique', 'targetClass' => 'app\modules\user\models\User'],
					// ['email', 'email']
				// ]);
			// }
		}

		return $rules;
	}
	
	public function attributeLabels() {
		return [
			'username' => 'Логин',
			'email' => 'E-mail',
			'password' => 'Пароль',
			'password_repeat' => 'Подтверждение пароля',
        ];
    }
	
	// регистрация аккаунта
	public function signup() {
		$module = Yii::$app->getModule('user');
		$loginField = $module->loginField;
		
		$user = new User();
		$user->$loginField = $this->$loginField;
		if($module->activationByEmail && $module->loginField != 'email') { $user->email = $this->email; }
		if($module->autoGeneratePassword && ($module->loginField == 'email' || $module->activationByEmail)) {
			$password = $user->generatePassword();
			if(!$this->_sendAutoPassword($password, $user->email))
				return false;
		} else {
			$user->setPassword($this->password);
		}
		$user->status = User::STATUS_ACTIVE;
		
		// если требуется активация аккаунта по email
		if($module->activationByEmail) {
			$user->token = Yii::$app->getSecurity()->generateRandomString();
			$user->status = User::STATUS_NEW;
			$user->email = $this->email;
			if(!$this->_sendActivationLink($user->token, $user->email))
				return false;
		}
		
		if(!$user->save()) {
			return false;
		}
		
		// присвоение роли по-умолчанию
		$role = Yii::$app->authManager->getRole($module->defaultRole);
		Yii::$app->authManager->assign($role, $user->id);
				
		
		
		return true;
	}
	
	// активация аккаунта
	public function activation($email, $token) {
		$user = User::findOne(['email' => $email]);
		if(!$user) return false;
		
		if($user->token == $token) {
			$user->status = User::STATUS_ACTIVE;
			$user->save();
			return true;
		} else return false;
	}
	
	// отправка письма со ссылкой для активации
	private function _sendActivationLink($token, $email) {
		return Yii::$app->mailer->compose(['html' => '@app/modules/user/mail/sendActivationLink'], ['email' => $email, 'token' => $token])
			->setFrom(Yii::$app->params['supportEmail'])
			->setTo($email)
			->setSubject('Активация аккаунта')
			->send();
	}
	
	// 
	private function _sendAutoPassword($password, $email) {
		return Yii::$app->mailer->compose(['html' => '@app/modules/user/mail/sendAutoPassword'], ['email' => $email, 'password' => $password])
			->setFrom(Yii::$app->params['supportEmail'])
			->setTo($email)
			->setSubject('Активация аккаунта')
			->send();
	}
	
	public function validatePhone($attribute, $params) {
		return true;
	}
	
}