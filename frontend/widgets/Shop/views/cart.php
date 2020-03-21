<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 10.02.19
 * Time: 0:58
 */

use yii\helpers\Url; ?>
<a href="<?= Url::to(['/shop/cart/index']) ?>" class="basket-btn basket-btn_fixed-xs btn-4">
    <span class="basket-btn__label"><i class="fas fa-shopping-cart"></i> Корзина</span>
    <span class="basket-btn__counter">
        ( <?= $cart->getAmount() ?> )
    </span>

</a>