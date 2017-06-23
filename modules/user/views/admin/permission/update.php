<?php
use app\modules\user\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\Role */

$this->title = Module::t('permission', 'UPDATE_PERMISSION: ').$model->name;
$this->params['breadcrumbs'][] = ['label' => Module::t('permission', 'PERMISSIONS'), 'url' => ['/user/admin/permission']];
$this->params['breadcrumbs'][] = Module::t('permission', 'UPDATE_PERMISSION: ').$model->name;
?>
<div class="permission-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
