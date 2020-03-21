<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \shop\forms\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->registerMetaTag(['name' => 'title', 'content' => 'Контактная информация']);
$this->registerMetaTag(['name' => 'description', 'content' => 'Контактная информация сайта Manufacture17']);
$this->registerMetaTag(['name' => 'keywords', 'content' => 'Manufacture17, контакты, контактная информация, обратная связь']);

$this->title = 'Контакты';

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container site-contact">
    <div class="col-md-6">
        <h2 class="page-title">
            Контакты
        </h2>
        <div class="col-xs-12 page-content">
            <h3>Наш адрес:</h3>
            <p class="city-and-postcode">Днепр 49000</p>
            <p class="street">ул. Вячеслава Липинского (бывш. Ширшова), 18</p>
<!--             <h3>Our address:</h3>
            <p class="city-and-postcode">Dnipro 49027</p>
            <p class="street">Zhukovsky str. 18 / P.S.Studio</p> -->

            <h3>Телефоны:</h3>
            <div class="footer-bottom_phones">

                <p>
                    <a style="color: #000" href="tel:+380965661819">+38 (096) 566-18-19</a>
                </p>
                <p>
                    <a style="color: #000" href="tel:+380660395100">+38 (066) 039-51-00</a>
                </p>

            </div>
<!--             <h3>Phones:</h3>
            <div class="footer-bottom_phones">

                <p>+38 (067) 631-81-04</p>

                <p>+38 (067) 983-10-44</p>

            </div> -->
            <h3>E-mail</h3>
            <div class="footer-bottom-email">
                <a href="mailto:office@manufacture17.com.ua">office@manufacture17.com.ua</a>
            </div>
        </div>

    </div>
    <div class="col-md-6">

        <h2 class="page-title">
            Напишите нам:
        </h2>
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'subject') ?>

                <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>

    </div>

    <div class="col-md-12 map-responsive">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1322.7892321639772!2d35.049654!3d48.464617!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40dbe2dd29a7bcb7%3A0xb5ef710e4f2924de!2sViacheslava%20Lypynskoho%20Street%2C%2018%2C%20Dnipropetrovs&#39;k%2C%20Dnipropetrovs&#39;ka%20oblast%2C%2049000!5e0!3m2!1sen!2sua!4v1577977805462!5m2!1sen!2sua" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
    </div>
</div>
