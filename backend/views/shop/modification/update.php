<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 19.01.19
 * Time: 13:45
 */

/* @var $this yii\web\View */
/* @var $product shop\entities\Shop\Product\Product */
/* @var $modification shop\entities\Shop\Product\Modification */
/* @var $model shop\forms\manage\Shop\Product\ModificationForm */

$this->title = 'Обновить модификацию: ' . $modification->name;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['shop/product/index']];
$this->params['breadcrumbs'][] = ['label' => $product->name, 'url' => ['shop/product/view', 'id' => $product->id]];
$this->params['breadcrumbs'][] = $modification->name;
?>
<div class="modification-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
