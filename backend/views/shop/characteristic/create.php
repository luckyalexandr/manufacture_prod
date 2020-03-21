<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 12.01.19
 * Time: 21:40
 */

/* @var $this \yii\web\View */
/* @var $model \shop\forms\manage\Shop\CharacteristicForm */

$this->title = 'Создать характеристику';
$this->params['breadcrumbs'][] = ['label' => 'Характеристики', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="characteristic-create">
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
