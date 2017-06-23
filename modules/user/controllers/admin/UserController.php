<?php

namespace app\modules\user\controllers\admin;

use Yii;
use app\modules\user\Module;
use app\modules\user\models\User;
use app\modules\user\models\UserSearch;
use app\modules\user\models\ChangePassword;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends \app\controllers\AdminController {
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
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'actions' => ['index', 'create', 'update', 'delete', 'changepassword'],
						'allow' => true,
						'roles' => ['admin']
					]
				]
			]
		];
	}

	/**
	 * Lists all User models.
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel = new UserSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single User model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id) {
		return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new User model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {
		$module = Yii::$app->getModule('user');
		$model = new User();

		if($model->load(Yii::$app->request->post())) {
			$password = $model->generatePassword();
			$model->setPassword($password);
			
			if($model->save()) {
				Yii::$app->session->setFlash('info', Module::t('user', 'PASSWORD').': '.$password);
				Yii::$app->session->setFlash('success', Module::t('user', 'USER_CREATE_SUCCESSFULL'));
				return $this->redirect(['/user/admin/user/update', 'id' => $model->id]);
			} else {
				Yii::$app->session->setFlash('error', Module::t('user', 'USER_CREATE_ERROR'));
			}
		}
		
		return $this->render('create', [
			'module' => $module,
			'model' => $model,
		]);
	}

	/**
	 * Updates an existing User model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id) {
		$module = Yii::$app->getModule('user');
		$model = $this->findModel($id);
		$modelChPass = new ChangePassword();

		if($model->load(Yii::$app->request->post()) && Yii::$app->request->post('submitBtn') == 'btnSave') {
			if($model->save()) {
				Yii::$app->session->setFlash('success', Module::t('user', 'USER_UPDATE_SUCCESSFULL'));
				return $this->redirect(['/user/admin/user/update', 'id' => $id]);
			} else {
				Yii::$app->session->setFlash('error', Module::t('user', 'USER_UPDATE_ERROR'));
			}
		}
		
		if($modelChPass->load(Yii::$app->request->post()) && Yii::$app->request->post('submitBtn') == 'btnChPass') {
			if ($modelChPass->changePassword($id)) {
				Yii::$app->session->setFlash('successPassword', Module::t('user', 'USER_PASSWORD_CHANGE_SUCCESSFULL'));
				return $this->redirect(['/user/admin/user/update', 'id' => $id]);
			} else {
				Yii::$app->session->setFlash('errorPassword', Module::t('user', 'USER_PASSWORD_CHANGE_ERROR'));
			}
		}
		
		return $this->render('update', [
			'module' => $module,
			'model' => $model,
			'modelChPass' => $modelChPass
		]);
	}

	/**
	 * Deletes an existing User model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id) {
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	/**
	 * Finds the User model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return User the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = User::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
	
	/*
	public function actionChangepassword() {
		
		$model = new ChangePassword();

		if ($model->load(Yii::$app->request->post())) {
			if ($model->changePassword(Yii::$app->user->id)) {
				// return $this->redirect(['view', 'id' => $model->id]);
				echo 'ok';
			} else {
				echo 'er';
			}
		}

		return $this->render('changePassword', [
			'model' => $model,
		]);

	}
	*/
	
}
