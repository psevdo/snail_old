<?php
namespace app\modules\user\models;

use Yii;

class Login extends \yii\base\Model {
	
	public $email;
	public $username;
	public $phone;
	public $password;
	
	
	public function rules() {
		$rules = [
			['password', 'required'],
			['password', 'string', 'min' => 2, 'max' => 10],
			['password', 'validatePassword']
		];

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
	
	public function attributeLabels() {
		return [
			'username' => 'Логин',
			'email' => 'E-mail',
			'password' => 'Пароль',
        ];
    }
	
	public function validatePassword($attribute, $params) {
		if(!$this->hasErrors()) {
			$user = $this->getUser();

			if(!$user || !$user->validatePassword($this->password)) {
				$this->addError($attribute, 'Логин или пароль введены не верно, либо Ваш аккаунт заблокирован.');
			}
		}
	}
	
	public function getUser() {
		$module = Yii::$app->getModule('user');
		$loginField = $module->loginField;
		return User::findOne([$loginField => $this->$loginField, 'status' => 1]);
	}
	
}