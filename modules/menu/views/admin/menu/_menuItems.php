<?php
use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;
?>

<?php
$script = <<< JS
	// запись значений в модальное окно при редактировании пункта меню
	$('#menuItemModal').on('show.bs.modal', function (e) {
		var parent = $(e.relatedTarget).parent().parent();
		$('#dataKey').val(parent.attr('data-key'));
		$(parent.children()).each(function(index) {
			if(index == 1) $('#titleModal').val($(this).text());
			if(index == 2) $('#linkModal').val($(this).text());
			if(index == 3) $('#posModal').val($(this).text());
			if(index == 4) if($(this).children('input.main').val() == 1) { $('#mainModal').prop('checked', true); }
		});
	});
	
	// сброс значений в модальном окне
	$('#menuItemModal').on('hide.bs.modal', function (e) {
		$('#dataKey').val('');
		$('#titleModal').val('');
		$('#linkModal').val('');
		$('#posModal').val('');
		$('#mainModal').prop('checked', false);
		$('#menuItemModal .form-group').each(function(index){
			$(this).removeClass('has-error').addClass('has-success');
			$(this).children('div').eq(0).children('.help-block').text('');
		});
	});
	
	// запись значений при сохранении модального окна
	$('#saveModal').on('click', function(){
		$('#w2').yiiActiveForm('validate');
		if($('div.has-error').length > 0) return false;
		
		var dataKey = $('#menuItemModal #dataKey').val();
		$('tr[data-key="' + dataKey + '"]').children().each(function(index) {
			if(index == 1) { $(this).children('input.title').val($('#titleModal').val()); $(this).children('span').text($('#titleModal').val()); }
			if(index == 2) { $(this).children('input.link').val($('#linkModal').val()); $(this).children('span').text($('#linkModal').val()); }
			if(index == 3) { $(this).children('input.pos').val($('#posModal').val()); $(this).children('span').text($('#posModal').val()); }
			if(index == 4) {
				if($('#mainModal').prop('checked')) {
					if($(this).children('span.glyphicon-ok').length == 0)
						$(this).prepend('<span style="color: #449d44" class="glyphicon glyphicon-ok"></span>');
					$(this).children('input.main').val('1');
				} else {
					if($(this).children('span.glyphicon-ok').length > 0)
						$(this).children('span.glyphicon-ok').remove();
					$(this).children('input.main').val('0');
				}
			}
		});
		
		$('#menuItemModal').modal('hide');
	});
JS;
$this->registerJs($script, yii\web\View::POS_END);
?>

<?= GridView::widget([
	'dataProvider' => $dataProvider,
	'filterModel' => $searchModel,
	'columns' => [
		['class' => 'yii\grid\SerialColumn'],

		[
			'attribute' => 'title',
			'label' => 'Title',
			'content' => function($data){
				return '<span>'.$data->title.'</span>'.Html::hiddenInput('MenuItems[id][]', $data->id, []).Html::hiddenInput('MenuItems[title][]', $data->title, ['class' => 'title']);
			}
		],
		[
			'attribute' => 'link',
			'label' => 'Link',
			'content' => function($data){
				return '<span>'.$data->link.'</span>'.Html::hiddenInput('MenuItems[link][]', $data->link, ['class' => 'link']);
			}
		],
		[
			'attribute' => 'pos',
			'label' => 'Pos',
			'content' => function($data){
				return '<span>'.$data->pos.'</span>'.Html::hiddenInput('MenuItems[pos][]', $data->pos, ['class' => 'pos']);
			}
		],
		[
			'attribute' => 'main',
			'label' => 'Main',
			'content' => function($data) {
				if($data->main == 1) return '<span style="color: #449d44" class="glyphicon glyphicon-ok"></span>'.Html::hiddenInput('MenuItems[main][]', $data->main, ['class' => 'main']);
				else return Html::hiddenInput('MenuItems[main][]', $data->main, ['class' => 'main']);
			},
			'filter' => false
		],
		[
			'class' => 'yii\grid\ActionColumn',
			'template' => '{update} {delete}',
			'buttons' => [
				'update' => function ($url,$model) {
					return Html::a(
					'<span class="glyphicon glyphicon-pencil"></span>', 
					'#',
					[
						'data-toggle' => 'modal',
						'data-target' => '.bs-example-modal-lg',
					]);
				},
				'delete' => function ($url,$model) {
					return Html::a(
					'<span class="glyphicon glyphicon-trash"></span>', 
					$url);
				},
			],
		],
	],
]); ?>


