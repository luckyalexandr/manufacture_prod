<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 11.01.19
 * Time: 15:42
 */

/* @var $this \yii\web\View */
/* @var $model \shop\forms\manage\Shop\TagForm */

$this->title = 'Создать Тег';
$this->params['breadcrumbs'][] = ['label' => 'Теги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-create">
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
