<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 22.02.19
 * Time: 12:45
 */

/* @var $item \frontend\widgets\Blog\CommentView */
?>

<div class="comment-item" data-id="<?= $item->comment->id ?>">
    <div class="panel panel-default">
        <div class="panel-body">
            <p class="comment-content">
                <?php if ($item->comment->isActive()): ?>
                    <?= Yii::$app->formatter->asNtext($item->comment->text) ?>
                <?php else: ?>
                    <i>Комментарий удален.</i>
                <?php endif; ?>
            </p>
            <div>
                <div class="pull-left">
                    <?= Yii::$app->formatter->asDatetime($item->comment->created_at) ?>
                </div>
                <div class="pull-right">
                    <span class="comment-reply">Ответить</span>
                </div>
            </div>
        </div>
    </div>
    <div class="margin">
        <div class="reply-block"></div>
        <div class="comments">
            <?php foreach ($item->children as $children): ?>
                <?= $this->render('_comment', ['item' => $children]) ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
