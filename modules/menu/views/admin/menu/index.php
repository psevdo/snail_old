<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Alert;
use app\modules\menu\Module;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\menu\models\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('menu', 'MENUS');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php if(Yii::$app->session->getFlash('success')) { ?><?=Alert::widget(['options' => ['class' => 'alert-success'], 'body' => Yii::$app->session->getFlash('success')]);?><?php } ?>
<?php if(Yii::$app->session->getFlash('info')) { ?><?=Alert::widget(['options' => ['class' => 'alert-info'], 'body' => Yii::$app->session->getFlash('info')]);?><?php } ?>
<?php if(Yii::$app->session->getFlash('danger')) { ?><?=Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => Yii::$app->session->getFlash('danger')]);?><?php } ?>

<div class="menu-index">

    <p><?=Html::a(Module::t('menu', 'CREATE'), ['create'], ['class' => 'btn btn-success']) ?></p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'description',
			[
				'attribute' => 'main',
				'label' => 'Главное',
				'content' => function($data) {
					if($data->main == 1) return '<span style="color: #449d44" class="glyphicon glyphicon-ok"></span>';
					else return '';
				},
				'filter' => false
			],
            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{update} {delete}'
			],
        ],
    ]); ?>
</div>
