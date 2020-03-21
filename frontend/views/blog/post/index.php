<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 22.02.19
 * Time: 12:33
 */

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $category shop\entities\Shop\Category */

use yii\helpers\Html;

$this->title = 'Блог';

$this->registerMetaTag(['name' => 'title', 'content' => 'Блог']);
$this->registerMetaTag(['name' => 'description', 'content' => 'Блог сайта Manufacture17']);
$this->registerMetaTag(['name' => 'keywords', 'content' => 'блог, статьи, статьи о тканях']);

$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?= Html::encode($this->title) ?></h1>

<?= $this->render('_list', [
    'dataProvider' => $dataProvider
]) ?>