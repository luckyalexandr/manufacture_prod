<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 06.08.18
 * Time: 8:04
 */
use  \yii\helpers\Html;

$this->title = 'Личный кабинет';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cabinet-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <h2 style="text-align: center;">Добро пожаловать!</h2>

    <!--    <p>Прикрепить профиль соц. сетей</p>
    <?//= \yii\authclient\widgets\AuthChoice::widget([
//        'baseAuthUrl' => ['cabinet/network/attach'],
//    ]); ?>-->
</div>
