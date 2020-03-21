<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 10.01.19
 * Time: 15:54
 */

/* @var $this \yii\web\View */
/* @var $model \shop\forms\manage\Shop\BrandForm */

$this->title = 'Создать Бренд';
$this->params['breadcrumbs'][] = ['label' => 'Бренды', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-create">
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
