<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 17.02.19
 * Time: 5:47
 */


/* @var $this yii\web\View */
/* @var $cart \shop\cart\Cart */
/* @var $model \shop\forms\Shop\Order\OrderForm */

use kartik\widgets\DepDrop;
use LisDev\Delivery\NovaPoshtaApi2;
use shop\helpers\PriceHelper;
use shop\helpers\WeightHelper;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\MaskedInput;

$this->title = 'Оформление заказа';
$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => ['/shop/catalog/index']];
$this->params['breadcrumbs'][] = ['label' => 'Корзина', 'url' => ['/shop/cart/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<script>
    fbq('track', 'InitiateCheckout');
</script>
<div class="checkout-index">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>

        <div class="table-responsive">
            <table class="table table-bordered rwd-table">
                <tr>
                    <th class="text-left">Наименование</th>
                    <th class="text-left">Модель</th>
                    <th class="text-left">Количество</th>
                    <th class="text-right">Цена за 1 м.</th>
                    <th class="text-right">Итого</th>
                </tr>
                <?php foreach ($cart->getItems() as $item): ?>
                    <?php
                    $product = $item->getProduct();
                    $modification = $item->getModification();
                    $url = Url::to(['/shop/catalog/product', 'id' => $product->id]);
                    ?>
                    <tr>
                        <td class="text-left">
                            <a href="<?= $url ?>"><?= Html::encode($product->name) ?></a>
                        </td>
                        <td data-th="Модель:" class="text-left">
                            <?php if ($modification): ?>
                                <?= Html::encode($modification->name) ?>
                            <?php endif; ?>
                        </td>
                        <td data-th="Количество:" class="text-left">
                            <?= $item->getQuantity() ?>
                        </td>
                        <td data-th="Цена за 1 м.:" class="text-right"><?= PriceHelper::format($item->getPrice()) ?></td>
                        <td data-th="Итого:" class="text-right"><?= PriceHelper::format($item->getCost()) ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <br />

        <?php $cost = $cart->getCost() ?>
        <table class="table table-bordered">
            <tr>
                <td class="text-right"><strong>Подитог:</strong></td>
                <td class="text-right"><?= PriceHelper::format($cost->getOrigin()) ?> грн.</td>
            </tr>
            <tr>
                <td class="text-right"><strong>Итого:</strong></td>
                <td class="text-right"><?= PriceHelper::format($cost->getTotal()) ?> грн.</td>
            </tr>
        </table>

        <?php $form = ActiveForm::begin() ?>

        <div class="panel panel-default">
            <div class="panel-heading">Данные получателя</div>
            <div class="panel-body">
                <?= $form->field($model->customer, 'phone')->widget(MaskedInput::class, [
                    'mask' => '+38 (999) 999-99-99',
                    'options' => [
                        'class' => 'form-control placeholder-style',
                    ],
                ])->label('Телефон') ?>
                <?= $form->field($model->customer, 'name')->textInput()->label('ФИО') ?>
                <?= $form->field($model->customer, 'email')->textInput()->label('Email') ?>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Информация о доставке</div>
            <div class="panel-body">
                <div class="sber">
                    <p class="sber-requisites">
                        <strong>
                            Реквизиты для оплаты
                        </strong>
                    </p>
                    <p><strong>МФО</strong> 305482</p>
                    <p><strong>ИНН</strong> 3220303487</p>
                    <p><strong>Счет</strong> UA493054820000026009500736774</p>
                    <p>Поляруш Дарина Валериевна.</p>
                </div>
                <?= $form->field($model->delivery, 'method')->dropDownList($model->delivery->deliveryMethodsList(), ['prompt' => '--- Выбрать метод доставки ---', 'required' => true])->label('Способ доставки') ?>
                <?= $form->field($model->delivery, 'address')->textarea(['rows' => 3])->label('Адрес') ?>

                <?= $form->field($model->delivery, 'area')->dropDownList(ArrayHelper::getColumn($model->delivery->getAreas(), 'Description'),
                    [
                        'prompt' => 'Выберите область',
                        'onchange' => '
                        $.post(
                            "'.Url::toRoute('cities').'",
                            {area : $(this).val()},
                            function(data){
                                $("select#deliveryform-city").html(data).attr("disabled", false)
                            }
                        )
                    '
                    ]) ?>

                <?= $form->field($model->delivery, 'city')->dropDownList([],
                    [
                        'prompt' => 'Сначала выберите область',
                        'area' => 'area',
                        'onchange' => '
                        $.post(
                            "'.Url::toRoute('warehouses').'",
                            {city : $(this).val()},
                            function(data){
                                $("select#deliveryform-warehouse").html(data).attr("disabled", false)
                            }
                        )
                    ',
                        'disabled' => 'disabled'
                    ]) ?>

                <?= $form->field($model->delivery, 'warehouse')->dropDownList(array(),
                    [
                        'prompt' => 'Сначала выберите город',
                        'city' => 'city',
                        'disabled' => 'disabled'
                    ]); ?>

            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Примечание к заказу</div>
            <div class="panel-body">
                <?= $form->field($model, 'note')->textarea(['rows' => 3])->label(false) ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Подтвердить', ['class' => 'btn btn-4']) ?>
        </div>

        <?php ActiveForm::end() ?>
    </div>
</div>

