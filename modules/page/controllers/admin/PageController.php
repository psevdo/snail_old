<?php

namespace app\modules\page\controllers\admin;

use Yii;
use app\controllers\AdminController;
use app\modules\page\Module;
use app\modules\page\models\Page;
use app\modules\page\models\PageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PageController implements the CRUD actions for Page model.
 */
class PageController extends AdminController{
	
	// public $backendLinks = [];
	
	/**
	 * @inheritdoc
	 */
	public function behaviors(){
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
	 * Lists all Page models.
	 * @return mixed
	 */
	public function actionIndex(){
		$searchModel = new PageSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Page model.
	 * @param integer $id
	 * @return mixed
	 */
	// public function actionView($id){
		// return $this->render('view', [
			// 'model' => $this->findModel($id),
		// ]);
	// }

	/**
	 * Creates a new Page model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate(){
		$model = new Page();

		if($model->load(Yii::$app->request->post())) {
			// $model->authorId = Yii::$app->user->id;
			$model->authorId = 1;
			if($model->save()) {
				Yii::$app->session->setFlash('success', Module::t('page', 'RECORD_CREATE_SUCCESSFULL'));
				return $this->redirect(['update', 'id' => $model->id]);
			} else {
				Yii::$app->session->setFlash('danger', Module::t('page', 'RECORD_CREATE_ERROR'));
			}
		}
		
		return $this->render('create', [
			'model' => $model,
		]);
	}

	/**
	 * Updates an existing Page model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id){
		$model = $this->findModel($id);

		if($model->load(Yii::$app->request->post())) {
			// $model->title='';
			if($model->save()) {
				Yii::$app->session->setFlash('success', Module::t('page', 'RECORD_UPDATE_SUCCESSFULL'));
				return $this->redirect(['update', 'id' => $model->id]);
			} else {
				Yii::$app->session->setFlash('danger', Module::t('page', 'RECORD_UPDATE_ERROR'));
			}
		}
		
		return $this->render('update', [
			'model' => $model,
		]);

	}

	/**
	 * Deletes an existing Page model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id){
		if($this->findModel($id)->delete()) {
			Yii::$app->session->setFlash('success', Module::t('page', 'RECORD_DELETE_SUCCESSFULL'));
		} else {
			Yii::$app->session->setFlash('danger', Module::t('page', 'RECORD_DELETE_ERROR'));
		}

		return $this->redirect(['index']);
	}

	/**
	 * Finds the Page model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Page the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id){
		// if (($model = Page::findOne($id)) !== null) {
		if (($model = Page::find()->with('author')->where(['id' => $id])->one()) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
