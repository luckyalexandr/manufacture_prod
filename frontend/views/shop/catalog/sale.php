<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 28.02.19
 * Time: 20:01
 */

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $category shop\entities\Shop\Category */

use yii\helpers\Html;

$this->title = 'Распродажа';
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?= Html::encode($this->title) ?></h1>

<?= $this->render('_list', [
    'dataProvider' => $dataProvider
]) ?>