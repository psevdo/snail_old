<?php

namespace app\modules\user\controllers\admin;

use Yii;
use app\modules\user\Module;
use app\modules\user\models\Permission;
use app\modules\user\models\PermissionSearch;
use app\modules\user\models\AuthItemChild;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class PermissionController extends \app\controllers\AdminController {

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
						'actions' => ['index', 'create', 'update', 'delete'],
						'allow' => true,
						'roles' => ['admin']
					]
				]
			]
		];
	}

	// список разрешений
	public function actionIndex() {
		$searchModel = new PermissionSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

    /**
     * Displays a single Role model.
     * @param string $id
     * @return mixed
     */
	/*
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
	*/

    // добавление разрешения
    public function actionCreate() {
		$model = new Permission();

		if(Yii::$app->request->post('Permission')) {
			$model->attributes = Yii::$app->request->post('Permission');
			$model->type = 2;	// признак разрешения
			
			if($model->save()) {
				Yii::$app->session->setFlash('success', Module::t('permission', 'PERMISSION_ADD_SUCCESSFULL'));
				return $this->redirect(['/user/admin/permission/update', 'id' => $model->name]);
			}
			else Yii::$app->session->setFlash('error', Module::t('permission', 'PERMISSION_ADD_ERROR'));
		}

		return $this->render('create', [
			'model' => $model,
		]);
    }

    // редактирование разрешения
	public function actionUpdate($id) {
		$model = $this->findModel($id);

		if($model->load(Yii::$app->request->post())) {
			if($model->save()) {
				Yii::$app->session->setFlash('success', Module::t('permission', 'PERMISSION_UPDATE_SUCCESSFULL'));
				return $this->redirect(['/user/admin/permission/update', 'id' => $id]);
			} else {
				Yii::$app->session->setFlash('error', Module::t('permission', 'PERMISSION_UPDATE_ERROR'));
			}
		}
		
		return $this->render('update', [
			'model' => $model,
		]);
	}

    // удаление разрешения
	public function actionDelete($id) {
		$count = AuthItemChild::find()->where(['child' => $id])->count();
		
		if($count == 0) {
			if($this->findModel($id)->delete()) Yii::$app->session->setFlash('success', Module::t('permission', 'PERMISSION_DELETE_SUCCESSFULL'));
			else Yii::$app->session->setFlash('error', Module::t('permission', 'PERMISSION_DELETE_ERROR'));
		} else {
			// нельзя удалить разрешение, которое уже за кем то закреплено
			Yii::$app->session->setFlash('info', Module::t('permission', 'PERMISSION_DELETE_IMPOSSIBLE'));
			Yii::$app->session->setFlash('error', Module::t('permission', 'PERMISSION_DELETE_ERROR'));
		}

		return $this->redirect(['/user/admin/permission']);
	}

    /**
     * Finds the Role model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Role the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Permission::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
