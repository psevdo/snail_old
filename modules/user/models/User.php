<?php
namespace app\modules\user\models;

use app\modules\user\Module;
use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface {
	
	const STATUS_NEW = 0;
	const STATUS_ACTIVE = 1;
	const STATUS_BLOCKED = 2;
	
	public static function tableName() {
		return '{{user}}';
	}
	
	public function rules() {
		$module = Yii::$app->getModule('user');
		// $this->_autoGeneratePassword = $module->autoGeneratePassword;
		
		$rules = [
			['status', 'required'],
			['status', 'integer'],
			['username', 'unique', 'targetClass' => 'app\modules\user\models\User'],
			['username', 'string', 'min' => 2, 'max' => 250],
			['email', 'unique', 'targetClass' => 'app\modules\user\models\User'],
			['email', 'email'],
			['phone', 'unique', 'targetClass' => 'app\modules\user\models\User'],
			// ['phone', 'validatePhone']
		];

		if($module->loginField == 'username') {
			$rules = array_merge($rules, [['username', 'required']]);
			if($module->activationByEmail) {
				$rules = array_merge($rules, [['email', 'required']]);
			}
		}
		if($module->loginField == 'email') {
			$rules = array_merge($rules, [['email', 'required']]);
		}
		if($module->loginField == 'phone') {
			$rules = array_merge($rules, [['phone', 'required']]);
			if($module->activationByEmail) {
				$rules = array_merge($rules, [['email', 'required']]);
			}
		}

		return $rules;
	}
	
	public function attributeLabels() {
        return [
            'id' => Module::t('user', 'ID'),
            'username' => Module::t('user', 'USERNAME'),
            'email' => Module::t('user', 'EMAIL'),
            'phone' => Module::t('user', 'PHONE'),
            'password' => Module::t('user', 'PASSWORD'),
            'status' => Module::t('user', 'STATUS'),
            'token' => Module::t('user', 'TOKEN'),
            'dataRegistration' => Module::t('user', 'DATA_REGISTRATION'),
        ];
    }
	
	public function setPassword($password) {
		$this->password = Yii::$app->getSecurity()->generatePasswordHash($password);
	}
	
	// автоматическая генерация пароля
	public function generatePassword($length = 10) {
		$chars = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvXxYyZz0123456789';
		$length = intval($length);
		$size = strlen($chars)-1;
		$password = '';
		while($length--) $password .= $chars[rand(0, $size)];
		$this->setPassword($password);
		
		return $password;
	}
	
	public function validatePassword($password) {
		return Yii::$app->getSecurity()->validatePassword($password, $this->password);
	}
	
	public static function findIdentity($id) {
		return self::findOne($id);
	}
	
	public function getId() {
		return $this->id;
	}
	
	public static function findIdentityByAccessToken($token, $type = null) {
	}
	
	public function getAuthKey() {
	}
	
	public function validateAuthKey($authKey) {
	}
	
	public static function getStatusArray() {
		return [
			self::STATUS_NEW => 'Новый',
			self::STATUS_ACTIVE => 'Активен',
			self::STATUS_BLOCKED => 'Заблокирован',
        ];
    }
	
}