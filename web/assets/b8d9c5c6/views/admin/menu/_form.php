<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\modules\menu\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\menu\models\Menu */
/* @var $form yii\widgets\ActiveForm */

use app\modules\menu\Asset;

Asset::register($this);

$script = <<< JS
	$('#myTab a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	})
JS;
$this->registerJs($script, yii\web\View::POS_END);
?>

<div class="menu-form">
	<!-- http://bootstrap-3.ru/javascript.php#tabs -->
    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

	<ul class="nav nav-tabs" id="myTab">
		<li class="active"><a href="#general" data-toogle="tab">Главное</a></li>
		<li><a href="#items" data-toogle="tab">Пункты меню</a></li>
	</ul>
	
	<div class="tab-content">
		<div class="tab-pane active" id="general">
			<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'main')->checkbox(/*$options = [], $enclosedByLabel = true )(*/) ?>
		</div>
		<div class="tab-pane" id="items">
			test
		</div>
	</div>

	
			<?=Html::submitButton($model->isNewRecord ? Module::t('menu', 'CREATE') : Module::t('menu', 'UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
		

    <?php ActiveForm::end(); ?>

</div>


