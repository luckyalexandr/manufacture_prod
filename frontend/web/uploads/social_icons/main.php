<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 24.01.19
 * Time: 9:38
 */

/* @var $this \yii\web\View */
/* @var $content string */

//use frontend\widgets\CategoriesListWidget;
use frontend\widgets\Shop\CartWidget;
use shop\fetching\Shop\CategoryFetchingRepository;
use shop\services\manage\Shop\ProductManageService;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\widgets\Feedback\CallMe;

AppAsset::register($this);
\frontend\assets\OwlCarouselAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="<?= Yii::$app->charset ?>">
	<meta name="viewport" content="width=device-width">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script src="//code.jivosite.com/widget.js" data-jv-id="S9BdZAF1Yn" async></script>
</head>
<body>
<?php $this->beginBody() ?>
<header>
    <div class="logo col-xs-12 col-sm-4 col-md-4 col-lg-4">
        <a href="<?= Html::encode(Yii::$app->homeUrl) ?>">
            <img src="/uploads/logo/Manufacture-2.png" alt="Manufacture17">
        </a>
        <p>Интернет-магазин тканей</p>
    </div>

    <div class="sub-header col-xs-12 col-sm-8 col-md-8 col-lg-8">

        <div class="sub-header__top">

            <nav class="sub-header__top_social">
                <ul>
                    <li>
                        <a href="https://instagram.com/manufacture17?utm_source=ig_profile_share&igshid=s4qil1gquvo0">
                            <img src="/uploads/social_icons/instagram.png" alt="Instagram">
                        </a>
                    </li>
                    <li>
                        <a href="https://facebook.com/groups/436132426860864?group_view_referrer=profile_browser">
                            <img src="/uploads/social_icons/facebook.png" alt="Facebook">
                        </a>
                    </li>
                </ul>
            </nav>

        </div>

        <div class="sub-header__middle">

            <div class="sub-header__middle_actions">
                <p class="street">ул. Вернадского (Дзержинского) 24д</p>
                <p class="city-and-postcode">Днепр 49027</p>
                <span class="sub-header__phones">
                    <a href="tel:+380676318104">+38 (067) 631-81-04</a>
                    <a href="tel:+380679831044">+38 (067) 983-10-44</a>
                </span>
                <div type="button" class="glow-on-hover" data-toggle="modal" data-target="#myModal">
                    <div class="text-call">
                        <i class="fa fa-phone"></i>
                        <span>Заказать<br>звонок</span>
                    </div>
                </div>
                <div class="sub-header__middle_actions_search">
                    <?= Html::beginForm(['/shop/catalog/search'], 'get', ['class' => 'woocommerce-product-search']) ?>
                        <label class="screen-reader-text" for="woocommerce-product-search-field-0">Искать:</label>
                        <input type="search" id="woocommerce-product-search-field-0" class="search-field" placeholder="Поиск по товарам…" value="" name="text">
                        <button type="submit" value="Поиск"></button>
                    <?= Html::endForm() ?>
                </div>
            </div>

            <div class="sub-header__middle_user">

                <div class="sub-header__middle_user_cart">
                    <?= CartWidget::widget() ?>
                </div>
                <div class="sub-header__middle_user_cabinet">
                    <a href="/cabinet">
                        <i class="fas fa-user-circle"></i> Личный кабинет
                    </a>
                </div>

            </div>

        </div>

    </div>

    <div class="main-nav">
        <?php
        NavBar::begin([
            'options' => [
                'screenReaderToggleText' => 'Menu',
                'id' => 'menu',
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'nav navbar-nav navbar navbar-expand-lg navbar-light bg-light'],
            'activateParents'=>true,
            'items' => [
                ['label' => 'Главная', 'url' => ['/site/index']],
                ['label' => 'Каталог', 'url' => ['/shop/catalog/index'],
                    'items' => CategoryFetchingRepository::getMenuTreeStructure(),
                ],
                ['label' => 'Новинки', 'url' => ['/shop/catalog/newest']],
                ['label' => 'Распродажа', 'url' => ['/shop/catalog/sale']],
                ['label' => 'Блог', 'url' => ['/blog/post/index']],
                ['label' => 'Контакты', 'url' => ['/contact/index']],
            ],
        ]);
        NavBar::end();
        ?>
    </div>
</header>

<main>

    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        'options' => ['class' => 'breadcrumb', 'style' => 'padding: 8px 30px']
    ]); ?>
    <?= Alert::widget() ?>

    <?= $content ?>

</main>

<footer>

    <div class="col-12 footer-top">

        <div class="footer-top_categories col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <h3>Категории товаров</h3>
            <ul>
                <li><a href="<?= Html::encode(Url::to('/shop/catalog/index')); ?>">Каталог тканей</a></li>
                <li><a href="<?= Html::encode(Url::to('/shop/catalog/newest')); ?>">Новинки</a></li>
                <li><a href="<?= Html::encode(Url::to('/shop/catalog/sale')); ?>">Распродажа</a></li>
            </ul>
        </div>

        <div class="footer-top_info col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <h3>Информация</h3>
            <ul>
                <li><a href="<?= Html::encode(Url::to('/page/terms')); ?>">Оплата и доставка</a></li>
                <li><a href="<?= Html::encode(Url::to('/page/disclaimer')); ?>">Пользовательское соглашение</a></li>
                <li><a href="<?= Html::encode(Url::to('/page/copyrights')); ?>">Авторские права</a></li>
                <li><a href="<?= Html::encode(Url::to('/contact')); ?>">Контакты</a></li>
            </ul>
        </div>

        <div class="footer-top_address col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <h3>Контакты</h3>

            <h4>Наш адрес:</h4>
            <p class="city-and-postcode">Днепр 49027</p>
            <p class="street">ул. Жуковского 18 / P.S.Studio</p>

            <h4>Телефоны:</h4>
            <div class="footer-top_phones">

                <p><a href="tel:+380676318104">+38 (067) 631-81-04</a></p>

                <p><a href="tel:+380679831044">+38 (067) 983-10-44</a></p>

            </div>
        </div>

    </div>
    <div class="footer-bottom">

        <div class="footer-bottom_logo col-xs-12 col-sm-6 col-md-2 col-lg-2">
            <a href="/">
                <img src="/uploads/logo/Manufacture-2-300x98.png" alt="Manufacture17 footer logo">
            </a>
        </div>

        <div class="footer-bottom_copyright col-xs-12 col-sm-6 col-md-3">
            <p>&copy; 2018 - <?php echo date('Y'); ?> Manufacture17</p>
        </div>

        <div class="footer-bottom_phones">
            <p><a href="tel:+380676318104">+38 (067) 631-81-04</a><a href="tel:+380679831044">+38 (067) 983-10-44</a></p>
        </div>

    </div>

</footer>

<?= CallMe::widget(); ?>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>