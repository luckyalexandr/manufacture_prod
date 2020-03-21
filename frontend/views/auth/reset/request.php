<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \shop\forms\auth\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Восстановление пароля';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="сol-xs-12 auth-reset-request">
        <div class="container h-100">
            <div class="col-md-12">
                <h1><?= Html::encode($this->title) ?></h1>
                <br>
                <p>Пожалуйста введите свой email. На него будет отправлена ссылка для сброса пароля.</p>
                <br>
                <hr>
            </div>
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                    <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Отправить', ['class' => 'btn btn-4']) ?>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
</div>
