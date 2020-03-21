<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 31.01.19
 * Time: 3:41
 */

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $category shop\entities\Shop\Category */

use yii\helpers\Html;

$this->title = 'Каталог';
$this->params['breadcrumbs'][] = $this->title;
?>

<h2><?= Html::encode($this->title) ?></h2>

<?php //$this->render('_subcategories', ['category' => $category]) ?>

<?= $this->render('_list', [
    'dataProvider' => $dataProvider
]) ?>