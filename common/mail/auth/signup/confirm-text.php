<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 25.07.18
 * Time: 16:00
 */
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user \shop\entities\User\User */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['auth/signup/confirm', 'token' => $user->email_confirm_token]);
?>
<div class="email-confirm">
    <p>Здравствуйте <?= Html::encode($user->username) ?></p>

    <p>Для подтверждения регистрации перейдите по ссылке:</p>

    <p><?= Html::a(Html::encode($confirmLink), $confirmLink) ?></p>
</div>
