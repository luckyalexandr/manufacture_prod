<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 11.01.19
 * Time: 22:50
 */

/* @var $this \yii\web\View */
/* @var $category \shop\entities\Shop\Category */
/* @var $model \shop\forms\manage\Shop\CategoryForm */

$this->title = 'Редактировать категорию: ' . $category->name;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $category->name, 'url' => ['view', 'id' => $category->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="category-update">
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
