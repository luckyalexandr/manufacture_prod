<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 10.01.19
 * Time: 15:55
 */

/* @var $this \yii\web\View */
/* @var $brand \shop\entities\Shop\Brand */
/* @var $model \shop\forms\manage\Shop\BrandForm */

$this->title = 'Редактировать Бренд: ' . $brand->name;
$this->params['breadcrumbs'][] = ['label' => 'Бренды', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $brand->name, 'url' => ['view', 'id' => $brand->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="brand-update">
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
