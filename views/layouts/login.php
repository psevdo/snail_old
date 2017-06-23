<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AdminAsset;
use app\assets\ICheckAsset;

AdminAsset::register($this);
ICheckAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
	<title><?=Html::encode($this->title)?></title>
	<?php $this->head() ?>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<?php $this->beginBody() ?>
	<div class="login-box">
		<div class="login-logo">
			<?=Html::a('<b>Admin</b>LTE', '/')?>
		</div>
		<!-- /.login-logo -->
		<div class="login-box-body">
			<?=$content?>
		</div>
		<!-- /.login-box-body -->
	</div>
	<!-- /.login-box -->

<?php
$script = <<< JS
	$(function() {
		$('input').iCheck({
			checkboxClass: 'icheckbox_square-blue',
			radioClass: 'iradio_square-blue',
			increaseArea: '20%' // optional
		});
	});
JS;
$this->registerJs($script, yii\web\View::POS_END);
?>
<?php $this->endBody() ?>	
</body>
</html>
<?php $this->endPage() ?>