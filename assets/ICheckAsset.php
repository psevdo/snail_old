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
class ICheckAsset extends AssetBundle
{
    public $basePath = '@webroot/include/iCheck';
    public $baseUrl = '@web/include/iCheck';
    public $css = [
		'square/blue.css'
    ];
    public $js = [
		'icheck.min.js'
    ];
}
