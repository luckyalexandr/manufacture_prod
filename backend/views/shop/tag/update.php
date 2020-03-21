<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 11.01.19
 * Time: 15:42
 */

/* @var $this \yii\web\View */
/* @var $tag shop\entities\Shop\Tag */
/* @var $model shop\forms\manage\Shop\TagForm */

$this->title = 'Редактировать тег: ' . $tag->name;
$this->params['breadcrumbs'][] = ['label' => 'Теги', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $tag->name, 'url' => ['view', 'id' => $tag->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="tag-update">
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
