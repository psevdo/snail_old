<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\page\Module;
use app\modules\page\models\Page;

/* @var $this yii\web\View */
/* @var $model app\modules\page\models\Page */
/* @var $form yii\widgets\ActiveForm */

use app\assets\CKEditorAsset;
use app\assets\TransliteAsset;

CKEditorAsset::register($this);
TransliteAsset::register($this);

$script = <<< JS
	var pageTextCKE = CKEDITOR.replace('page-text');
	
	pageTextCKE.on('blur', function(e) {
		pageTextCKE.updateElement();
	});
	
	$(function(){		
		$('#page-title').translite({
			'dstFieldId' : 'page-name'
		});
		
	});
JS;
$this->registerJs($script, yii\web\View::POS_END);
?>

<div class="page-form">

    <?php $form = ActiveForm::begin([
		'options' => ['class' => 'form-horizontal'],
		'fieldConfig' => [
			'template' => '{label}<div class="col-sm-10">{input}</div><div class="col-sm-10">{error}</div>',
			'labelOptions' => ['class' => 'col-sm-2 control-label'],
		],
	]); ?>

    <?=$form->field($model, 'title')->textInput(['maxlength' => true])?>
    <?=$form->field($model, 'name')->textInput(['maxlength' => true, 'readonly' => 'readonly'])?>
    <?=$form->field($model, 'text')->textarea(['rows' => 6])?>
	<?=$form->field($model, 'status')->dropDownList(Page::getStatusArray())?>
	<?php if(!$model->isNewRecord) { ?>
	<?php $userModule = Yii::$app->getModule('user'); $userLoginField = $userModule->loginField; ?>
    <?=$form->field($model, 'author')->textInput(['value' => $model->author->$userLoginField, 'readonly' => 'readonly'])?>
	<?php } ?>
    <?=$form->field($model, 'dateCreate')->textInput(['readonly' => 'readonly'])?>
    <?=$form->field($model, 'lastUpdate')->textInput(['readonly' => 'readonly'])?>

    <div class="form-group">
		<label class="col-sm-2 control-label">&nbsp;</label>
		<div class="col-sm-10">
			<?=Html::submitButton($model->isNewRecord ? Module::t('page', 'CREATE') : Module::t('page', 'UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
		</div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
