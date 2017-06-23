<?php
use app\modules\user\Module;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\Role */
/* @var $form yii\widgets\ActiveForm */
?>

<?php if(Yii::$app->session->getFlash('success')) { ?><?=Alert::widget(['options' => ['class' => 'alert-success'], 'body' => Yii::$app->session->getFlash('success')]);?><?php } ?>
<?php if(Yii::$app->session->getFlash('info')) { ?><?=Alert::widget(['options' => ['class' => 'alert-info'], 'body' => Yii::$app->session->getFlash('info')]);?><?php } ?>
<?php if(Yii::$app->session->getFlash('error')) { ?><?=Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => Yii::$app->session->getFlash('error')]);?><?php } ?>

<div class="role-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>



    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
	
	<?=$this->render('_permission', [
		'permissions' => $permissions,
	])?>


	
	<div class="form-group">
		<label class="col-sm-3 control-label">&nbsp;</label>
		<div class="col-sm-6">
			<?=Html::submitButton($model->isNewRecord ? Module::t('general', 'CREATE') : Module::t('general', 'UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
		</div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
