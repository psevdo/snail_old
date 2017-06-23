<?php

namespace app\modules\menu\controllers\admin;

use Yii;
use app\modules\menu\Module;
use app\modules\menu\models\Menu;
use app\modules\menu\models\MenuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MenuController implements the CRUD actions for Menu model.
 */
class MenuController extends \app\controllers\AdminController {
	/**
	 * @inheritdoc
	 */
	public function behaviors() {
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['POST'],
				],
			],
		];
	}

	/**
	 * Lists all Menu models.
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel = new MenuSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Menu model.
	 * @param string $id
	 * @return mixed
	 */
	public function actionView($id) {
		return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new Menu model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new Menu();

		if($model->load(Yii::$app->request->post())) {
			// главный модуль может быть только один
			$this->_onlyOneMainMenu(null, $model->main);
			
			if($model->save()) {
				Yii::$app->session->setFlash('success', Module::t('menu', 'RECORD_CREATE_SUCCESSFULL'));
				return $this->redirect(['update', 'id' => $model->name]);
			}
		}

		return $this->render('create', [
			'model' => $model,
		]);
	}

	/**
	 * Updates an existing Menu model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param string $id
	 * @return mixed
	 */
	public function actionUpdate($id) {
		$model = $this->findModel($id);

		if($model->load(Yii::$app->request->post())) {
			// главный модуль может быть только один
			$this->_onlyOneMainMenu($model->name, $model->main);
			
			if($model->save()) {
				Yii::$app->session->setFlash('success', Module::t('menu', 'RECORD_UPDATE_SUCCESSFULL'));
				return $this->redirect(['update', 'id' => $model->name]);
			}
		}

		return $this->render('update', [
			'model' => $model,
		]);
	}
	
	// подготавливаем "площадку" для регистрации меню главным
	protected function _onlyOneMainMenu($menu, $main) {
		if($main == '0') return true;
		
		$currentMain = Menu::findOne(['main' => 1]);
		if($currentMain === NULL || $menu == $currentMain->name) return true;
		
		$currentMain->main = 0;
		$currentMain->save();
		return true;
	}

	/**
	 * Deletes an existing Menu model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param string $id
	 * @return mixed
	 */
	public function actionDelete($id) {
		if($this->findModel($id)->delete()) {
			Yii::$app->session->setFlash('success', Module::t('menu', 'RECORD_DELETE_SUCCESSFULL'));
			
			// если нет главного меню, то сообщаем об этом
			$count = Menu::find()->where(['main' => 1])->count();
			if($count == 0) Yii::$app->session->setFlash('info', Module::t('menu', 'NO_MAIN_MENU'));
		}
		else
			Yii::$app->session->setFlash('success', Module::t('menu', 'RECORD_DELETE_ERROR'));
		
		return $this->redirect(['index']);
	}

	/**
	 * Finds the Menu model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param string $id
	 * @return Menu the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = Menu::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
