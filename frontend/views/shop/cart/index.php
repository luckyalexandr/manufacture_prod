<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 09.02.19
 * Time: 11:57
 */

/* @var $this yii\web\View */
/* @var $cart \shop\cart\Cart */

use shop\helpers\PriceHelper;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Корзина';
$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => ['/shop/catalog/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container cart-index">
    <div class="container">
    <h2><?= Html::encode($this->title) ?></h2>

    <div class="col-xs-12">
        <table class="table table-bordered rwd-table">
            <tr>
                <th class="text-center" style="width: 100px">Изображение</th>
                <th class="text-left">Наименование</th>
<!--                <th class="text-left">Модификация</th>-->
                <th class="text-left">Количество</th>
                <th class="text-right">Цена</th>
                <th class="text-right">Итого</th>
            </tr>
            <?php foreach ($cart->getItems() as $item): ?>
                <?php
                $product = $item->getProduct();
                $modification = $item->getModification();
                $url = Url::to(['/shop/catalog/slug-product', 'slug' => $product->slug]);
                ?>
                <tr>
                    <td class="text-center">
                        <a href="<?= $url ?>">
                            <?php if ($product->mainPhoto): ?>
                                <img src="<?= $product->mainPhoto->getThumbFileUrl('file', 'cart_list') ?>" alt="" class="img-thumbnail" />
                            <?php endif; ?>
                        </a>
                    </td>
                    <td class="text-left">
                        <a href="<?= $url ?>"><?= Html::encode($product->name) ?></a>
                    </td>
<!--                    <td class="text-left">-->
<!--                        <?php //if ($modification): ?>-->
<!--                            <?//= Html::encode($modification->name) ?>-->
<!--                       <?php //endif; ?> -->
<!--                    </td>-->
                    <td class="text-left">
                        <?= Html::beginForm(['quantity', 'id' => $item->getId()]); ?>
                        <div class="cart-item-btn-group input-group btn-block" style="max-width: 200px;">
                            <input type="number" name="quantity" value="<?= $item->getQuantity() ?>" size="1" class="form-control" />
                            <span class="input-group-btn">
                                    <button type="submit" title="" class="btn btn-primary" data-original-title="Update"><i class="fas fa-sync-alt""></i></button>
                                    <a title="Remove" class="btn btn-danger" href="<?= Url::to(['remove', 'id' => $item->getId()]) ?>" data-method="post"><i class="fa fa-times-circle"></i></a>
                                </span>
                        </div>
                        <?= Html::endForm() ?>
                    </td>
                    <td data-th="Цена:" class="text-right"><?= PriceHelper::format($item->getPrice()) ?> грн.</td>
                    <td data-th="Итого:" class="text-right"><?= PriceHelper::format($item->getCost()) ?> грн.</td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <br />
    <div class="row">
        <div class="col-sm-4 col-sm-offset-8">
            <?php $cost = $cart->getCost() ?>
            <table class="table table-bordered">
                <tr>
                    <td class="text-right"><strong>Под-итог:</strong></td>
                    <td class="text-right"><?= PriceHelper::format($cost->getOrigin()) ?> грн.</td>
                </tr>
                <?php foreach ($cost->getDiscounts() as $discount): ?>
                    <tr>
                        <td class="text-right"><strong><?= Html::encode($discount->getName()) ?>:</strong></td>
                        <td class="text-right"><?= PriceHelper::format($discount->getValue()) ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td class="text-right"><strong>Итого:</strong></td>
                    <td class="text-right"><?= PriceHelper::format($cost->getTotal()) ?> грн.</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="buttons clearfix">
        <div class="pull-left"><a href="<?= Html::encode(Url::to('/shop/catalog/index')) ?>" class="btn btn-4">Продолжить покупки</a></div>
        <?php if ($cart->getItems()): ?>
        <?php if (Yii::$app->user->isGuest): ?>
            <div class="pull-right"><a href="<?=Html::encode( Url::to('/shop/checkout/guest')) ?>" class="btn btn-4">Оформить заказ</a></div>
        <?php else: ?>
            <div class="pull-right"><a href="<?=Html::encode( Url::to('/shop/checkout/index')) ?>" class="btn btn-4">Оформить заказ</a></div>
        <?php endif; ?>
        <?php endif; ?>
    </div>
    </div>
</div>