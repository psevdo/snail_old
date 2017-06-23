<?php
use app\modules\user\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */

$loginField = $module->loginField;
$this->title = Module::t('user', 'UPDATE_USER: ').$model->$loginField;
$this->params['breadcrumbs'][] = ['label' => Module::t('user', 'USERS'), 'url' => ['/user/admin/user']];
$this->params['breadcrumbs'][] = Module::t('user', 'UPDATE_USER: ').$model->$loginField;
?>
<div class="user-update">

    <?=$this->render('_form', [
        'module' => $module,
        'model' => $model,
    ])?>
	
	<hr style="border-color: #c0bebe;" />
	
	<?=$this->render('_changePassword', [
		'model' => $modelChPass
    ])?>

</div>
