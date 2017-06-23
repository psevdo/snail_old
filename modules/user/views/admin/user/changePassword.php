<?php
use \yii\widgets\ActiveForm;

use yii\bootstrap\Alert;
use app\modules\user\Module;
?>
<br /><br /><br />
<h1>Смена пароля</h1>

<?php if(Yii::$app->session->getFlash('success')) { ?><?=Alert::widget(['options' => ['class' => 'alert-success'], 'body' => Yii::$app->session->getFlash('success')]);?><?php } ?>
<?php if(Yii::$app->session->getFlash('info')) { ?><?=Alert::widget(['options' => ['class' => 'alert-info'], 'body' => Yii::$app->session->getFlash('info')]);?><?php } ?>
<?php if(Yii::$app->session->getFlash('error')) { ?><?=Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => Yii::$app->session->getFlash('error')]);?><?php } ?>


<?php
	$form = ActiveForm::begin(['class' => 'form-horizontal']);
?>

<?=$form->field($model, 'password')->passwordInput()?>
<?=$form->field($model, 'password_repeat')->passwordInput(['class' => 'form-control input-xlarge']) ?>

<div>
	<button type="submit" class="btn btn-primary"><?=Module::t('user', 'REGISTRATION_GO')?></button>
</div>
<?php
	ActiveForm::end();
?>