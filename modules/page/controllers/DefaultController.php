<?php

namespace app\modules\page\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use yii\helpers\Html;

/**
 * Default controller for the `page` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex(){
		$request = Yii::$app->request;
		echo '<pre>';
		print_r($request->get());
		echo '</pre>';
		die();
        return $this->render('index');
    }
	
}
