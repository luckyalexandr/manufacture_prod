<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 01.02.19
 * Time: 10:03
 */

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $brand shop\entities\Shop\Brand */

use yii\helpers\Html;

$this->title = $brand->name;

$this->registerMetaTag(['name' =>'title', 'content' => $brand->meta->title]);
$this->registerMetaTag(['name' =>'description', 'content' => $brand->meta->description]);
$this->registerMetaTag(['name' =>'keywords', 'content' => $brand->meta->keywords]);

$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => ['index']];
$this->params['breadcrumbs'][] = $brand->name;
?>

<h1><?= Html::encode($brand->name) ?></h1>

<hr />

<?= $this->render('_list', [
    'dataProvider' => $dataProvider
]) ?>