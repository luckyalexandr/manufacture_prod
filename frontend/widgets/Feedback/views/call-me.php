<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 04.10.2019
 * Time: 17:39
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\widgets\MaskedInput;

?>

<?php if (Yii::$app->session->hasFlash('callMeFormSubmitted')) { ?>

    <?php
    $this->registerJs(
        "$('#myModalSendOk').modal('show');",
        yii\web\View::POS_READY
    );
    ?>

    <!-- Modal -->
    <div class="modal fade" id="myModalSendOk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Запрос звонка</h4>
                </div>
                <div class="modal-body">
                    <p>Спасибо за обращение. Мы перезвоним Вам в ближайшее время.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-4" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>

<?php } ?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <?php $form = ActiveForm::begin(['id' => 'call-me-form']); ?>

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Запрос звонка</h4>
            </div>
            <div class="modal-body">

                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'phone')->widget(MaskedInput::className(), [
                    'mask' => '+38 (999) 999-99-99',
                    'options' => [
                        'class' => 'form-control placeholder-style',
                        'id' => 'phone1',
//                        'placeholder' => ('Телефон')
                    ],
                    'clientOptions' => [
                        'clearIncomplete' => true
                    ]
                ]) ?>

                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-6">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-4" data-dismiss="modal">Закрыть</button>
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-4', 'name' => 'contact-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>

