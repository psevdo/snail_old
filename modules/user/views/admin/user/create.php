<?php
use app\modules\user\Module;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */

$this->title = Module::t('user', 'CREATING_USER');
$this->params['breadcrumbs'][] = ['label' => Module::t('user', 'USERS'), 'url' => ['/user/admin/user']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <?= $this->render('_form', [
        'module' => $module,
        'model' => $model,
    ]) ?>

</div>
