<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 01.02.19
 * Time: 10:04
 */

/* @var $this yii\web\View */
/* @var $product shop\entities\Shop\Product\Product */

use shop\helpers\PriceHelper;
use yii\helpers\Html;
use yii\helpers\Url;

$url = Url::to(['slug-product', 'slug' => $product->slug]);
?>


<div class="col-xs-12 col-sm-6 col-md-3 content-product">
    <a href="<?= Html::encode($url) ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
        <img src="<?= Html::encode($product->mainPhoto->getThumbFileUrl('file', 'large')) ?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="<?= $product->name ?>" width="400" height="400">
        <div class="product-details-wrapper">
            <h3 class="loop-product__title"><?= $product->name ?></h3>
            <span class="price">
                    <span class="price-new">
                        <!--От 1м --><?= PriceHelper::format($product->price_new) ?> грн./п.метр
                    <?php if ($product->price_old): ?>
                        <span class="price-old"><?= PriceHelper::format($product->price_old) ?> грн./п.метр</span>
                    <?php endif; ?>
                    </span>
                    
                <?php if ($product->price_roll && $product->roll_long): ?>
                    <span class="price-roll">
                            От <?= $product->roll_long ?> м. <?= PriceHelper::format($product->price_roll) ?> грн./п.метр
                        </span>
                <?php endif; ?>
            </span>
        </div>
    </a>

    <div class="button-group">
        <a class="button cartAddFP" href="<?= Url::to(['/shop/cart/add', 'id' => $product->id]) ?>" data-method="post"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">В корзину</span></a>
        <a class="button" data-toggle="tooltip" title="Добавить в список желаний" href="<?= Url::to(['/cabinet/wishlist/add', 'id' => $product->id]) ?>" data-method="post"><i class="fa fa-heart"></i></a>
        <script type="text/javascript">
            $('.cartAddFP').click(function() {
                fbq('track', 'AddToCart');
            });
        </script>
    </div>
</div>