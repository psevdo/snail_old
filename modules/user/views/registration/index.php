<?php
use yii\helpers\Html;
use yii\helpers\Url;
use \yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;
use app\modules\user\Module;
?>

<?php if(Yii::$app->session->getFlash('success')) { ?><?=Alert::widget(['options' => ['class' => 'alert-success'], 'body' => Yii::$app->session->getFlash('success')]);?><?php } ?>
<?php if(Yii::$app->session->getFlash('info')) { ?><?=Alert::widget(['options' => ['class' => 'alert-info'], 'body' => Yii::$app->session->getFlash('info')]);?><?php } ?>
<?php if(Yii::$app->session->getFlash('error')) { ?><?=Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => Yii::$app->session->getFlash('error')]);?><?php } ?>


<?php
	$form = ActiveForm::begin(['class' => 'form-horizontal']);
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

<?php if($module->activationByEmail && $module->loginField != 'email') { ?>
<?=$form->field($model, 'email', [
		'options' => ['class' => 'form-group has-feedback'],
		'inputOptions' => ['placeholder' => Module::t('user', 'EMAIL')],
		'template' => '{input}{error}{hint}<span class="glyphicon glyphicon-envelope form-control-feedback"></span>',
	])->textinput()?>
<?php } ?>

<?php if(!$module->autoGeneratePassword || ($module->loginField != 'email' && !$module->activationByEmail)) { ?>
<?=$form->field($model, 'password', [
		'options' => ['class' => 'form-group has-feedback'],
		'inputOptions' => ['placeholder' => Module::t('user', 'PASSWORD')],
		'template' => '{input}{error}{hint}<span class="glyphicon glyphicon-lock form-control-feedback"></span>',
	])->passwordInput()?>
	
<?=$form->field($model, 'password_repeat', [
		'options' => ['class' => 'form-group has-feedback'],
		'inputOptions' => ['placeholder' => Module::t('user', 'PASSWORD_REPEAT')],
		'template' => '{input}{error}{hint}<span class="glyphicon glyphicon-log-in form-control-feedback"></span>',
	])->passwordInput()?>
<?php } ?>

<?php
// echo '<pre>';
// print_r($model->getErrors());
// echo '</pre>';
?>
<div class="row">
	<div class="col-xs-7">
		<div class="checkbox icheck">
			<label><input type="checkbox"> <?=Module::t('user', 'I_AGREE_{0}', Html::a(Module::t('user', 'TERMS'), ['/']))?></label>
		</div>
	</div>
	<!-- /.col -->
	<div class="col-xs-5">
		<?=Html::submitButton(Module::t('user', 'REGISTRATION'), ['class' => 'btn btn-primary btn-block btn-flat'])?>
	</div>
	<!-- /.col -->
</div>

<?php
	ActiveForm::end();
?>

<div class="social-auth-links text-center">
	<p>- ИЛИ -</p>
	<?=Html::a('<i class="fa fa-facebook"></i> Sign up using Facebook', ['/'], ['class' => 'btn btn-block btn-social btn-facebook btn-flat'])?>
	<?=Html::a('<i class="fa fa-google-plus"></i> Sign up using Google+', ['/'], ['class' => 'btn btn-block btn-social btn-google btn-flat'])?>
	<!--<a href="#" class="btn btn-block btn-social btn-facebook btn-flat"></a>
	<a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using Google+</a>-->
</div>

<?=Html::a(Module::t('user', 'I_ALREADY_HAVE_ACC'), ['/user/login'], ['class' => 'text-center'])?>
