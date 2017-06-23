<?php
use yii\helpers\Html;

$this->registerJsFile(
	'@web/js/moveselectplugin/moveselect.plugin.js',
	['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerCssFile('@web/js/moveselectplugin/moveselect.css');

$moveSelectPlg = <<< JS
	$(document).ready(function(){
		$('#moveselect').moveSelect(); 
	})
JS;
$this->registerJs($moveSelectPlg, yii\web\View::POS_END);
?>

<div class="role-permission form-group">
	<label class="control-label col-sm-3">Разрешения</label>
	<div class="col-sm-6">
		<div id="moveselect">
			<div class="avialable">
				<ul>
				<?php foreach($permissions['avialable'] as $_permission){ ?>
					<li>
						<?php
						// [name] => postAdd
						// [type] => 2
						// [description] => Добавление постов
						// [rule_name] => 
						// [data] => 
						// [created_at] => 1484119950
						// [updated_at] => 1484119950
						?>
						<?=$_permission['description']?>
						<?=HTML::hiddenInput('', $_permission['name'])?>
					</li>
				<?php } ?>
				</ul>
			</div>
			<div class="awarded">
				<ul>
				<?php foreach($permissions['awarded'] as $_permission){ ?>
					<li>
						<?=$_permission['description']?>
						<?=HTML::hiddenInput('permission[]', $_permission['name'])?>
					</li>
				<?php } ?>
				</ul>
			</div>
		</div>
	</div>
</div>