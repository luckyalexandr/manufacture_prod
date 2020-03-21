<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 01.02.19
 * Time: 10:03
 */

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $tag shop\entities\Shop\Tag */

use yii\helpers\Html;

$this->title = 'Товары с меткой ' . $tag->name;

$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => ['index']];
$this->params['breadcrumbs'][] = $tag->name;
?>

    <h1>Товары с меткой &laquo;<?= Html::encode($tag->name) ?>&raquo;</h1>

    <hr />

<?= $this->render('_list', [
    'dataProvider' => $dataProvider
]) ?>