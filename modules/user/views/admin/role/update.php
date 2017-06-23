<?php
use app\modules\user\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\Role */

$this->title = Module::t('role', 'UPDATE_ROLE: ').$model->name;
$this->params['breadcrumbs'][] = ['label' => Module::t('role', 'ROLES'), 'url' => ['/user/admin/role']];
$this->params['breadcrumbs'][] = Module::t('role', 'UPDATE_ROLE: ').$model->name;
?>
<div class="role-update">

    <?=$this->render('_form', [
        'model' => $model,
		'permissions' => $permissions,
    ])?>

</div>
