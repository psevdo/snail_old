<?php
use app\modules\user\Module;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\user\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('user', 'USERS');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

	<?php if(Yii::$app->session->getFlash('success')) { ?><?=Alert::widget(['options' => ['class' => 'alert-success'], 'body' => Yii::$app->session->getFlash('success')]);?><?php } ?>
	<?php if(Yii::$app->session->getFlash('info')) { ?><?=Alert::widget(['options' => ['class' => 'alert-info'], 'body' => Yii::$app->session->getFlash('info')]);?><?php } ?>
	<?php if(Yii::$app->session->getFlash('error')) { ?><?=Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => Yii::$app->session->getFlash('error')]);?><?php } ?>

    <p><?= Html::a(Module::t('user', 'CREATE_USER'), ['create'], ['class' => 'btn btn-success']) ?></p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'username',
            // 'email:email',
            'phone',
            // 'password',
            // 'status',
            // 'token',
            // 'dataRegistration',

            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{update} {delete}'
			],
        ],
    ]); ?>
</div>
