<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 17.02.19
 * Time: 2:10
 */

/* @var $this yii\web\View */
/* @var $method shop\entities\Shop\DeliveryMethod */
/* @var $model shop\forms\manage\Shop\DeliveryMethodForm */

$this->title = 'Изменить метод доставки: ' . $method->name;
$this->params['breadcrumbs'][] = ['label' => 'Методы доставки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $method->name, 'url' => ['view', 'id' => $method->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="method-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>