<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 27.02.19
 * Time: 6:08
 */

/* @var $this yii\web\View */

$this->title = 'Новинки';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="shop-catalog_newest">

    <h1>Новинки</h1>

    <div class="products row">
        <div class="col-md-12 hiddem-sm">
            <div class="text-left total-show"></div>
        </div>

        <?= \frontend\widgets\Shop\NewestProductsWidget::widget([
            'limit' => 24,
        ]); ?>

    </div>

</section>