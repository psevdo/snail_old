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
	$('#tab a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	});
	
	// $('.btn-primary').bind('click', function(){
		// $('.bs-example-modal-lg').modal({
			// keyboard: false
		// })
	// });
JS;
$this->registerJs($script, yii\web\View::POS_END);
?>

<div class="menu-form">
    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

	<ul class="nav nav-tabs" id="tab">
		<li class="<?=((isset($_COOKIE['adminMenuTab']) && $_COOKIE['adminMenuTab'] == 'general') || !isset($_COOKIE['adminMenuTab']))? 'active' : ''?>" onClick="$.cookie('adminMenuTab', 'general', {expires: 1, path: '/' });"><a href="#general" data-toogle="tab">Главное</a></li>
		<?php if(!$model->isNewRecord) { ?><li class="<?=(isset($_COOKIE['adminMenuTab']) && $_COOKIE['adminMenuTab'] == 'items')? 'active' : ''?>" onClick="$.cookie('adminMenuTab', 'items', {expires: 1, path: '/' });"><a href="#items" data-toogle="tab">Пункты меню</a></li><?php } ?>
	</ul>
	
	<div class="tab-content">
		<div class="tab-pane <?=((isset($_COOKIE['adminMenuTab']) && $_COOKIE['adminMenuTab'] == 'general') || !isset($_COOKIE['adminMenuTab']))? 'active' : ''?>" id="general">
			<?=$form->field($model, 'name')->textInput(['maxlength' => true])?>
			<?=$form->field($model, 'description')->textInput(['maxlength' => true])?>
			<?=$form->field($model, 'main')->checkbox() ?>
		</div>
		<?php if(!$model->isNewRecord) { ?>
		<div class="tab-pane <?=(isset($_COOKIE['adminMenuTab']) && $_COOKIE['adminMenuTab'] == 'items')? 'active' : ''?>" id="items">
			<?=$this->render('_menuItems', [
				'model' => $model,
				'menuItemsModel' => $menuItemsModel,
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
			])?>
		</div>
		<?php } ?>
	</div>

	<?=Html::submitButton($model->isNewRecord ? Module::t('menu', 'CREATE') : Module::t('menu', 'UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
    <?php ActiveForm::end(); ?>

</div>
http://www.yiiframework.ru/forum/viewtopic.php?t=37086
<div class="modal fade bs-example-modal-lg" id="menuItemModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<?php $menuItemsForm = ActiveForm::begin(['layout' => 'horizontal',
				'enableAjaxValidation' => false,
				'enableClientValidation' => true,
				'validateOnBlur' => true,
				'validateOnType' => true,
				'validateOnChange' => true,
				'validateOnSubmit' => false,
				'validationDelay' => 50,
			]); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Название модали</h4>
			</div>
			<div class="modal-body">
				<?=$menuItemsForm->field($menuItemsModel, 'title')->textInput(['id' => 'titleModal'])?>
				<?=$menuItemsForm->field($menuItemsModel, 'link')->textInput(['id' => 'linkModal'])?>
				<?=$menuItemsForm->field($menuItemsModel, 'pos')->textInput(['id' => 'posModal'])?>
				<?=$menuItemsForm->field($menuItemsModel, 'main')->checkbox(['id' => 'mainModal']) ?>
				<?=Html::hiddenInput ('dataKey', '', ['id' => 'dataKey']);?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
				<button type="button" class="btn btn-primary" id="saveModal">Сохранить изменения</button>
			</div>
			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>


