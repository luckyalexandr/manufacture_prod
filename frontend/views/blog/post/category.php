<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 22.02.19
 * Time: 12:32
 */

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $category shop\entities\Blog\Category */

use yii\helpers\Html;

$this->title = $category->title;

$this->registerMetaTag(['name' =>'title', 'content' => $category->meta->title]);
$this->registerMetaTag(['name' =>'description', 'content' => $category->meta->description]);
$this->registerMetaTag(['name' =>'keywords', 'content' => $category->meta->keywords]);

$this->params['breadcrumbs'][] = ['label' => 'Блог', 'url' => ['index']];
$this->params['breadcrumbs'][] = $category->name;

$this->params['active_category'] = $category;
?>

<h1><?= Html::encode($category->getHeadingTile()) ?></h1>

<?php if (trim($category->description)): ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <?= Yii::$app->formatter->asNtext($category->description) ?>
        </div>
    </div>
<?php endif; ?>

<?= $this->render('_list', [
    'dataProvider' => $dataProvider
]) ?>


