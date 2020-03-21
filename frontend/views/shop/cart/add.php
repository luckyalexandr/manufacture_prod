<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 09.02.19
 * Time: 11:57
 */
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \shop\forms\Shop\AddToCartForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => ['/shop/catalog/index']];
$this->params['breadcrumbs'][] = ['label' => 'Корзина', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="cart-add">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin() ?>

            <?php if ($modifications = $model->modificationsList()): ?>
                <?= $form->field($model, 'modification')->dropDownList($modifications, ['prompt' => '--- Выбрать ---']) ?>
            <?php endif; ?>

            <?= $form->field($model, 'quantity')->textInput(['type' => 'number']) ?>

            <div class="form-group">
                <?= Html::submitButton('В корзину', ['class' => 'btn btn-4']) ?>
            </div>

            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>