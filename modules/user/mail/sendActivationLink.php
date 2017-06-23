<?php
use yii\helpers\Html;
use yii\helpers\Url;

$confirmLink = Url::toRoute(['/user/registration/activation', 'email' => $email, 'token' => $token], true);
?>
<p>Здравствуйте. Вы прошли регистрацию на сайте <?=Html::a(Html::encode('crm.ru'), Url::home(true))?>.</p>
<p>Для завершения процедуры регистрации, Вам нужно пройти по следующей ссылке:</p>
<p><?=Html::a(Html::encode($confirmLink), $confirmLink)?>.</p>
<br />
<p>Если Вы не проходили процедуру регистрации, просто удалите данное письмо.</p>

