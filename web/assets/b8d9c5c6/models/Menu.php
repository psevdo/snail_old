<?php

namespace app\modules\menu\models;

use Yii;
use app\modules\menu\Module;

/**
 * This is the model class for table "menu".
 *
 * @property string $name
 * @property string $description
 * @property integer $main
 */
class Menu extends \yii\db\ActiveRecord {
	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'menu';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['name'], 'required'],
			[['main'], 'integer'],
			[['name', 'description'], 'string', 'max' => 200],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'name' => Module::t('menu', 'NAME'),
			'description' => Module::t('menu', 'DESCRIPTION'),
			'main' => Module::t('menu', 'MAIN'),
		];
	}
}
