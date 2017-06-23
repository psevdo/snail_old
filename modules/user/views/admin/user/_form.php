<?php
use app\modules\user\Module;
use app\modules\user\models\User;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;
?>

<?php if(Yii::$app->session->getFlash('success')) { ?><?=Alert::widget(['options' => ['class' => 'alert-success'], 'body' => Yii::$app->session->getFlash('success')]);?><?php } ?>
<?php if(Yii::$app->session->getFlash('info')) { ?><?=Alert::widget(['options' => ['class' => 'alert-info'], 'body' => Yii::$app->session->getFlash('info')]);?><?php } ?>
<?php if(Yii::$app->session->getFlash('error')) { ?><?=Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => Yii::$app->session->getFlash('error')]);?><?php } ?>

<div class="user-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?=$form->field($model, 'username')->textInput(['maxlength' => true])?>
	<?php if($module->activationByEmail && $module->loginField != 'email') { ?>
    <?=$form->field($model, 'email')->textInput(['maxlength' => true])?>
	<?php } ?>
    <?=$form->field($model, 'phone')->textInput(['maxlength' => true])?>
    <?=$form->field($model, 'status')->dropDownList(User::getStatusArray())?>
    <?=$form->field($model, 'dataRegistration')->textInput(['readonly' => 'readonly'])?>

	<div class="form-group">
		<label class="col-sm-3 control-label">&nbsp;</label>
		<div class="col-sm-6">
			<?=Html::submitButton($model->isNewRecord ? Module::t('general', 'CREATE') : Module::t('general', 'UPDATE'), ['name' => 'submitBtn', 'value' => 'btnSave', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
		</div>
    </div>

    <?php ActiveForm::end('Сохранить'); ?>

</div>
