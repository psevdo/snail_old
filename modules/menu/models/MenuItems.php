<?php

namespace app\modules\menu\models;

use Yii;

/**
 * This is the model class for table "menu_items".
 *
 * @property integer $id
 * @property string $menu
 * @property string $title
 * @property integer $pos
 * @property integer $pid
 */
class MenuItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menu', 'title', 'pos', 'pid'], 'required'],
            [['pos', 'pid'], 'integer'],
            [['menu', 'title'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'menu' => Yii::t('app', 'Menu'),
            'title' => Yii::t('app', 'Title'),
            'pos' => Yii::t('app', 'Pos'),
            'pid' => Yii::t('app', 'Pid'),
        ];
    }
}
