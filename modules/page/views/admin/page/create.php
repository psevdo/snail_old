<?php

use yii\helpers\Html;
use yii\bootstrap\Alert;
use app\modules\page\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\page\models\Page */

$this->title = Module::t('page', 'CREATING_PAGE');
$this->params['breadcrumbs'][] = ['label' => Module::t('page', 'PAGES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php if(Yii::$app->session->getFlash('success')) { ?><?=Alert::widget(['options' => ['class' => 'alert-success'], 'body' => Yii::$app->session->getFlash('success')]);?><?php } ?>
<?php if(Yii::$app->session->getFlash('info')) { ?><?=Alert::widget(['options' => ['class' => 'alert-info'], 'body' => Yii::$app->session->getFlash('info')]);?><?php } ?>
<?php if(Yii::$app->session->getFlash('danger')) { ?><?=Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => Yii::$app->session->getFlash('danger')]);?><?php } ?>

<div class="page-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
