<?php
use \yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Alert;
use app\modules\user\Module;
?>
<br /><br /><br />
<h1><?=Module::t('user', 'PASSWORD_RECOVERY')?></h1>

<?php if(Yii::$app->session->getFlash('success')) { ?><?=Alert::widget(['options' => ['class' => 'alert-success'], 'body' => Yii::$app->session->getFlash('success')]);?><?php } ?>
<?php if(Yii::$app->session->getFlash('info')) { ?><?=Alert::widget(['options' => ['class' => 'alert-info'], 'body' => Yii::$app->session->getFlash('info')]);?><?php } ?>
<?php if(Yii::$app->session->getFlash('error')) { ?><?=Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => Yii::$app->session->getFlash('error')]);?><?php } ?>

<?php
	$form = ActiveForm::begin(['class' => 'form-horizontal']);
?>
<?=$form->field($model, $module->loginField)->textinput()?>
<div>
	<button type="submit" class="btn btn-primary"><?=Module::t('user', 'RECOVERY')?></button>
</div>
<?php
	ActiveForm::end();
?>

