<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class TransliteAsset extends AssetBundle {
    public $basePath = '@webroot/include/translite';
    public $baseUrl = '@web/include/translite';
    public $css = [
    ];
    public $js = [
		'translite.plugin.js'
    ];
	public $depends = [
		'yii\web\JqueryAsset'
	];
}
