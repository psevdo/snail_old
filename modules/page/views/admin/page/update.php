<?php

use yii\helpers\Html;
use yii\bootstrap\Alert;
use app\modules\page\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\page\models\Page */

use app\modules\page\Asset;
Asset::register($this);

$this->title = Module::t('page', 'EDITING: ').'"'.$model->title.'"';
$this->params['breadcrumbs'][] = ['label' => Module::t('page', 'PAGES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->title;
?>

<?php if(Yii::$app->session->getFlash('success')) { ?><?=Alert::widget(['options' => ['class' => 'alert-success'], 'body' => Yii::$app->session->getFlash('success')]);?><?php } ?>
<?php if(Yii::$app->session->getFlash('info')) { ?><?=Alert::widget(['options' => ['class' => 'alert-info'], 'body' => Yii::$app->session->getFlash('info')]);?><?php } ?>
<?php if(Yii::$app->session->getFlash('danger')) { ?><?=Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => Yii::$app->session->getFlash('danger')]);?><?php } ?>

<div class="page-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
