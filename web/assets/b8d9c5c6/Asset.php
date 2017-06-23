<?php
namespace app\modules\menu;

use yii\web\AssetBundle;

class Asset extends AssetBundle {
	public $sourcePath = '@app/modules/menu';
	// public $basePath = 'app\modules\menu';
	// public $baseUrl = '/modules/menu/';
	public $css = [
		'css/style.css'
	];
	public $js = [];
}