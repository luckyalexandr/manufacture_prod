<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 22.02.19
 * Time: 12:44
 */
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $post \shop\entities\Blog\Post\Post */
/* @var $items \frontend\widgets\Blog\CommentView[] */
/* @var $count integer */
/* @var $commentForm \shop\forms\Blog\CommentForm */
?>

<div id="comments" class="inner-bottom-xs">
    <h2>Комментарии</h2>
    <?php foreach ($items as $item): ?>
        <?= $this->render('_comment', ['item' => $item]) ?>
    <?php endforeach; ?>
</div>

<div id="reply-block" class="leave-reply">
    <?php $form = ActiveForm::begin([
        'action' => ['comment', 'id' => $post->id],
    ]); ?>

    <?= Html::activeHiddenInput($commentForm, 'parentId') ?>
    <?= $form->field($commentForm, 'text')->textarea(['rows' => 5])->label('Текст комментария') ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить комментарий', ['class' => 'btn btn-4']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<?php $this->registerJs("
    jQuery(document).on('click', '#comments .comment-reply', function () {
        var link = jQuery(this);
        var form = jQuery('#reply-block');
        var comment = link.closest('.comment-item');
        jQuery('#commentform-parentid').val(comment.data('id'));
        form.detach().appendTo(comment.find('.reply-block:first'));
        return false;
    });
"); ?>


