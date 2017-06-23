<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Alert;
use app\modules\page\Module;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\page\models\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('page', 'PAGES');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php if(Yii::$app->session->getFlash('success')) { ?><?=Alert::widget(['options' => ['class' => 'alert-success'], 'body' => Yii::$app->session->getFlash('success')]);?><?php } ?>
<?php if(Yii::$app->session->getFlash('info')) { ?><?=Alert::widget(['options' => ['class' => 'alert-info'], 'body' => Yii::$app->session->getFlash('info')]);?><?php } ?>
<?php if(Yii::$app->session->getFlash('danger')) { ?><?=Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => Yii::$app->session->getFlash('danger')]);?><?php } ?>

<div class="page-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Module::t('page', 'CREATE'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'title',
            'name',
            // 'text:ntext',
            // 'authorId',
            // 'dateCreate',
            // 'lastUpdate',
			// 'status',

            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{update} {delete}'
			],
        ],
    ]); ?>
</div>
