<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 31.01.19
 * Time: 3:41
 */

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\widgets\Shop\CategoriesWidget;
?>
<?php $this->beginContent('@frontend/views/layouts/main.php') ?>

<div class="container catalog">

    <div class="row">
        <aside id="column-left" class="col-md-3 hidden-sm hidden-xs">
            <div class="column_catalog">
                <h3>Каталог</h3>
                <?= CategoriesWidget::widget([
                    'active' => $this->params['active_category'] ?? null
                ]) ?>
            </div>
        </aside>

        <div id="content" class="col-xs-12 col-md-9">
            <?= $content ?>
        </div>
    </div>

</div>

<?php $this->endContent() ?>