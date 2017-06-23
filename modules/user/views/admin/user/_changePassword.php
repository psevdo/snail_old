<?php
use \yii\bootstrap\ActiveForm;

use yii\bootstrap\Alert;
use yii\helpers\Html;
use app\modules\user\Module;
?>

<?php if(Yii::$app->session->getFlash('successPassword')) { ?><?=Alert::widget(['options' => ['class' => 'alert-success'], 'body' => Yii::$app->session->getFlash('successPassword')]);?><?php } ?>
<?php if(Yii::$app->session->getFlash('infoPassword')) { ?><?=Alert::widget(['options' => ['class' => 'alert-info'], 'body' => Yii::$app->session->getFlash('infoPassword')]);?><?php } ?>
<?php if(Yii::$app->session->getFlash('errorPassword')) { ?><?=Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => Yii::$app->session->getFlash('errorPassword')]);?><?php } ?>

<div class="user-form change-password">

<?php $formPass = ActiveForm::begin(['layout' => 'horizontal']); ?>

	<?=$formPass->field($model, 'password')->passwordInput()?>
	<?=$formPass->field($model, 'password_repeat')->passwordInput(['class' => 'form-control input-xlarge']) ?>

	<div class="form-group">
		<label class="col-sm-3 control-label">&nbsp;</label>
		<div class="col-sm-6">
			<?=Html::submitButton(Module::t('user', 'CHANGE_PASSWORD'), ['name' => 'submitBtn', 'value' => 'btnChPass', 'class' => 'btn btn-primary'])?>
		</div>
    </div>

<?php ActiveForm::end(); ?>

</div>