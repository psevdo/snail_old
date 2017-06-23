<?php
use app\modules\user\Module;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\user\models\Role */

$this->title = Module::t('role', 'CREATING_ROLE');
$this->params['breadcrumbs'][] = ['label' => Module::t('role', 'ROLES'), 'url' => ['/user/admin/role']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-create">

    <?= $this->render('_form', [
        'model' => $model,
		'permissions' => $permissions,
    ]) ?>

</div>
