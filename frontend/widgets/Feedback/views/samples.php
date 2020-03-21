<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 04.10.2019
 * Time: 22:05
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\widgets\MaskedInput;

?>
<div class="samples-form-wrapper">

    <?php $form = ActiveForm::begin(['id' => 'samples-form']); ?>

        <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'phone')->widget(MaskedInput::className(), [
        'mask' => '+38 (999) 999-99-99',
        'options' => [
            'class' => 'form-control placeholder-style',
            'id' => 'phone2',
//            'placeholder' => ('Телефон')
        ],
        'clientOptions' => [
            'clearIncomplete' => true
        ]
    ]) ?>

        <?= $form->field($model, 'email') ?>

        <?= $form->field($model, 'address') ?>

        <?= $form->field($model, 'articles')->textarea() ?>

        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
            'template' => '<div class="row"><div class="col-lg-6">{image}</div><div class="col-lg-6">{input}</div></div>',
        ]) ?>

        <?= Html::submitButton(Yii::t('app', 'Отправить'), ['class' => 'btn btn-4', 'name' => 'contact-button']) ?>

    <?php ActiveForm::end(); ?>
</div>

