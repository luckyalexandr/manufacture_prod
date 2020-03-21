<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 13.01.19
 * Time: 8:43
 */

use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use kartik\widgets\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this \yii\web\View */
/* @var $model \shop\forms\manage\Shop\Product\ProductCreateForm */

$this->title = 'Создание товара';
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <div class="box box-default">
        <div class="box-header with-border">Общая информация</div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'brandId')->dropDownList($model->brandsList()) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <?= $form->field($model, 'description')->widget(CKEditor::class, [
                'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'path' => '@webroot/ckedit']),
            ]) ?>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">Количество на складе</div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model->quantity, 'quantity')->textInput(['maxlength' => true])->label('Количество на складе') ?>
                </div>
            </div>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">Цены</div>
        <div class="box-body">
            <div class="col-md-3">
                <?= $form->field($model->price, 'old')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model->price, 'new')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model->price, 'min')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model->price, 'roll')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">Опт</div>
        <div class="box-body">
            <div class="col-md-3">
                <?= $form->field($model->longitude, 'min_long')->textInput(['maxlength' => true, 'value' => 10]) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model->longitude, 'roll_long')->textInput(['maxlength' => true, 'value' => 35]) ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">Категории</div>
                <div class="box-body">
                    <?= $form->field($model->categories, 'main')->dropDownList($model->categories->categoriesList(), ['prompt' => 'Укажите главную категорию']) ?>
                    <?= $form->field($model->categories, 'others')->checkboxList($model->categories->categoriesList()) ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">Метки</div>
                <div class="box-body">
                    <?= $form->field($model->tags, 'existing')->checkboxList($model->tags->tagsList()) ?>
                    <?= $form->field($model->tags, 'textNew')->textInput() ?>
                </div>
            </div>

        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">Мета теги (SEO)</div>
        <div class="box-body">
            <?= $form->field($model->meta, 'title')->textInput() ?>
            <?= $form->field($model->meta, 'description')->textarea(['rows' => 3]) ?>
            <?= $form->field($model->meta, 'keywords')->textInput() ?>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">Характеристики</div>
        <div class="box-body">
            <?php foreach ($model->values as $i => $value): ?>
                <?php $variants = $value->variantsList(); if ($variants): ?>
                    <?= $form->field($value, '[' . $i . ']value')->dropDownList($variants, ['prompt' => 'Выберите значение']) ?>
                <?php else: ?>
                    <?= $form->field($value, '[' . $i . ']value')->textInput() ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">Фотографии</div>
        <div class="box-body">
            <p><b>Мин – 600х600, макс – 1200х1200.</b></p>
            <?= $form->field($model->photos, 'files[]')->widget(FileInput::class, [
                    'options' => [
                        'accept' => 'image/*',
                        'multiple' => true,
                    ],
                'pluginOptions' => [
                    'previewFileType' => 'image',
                    'showPreview' => true,
                ]
            ]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
