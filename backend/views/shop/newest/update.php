<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 11.01.19
 * Time: 15:42
 */

/* @var $this \yii\web\View */
/* @var $tag shop\entities\Shop\Newest */
/* @var $model shop\forms\manage\Shop\NewestForm */

$this->title = 'Редактировать количество: ' . $newest->quantity;
$this->params['breadcrumbs'][] = ['label' => 'Новики', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $newest->quantity, 'url' => ['view', 'id' => $newest->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="newest-update">
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
