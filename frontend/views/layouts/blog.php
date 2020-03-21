<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 22.02.19
 * Time: 12:48
 */

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\widgets\Blog\CategoriesWidget;

?>
<?php $this->beginContent('@frontend/views/layouts/main.php') ?>

<div class="container blog">
    <div id="content" class="col-sm-9">
        <?= $content ?>
    </div>
    <aside id="column-left" class="col-sm-3 hidden-xs">
        <h3>Меню</h3>
        <?= CategoriesWidget::widget([
            'active' => $this->params['active_category'] ?? null
        ]) ?>
    </aside>
</div>

<?php $this->endContent() ?>
