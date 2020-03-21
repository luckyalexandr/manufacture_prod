<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 17.02.19
 * Time: 2:08
 */

/* @var $this yii\web\View */
/* @var $model shop\forms\manage\Shop\DeliveryMethodForm */

$this->title = 'Создать метод доставки';
$this->params['breadcrumbs'][] = ['label' => 'DeliveryMethods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="method-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>