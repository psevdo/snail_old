<?php
use app\modules\user\Module;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\user\models\Role */

$this->title = Module::t('permission', 'CREATING_PERMISSION');
$this->params['breadcrumbs'][] = ['label' => Module::t('permission', 'PERMISSIONS'), 'url' => ['/user/admin/permission']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permission-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
