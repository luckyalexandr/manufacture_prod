<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 12.01.19
 * Time: 21:47
 */

/* @var $this \yii\web\View */
/* @var $characteristic \shop\entities\Shop\Characteristic */
/* @var $model \shop\forms\manage\Shop\CharacteristicForm */

$this->title = 'Редактировать характеристику: ' . $characteristic->name;
$this->params['breadcrumbs'][] = ['label' => 'Характеристики', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $characteristic->name, 'url' => ['view', 'id' => $characteristic->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="characteristic-update">
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
