<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<p>Здравствуйте. Вы прошли регистрацию на сайте <?=Html::a(Html::encode('crm.ru'), Url::home(true))?>.</p>
<p>Ваш пароль: <?=$password?>.</p>
<br />
<p>Если Вы не проходили процедуру регистрации, просто удалите данное письмо.</p>

