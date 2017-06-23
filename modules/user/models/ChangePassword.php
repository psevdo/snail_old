<?php
namespace app\modules\user\models;

use Yii;

class ChangePassword extends \yii\base\Model {
	
	public $password;
	public $password_repeat;
	
	public function rules() {
		return [
			[['password', 'password_repeat'], 'required'],
			[['password', 'password_repeat'], 'string', 'min' => 2, 'max' => 10],
			['password_repeat', 'compare', 'compareAttribute' => 'password'],
		];
	}
	
	public function attributeLabels() {
		return [
			'password' => 'Новый пароль',
			'password_repeat' => 'Подтверждение пароля',
        ];
    }
	
	public function changePassword($userId) {
		$user = User::findOne($userId);
		
		$user->setPassword($this->password);
		$user->save();
		
		return true;
	}
	
}