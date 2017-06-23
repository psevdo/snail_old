<?php

// возвращает список доступных модулей
function moduleList(){
	$dirs = scandir(dirname(__DIR__).'/modules');
	$modules = [];
	foreach($dirs as $_dir){
		if($_dir == '.' || $_dir == '..') continue;
		
		$modules[$_dir] = ['class' => 'app\modules\\'.$_dir.'\Module'];
	}
	return $modules;
}