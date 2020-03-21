<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 19.01.19
 * Time: 13:45
 */

/* @var $this yii\web\View */
/* @var $product shop\entities\Shop\Product\Product */
/* @var $model shop\forms\manage\Shop\Product\ModificationForm */

$this->title = 'Создать модификацию';
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['shop/product/index']];
$this->params['breadcrumbs'][] = ['label' => $product->name, 'url' => ['shop/product/view', 'id' => $product->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modification-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
