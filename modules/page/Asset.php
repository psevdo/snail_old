<?php
namespace app\modules\page;

use yii\web\AssetBundle;

class Asset extends AssetBundle {
	public $basePath = 'app\modules\page';
	public $baseUrl = '/modules/page/';
	public $css = [
		'css/style.css'
	];
	public $js = [];
}