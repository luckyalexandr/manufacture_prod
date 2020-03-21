<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 27.01.19
 * Time: 4:31
 */

/* @var $this \yii\web\View */
/* @var $slide \shop\entities\Shop\MainSlideshow */
/* @var $model \shop\forms\manage\Shop\MainSlideshowForm */

$this->title = 'Редактировать Слайд: ' . $slide->sort;
$this->params['breadcrumbs'][] = ['label' => 'Слайдер на главной', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $slide->title, 'url' => ['view', 'id' => $slide->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="brand-update">
    <div class="box">
        <p>Установленное изображение</p>
        <img src="<?= $slide->getThumbFileUrl('image', 'small') ?>" alt="">
    </div>
    <?= $this->render('_form', ['model' => $model]) ?>
</div>