<?php
use yii\helpers\Html;
use yii\helpers\Url;
use \yii\bootstrap\ActiveForm;
use app\modules\user\Module;

$this->title = Module::t('user', 'AUTHORISATION');
?>

<?php
	$form = ActiveForm::begin([
		'class' => 'form-horizontal',
	]);
?>

<?php
switch($module->loginField) {
	case 'username': $placeholder = Module::t('user', 'USERNAME'); $icon = 'glyphicon glyphicon-user'; break;
	case 'email': $placeholder = Module::t('user', 'EMAIL'); $icon = 'glyphicon glyphicon-envelope'; break;
	case 'phone': $placeholder = Module::t('user', 'PHONE'); $icon = 'glyphicon glyphicon-earphone'; break;
}
?>
<?=$form->field($model, $module->loginField, [
		'options' => ['class' => 'form-group has-feedback'],
		'inputOptions' => ['placeholder' => $placeholder],
		'template' => '{input}{error}{hint}<span class="'.$icon.' form-control-feedback"></span>',
	])->textinput()?>
<?=$form->field($model, 'password', [
		'options' => ['class' => 'has-feedback'],
		'inputOptions' => ['placeholder' => Module::t('user', 'PASSWORD')],
		'template' => '{input}{error}{hint}<span class="glyphicon glyphicon-lock form-control-feedback"></span>'
	])->passwordInput()?>

<div class="row">
	<div class="col-xs-8">
		<div class="checkbox icheck">
			<label><input type="checkbox"> <?=Module::t('user', 'REMEMBER_ME')?></label>
		</div>
	</div>
	<!-- /.col -->
	<div class="col-xs-4"><?=Html::submitButton(Module::t('user', 'LOGIN'), ['class' => 'btn btn-primary btn-block btn-flat'])?></div>
	<!-- /.col -->
</div>
<?php
	ActiveForm::end();
?>

<div class="social-auth-links text-center">
	<p>- ИЛИ -</p>
	<?=Html::a('<i class="fa fa-facebook"></i> Sign in using Facebook', ['/'], ['class' => 'btn btn-block btn-social btn-facebook btn-flat'])?>
	<?=Html::a('<i class="fa fa-google-plus"></i> Sign in using Google+', ['/'], ['class' => 'btn btn-block btn-social btn-google btn-flat'])?>
</div>
<!-- /.social-auth-links -->

<?php if($module->recoveryPassword && ($module->loginField == 'email' || $module->activationByEmail)) { ?>
<?=Html::a(Module::t('user', 'PASSWORD_RECOVERY'), ['/user/login/recoverypassword'], ['class' => 'text-center'])?><br>
<?php } ?>
<?=Html::a(Module::t('user', 'REGISTER_MEMBERSHIP'), ['/user/registration'], ['class' => 'text-center'])?>