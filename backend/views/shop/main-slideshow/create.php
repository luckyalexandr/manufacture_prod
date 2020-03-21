<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 27.01.19
 * Time: 4:30
 */

/* @var $this \yii\web\View */
/* @var $model \shop\forms\manage\Shop\MainSlideshowForm */

$this->title = 'Создать Слайд';
$this->params['breadcrumbs'][] = ['label' => 'Слайдер на главной', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-slideshow-create">
    <?= $this->render('_form', ['model' => $model]) ?>
</div>