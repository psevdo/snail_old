<?php

namespace app\modules\page\models;

use Yii;
use app\modules\page\Module;

/**
 * This is the model class for table "page".
 *
 * @property integer $id
 * @property string $name
 * @property string $title
 * @property string $text
 * @property integer $authorId
 * @property string $dateCreate
 * @property string $lastUpdate
 */
class Page extends \yii\db\ActiveRecord {
	
	const STATUS_DRAFT = 0;
	const STATUS_PUBLISHED = 1;
	
	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'page';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['name', 'title', 'text', 'authorId', 'status'], 'required'],
			[['text'], 'string'],
			[['authorId', 'status'], 'integer'],
			[['dateCreate', 'lastUpdate'], 'safe'],
			[['name', 'title'], 'string', 'max' => 200],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'id' => Module::t('page', 'ID'),
			'name' => Module::t('page', 'NAME'),
			'title' => Module::t('page', 'TITLE'),
			'text' => Module::t('page', 'TEXT'),
			'authorId' => Module::t('page', 'AUTHOR_ID'),
			'dateCreate' => Module::t('page', 'DATE_CREATE'),
			'lastUpdate' => Module::t('page', 'LAST_UPDATE'),
			'status' => Module::t('page', 'STATUS'),
		];
	}
	
	public static function getStatusArray() {
		return [
			self::STATUS_DRAFT => 'Черновик',
			self::STATUS_PUBLISHED => 'Опубликовано',
        ];
    }
	
	public function getAuthor() {
		return $this->hasOne(\app\modules\user\models\User::className(), ['id' => 'authorId']);
	}
	
}
