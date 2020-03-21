<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 22.02.19
 * Time: 12:32
 */

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */

?>

<?= \yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'layout' => "{items}\n{pager}",
    'itemView' => '_post',
]) ?>
