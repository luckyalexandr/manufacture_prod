<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 27.01.19
 * Time: 4:31
 */

use kartik\widgets\FileInput;
use shop\entities\Shop\MainSlideshow;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model shop\forms\manage\Shop\MainSlideshowForm */
/* @var $form yii\widgets\ActiveForm */

$sort = count(MainSlideshow::find()->all());
?>
<div class="main-slideshow-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <div class="box box-default">
        <div class="box-body">
            <div class="col-md-12">
                <?= $form->field($model, 'image')->widget(FileInput::class, [
                    'options' => [
                        'accept' => 'image/*',
                        'multiple' => false,
                    ]
                ]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'title')->textInput() ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'link')->textInput() ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'sort')->textInput(['type' => 'number', 'value' => $sort]) ?>
            </div>
            <div class="col-md-8">
                <?= $form->field($model, 'text')->textarea(['rows' => 3]) ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
