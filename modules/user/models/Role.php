<?php

namespace app\modules\user\models;

use Yii;
use app\modules\user\Module;

/**
 * This is the model class for table "auth_item".
 *
 * @property string $name
 * @property integer $type
 * @property string $description
 * @property string $rule_name
 * @property resource $data
 * @property integer $created_at
 * @property integer $updated_at
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['name'], 'unique'],
            [['type', 'created_at', 'updated_at'], 'integer'],
            [['description', 'data'], 'string'],
            [['name', 'rule_name'], 'string', 'max' => 64],
            [['rule_name'], 'exist', 'skipOnError' => true, 'targetClass' => AuthRule::className(), 'targetAttribute' => ['rule_name' => 'name']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'name' => Module::t('role', 'NAME'),
            'description' => Module::t('role', 'DESCRIPTION'),
            // 'type' => Yii::t('app', 'TYPE'),
            // 'rule_name' => Yii::t('app', 'RULE_NAME'),
            // 'data' => Yii::t('app', 'DATA'),
            // 'created_at' => Yii::t('app', 'CREATED_AT'),
            // 'updated_at' => Yii::t('app', 'UPDATED_AT'),
        ];
    }
	
	// public function updatePermission($permissions){
	public function updatePermission($role, $permissionsPost){
		// echo '<pre><br /><br /><br /><br />';
		// print_r($permissions);
		// print_r($permissionsPost);
		// echo '</pre>';
		$role = Yii::$app->authManager->getRole($role);
		Yii::$app->authManager->removeChildren($role);
		
		if(count($permissionsPost)){
			foreach($permissionsPost as $_permission){
				$permission = Yii::$app->authManager->getPermission($_permission);
				Yii::$app->authManager->addChild($role, $permission);
			}
		}
		
		return true;
	}
}
