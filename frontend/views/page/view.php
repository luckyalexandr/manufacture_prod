<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 27.02.19
 * Time: 8:44
 */

use yii\helpers\Html;
use \frontend\widgets\Feedback\Samples;

/* @var $this yii\web\View */
/* @var $page \shop\entities\Page */

$this->title = $page->title;

$this->registerMetaTag(['name' => 'title', 'content' => $page->meta->title]);
$this->registerMetaTag(['name' => 'description', 'content' => $page->meta->description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $page->meta->keywords]);

foreach ($page->parents as $parent) {
    if (!$parent->isRoot()) {
        $this->params['breadcrumbs'][] = ['label' => $parent->title, 'url' => ['view', 'id' => $parent->id]];
    }
}
$this->params['breadcrumbs'][] = $page->title;
?>
<div class="container page-view">
    <article class="page-text">

        <h1><?= Html::encode($page->title) ?></h1>

        <?= $page->content ?>

        <?php if (Yii::$app->request->url == '/samples'): ?>

            <?= Samples::widget(); ?>

        <?php endif; ?>

    </article>
</div>
