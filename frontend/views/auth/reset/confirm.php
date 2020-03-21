<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \shop\forms\auth\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Подтверждение смены пароля';

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-xs-12 site-reset-password">
    <div class="container h-100">
        <div class="cil-md-12">
            <h1><?= Html::encode($this->title) ?></h1>
            <br>
            <p>Введите свой новый пароль для сайта Manufacture17:</p>
            <br>
            <hr>
        </div>
        <div class="col-md-4 col-lg-4">
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

                <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-4']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
