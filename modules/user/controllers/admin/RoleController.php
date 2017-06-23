<?php

namespace app\modules\user\controllers\admin;

use Yii;
use app\modules\user\Module;
use app\modules\user\models\Role;
use app\modules\user\models\RoleSearch;
use app\modules\user\models\Permission;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class RoleController extends \app\controllers\AdminController {

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

	// список ролей
	public function actionIndex() {
		$searchModel = new RoleSearch();
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

    // добавление роли
    public function actionCreate() {
		$model = new Role();

		$permissions = Permission::find()->where(['type' => 2])->asArray()->all();
		
		if(Yii::$app->request->post('Role')) {
			$model->attributes = Yii::$app->request->post('Role');
			$model->type = 1;	// признак роли
			
			if($model->save() && $model->updatePermission($model->name, Yii::$app->request->post('permission'))) {
				Yii::$app->session->setFlash('success', Module::t('role', 'ROLE_ADD_SUCCESSFULL'));
				return $this->redirect(['/user/admin/role/update', 'id' => $model->name]);
			}
			else Yii::$app->session->setFlash('error', Module::t('role', 'ROLE_ADD_ERROR'));
		}

		return $this->render('create', [
			'model' => $model,
			'permissions' => ['avialable' => $permissions, 'awarded' => []],
		]);
    }

    // редактирование роли
	public function actionUpdate($id) {
		$model = $this->findModel($id);
		
		$rolePermissionsObj = Yii::$app->authManager->getPermissionsByRole($id);
		$rolePermissions = [];
		$permisNotIn = [];
		foreach($rolePermissionsObj as $key => $_permission) {
			$permisNotIn[] = $_permission->name;
			
			// делаем это только для универсальности,
			// т.к. rolePermissionsObj - это объект, а permissions - это массив
			$rolePermissions[$key] = [
				'name' => $_permission->name,
				'type' => $_permission->type,
				'description' => $_permission->description,
				'rule_name' => $_permission->ruleName,
				'data' => $_permission->data,
				'created_at' => $_permission->createdAt,
				'updated_at' => $_permission->updatedAt,
			];
		}
		
		$permissions = Permission::find()->where(['not in', 'name', $permisNotIn])->andwhere(['type' => 2])->asArray()->all();
		
		if($model->load(Yii::$app->request->post())) {
			if($model->save() && $model->updatePermission($model->name, Yii::$app->request->post('permission'))) {
				Yii::$app->session->setFlash('success', Module::t('role', 'ROLE_UPDATE_SUCCESSFULL'));
				return $this->redirect(['/user/admin/role/update', 'id' => $id]);
			} else {
				Yii::$app->session->setFlash('error', Module::t('role', 'ROLE_UPDATE_ERROR'));
			}
		}
		
		return $this->render('update', [
			'model' => $model,
			'permissions' => ['avialable' => $permissions, 'awarded' => $rolePermissions],
		]);
	}

    // удаление роли
	public function actionDelete($id) {
		$users = Yii::$app->authManager->getUserIdsByRole($id);

		if(!count($users)) {
			if($this->findModel($id)->delete()) Yii::$app->session->setFlash('success', Module::t('role', 'ROLE_DELETE_SUCCESSFULL'));
			else Yii::$app->session->setFlash('error', Module::t('role', 'ROLE_DELETE_ERROR'));
		} else {
			Yii::$app->session->setFlash('info', Module::t('role', 'ROLE_DELETE_IMPOSSIBLE'));
			Yii::$app->session->setFlash('error', Module::t('role', 'ROLE_DELETE_ERROR'));
		}

		return $this->redirect(['/user/admin/role']);
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
        if (($model = Role::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
