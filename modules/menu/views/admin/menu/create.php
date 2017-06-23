<?php

use yii\helpers\Html;
use yii\bootstrap\Alert;
use app\modules\menu\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\menu\models\Menu */

$this->title = Module::t('menu', 'CREATE_MENU');
$this->params['breadcrumbs'][] = ['label' => Module::t('menu', 'MENUS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php if(Yii::$app->session->getFlash('success')) { ?><?=Alert::widget(['options' => ['class' => 'alert-success'], 'body' => Yii::$app->session->getFlash('success')]);?><?php } ?>
<?php if(Yii::$app->session->getFlash('info')) { ?><?=Alert::widget(['options' => ['class' => 'alert-info'], 'body' => Yii::$app->session->getFlash('info')]);?><?php } ?>
<?php if(Yii::$app->session->getFlash('danger')) { ?><?=Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => Yii::$app->session->getFlash('danger')]);?><?php } ?>

<div class="menu-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
