<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<p>Здравствуйте. Вы успешно восстановили пароль на сайте <?=Html::a(Html::encode('crm.ru'), Url::home(true))?>.</p>
<p>Ваш новый пароль: <?=$password?></p>

