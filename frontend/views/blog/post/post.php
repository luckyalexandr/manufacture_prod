<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 22.02.19
 * Time: 12:33
 */

/* @var $this yii\web\View */
/* @var $post shop\entities\Blog\Post\Post */

use frontend\widgets\Blog\CommentsWidget;
use yii\helpers\Html;

$this->title = $post->title;

$this->registerMetaTag(['name' =>'title', 'content' => $post->meta->title]);
$this->registerMetaTag(['name' =>'description', 'content' => $post->meta->description]);
$this->registerMetaTag(['name' =>'keywords', 'content' => $post->meta->keywords]);

$this->params['breadcrumbs'][] = ['label' => 'Блог', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $post->category->name, 'url' => ['category', 'slug' => $post->category->slug]];
$this->params['breadcrumbs'][] = $post->title;

$this->params['active_category'] = $post->category;

$tagLinks = [];
foreach ($post->tags as $tag) {
    $tagLinks[] = Html::a(Html::encode($tag->name), ['tag', 'slug' => $tag->slug]);
}
?>

<article class="blog-post">
    <h1><?= Html::encode($post->title) ?></h1>

    <p class="post-data"><span class="glyphicon glyphicon-calendar"></span> <?= Yii::$app->formatter->asDatetime($post->created_at); ?></p>

    <?php if ($post->photo): ?>
        <figure class="post-image"><img src="<?= Html::encode($post->getThumbFileUrl('photo', 'origin')) ?>" alt="" class="img-responsive" /></figure>
    <?php endif; ?>

    <div class="post-text"><?= $post->content ?></div>
</article>

<p class="blog-post-tags">Теги: <?= implode(', ', $tagLinks) ?></p>

<?= CommentsWidget::widget([
    'post' => $post,
]) ?>
