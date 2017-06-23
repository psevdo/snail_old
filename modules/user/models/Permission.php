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
class Permission extends \yii\db\ActiveRecord
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
    public function attributeLabels()
    {
        return [
            'name' => Module::t('permission', 'NAME'),
            'description' => Module::t('permission', 'DESCRIPTION'),
            // 'type' => Yii::t('app', 'TYPE'),
            // 'rule_name' => Yii::t('app', 'RULE_NAME'),
            // 'data' => Yii::t('app', 'DATA'),
            // 'created_at' => Yii::t('app', 'CREATED_AT'),
            // 'updated_at' => Yii::t('app', 'UPDATED_AT'),
        ];
    }
}
