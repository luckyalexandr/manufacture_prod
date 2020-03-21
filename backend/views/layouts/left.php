<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

<?= backend\widgets\ReMenu::widget(
[
    'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree',],
    'items' => [
        ['label' => 'Управление', 'options' => ['class' => 'header']],
        [
            'label' => 'Магазин',
            'icon' => 'fas fa-shopping-cart',
            'items' => [
                [
                    'label' => 'Товары',
                    'icon' => 'fas fa-box-open',
                    'url' => ['/shop/product'],
                    'active' => $this->context->id == 'shop/product'
                ],
                [
                    'label' => 'Отзывы',
                    'icon' => 'fas fa-file-signature',
                    'url' => ['/shop/review'],
                    'active' => $this->context->id == 'shop/review'
                ],
                [
                    'label' => 'Бренды',
                    'icon' => 'fas fa-atlas',
                    'url' => ['/shop/brand'],
                    'active' => $this->context->id == 'shop/brand'
                ],
                [
                    'label' => 'Категории',
                    'icon' => 'fas fa-boxes',
                    'url' => ['/shop/category'],
                    'active' => $this->context->id == 'shop/category'
                ],
                [
                    'label' => 'Характеристики',
                    'icon' => 'fab fa-wpforms',
                    'url' => ['/shop/characteristic'],
                    'active' => $this->context->id == 'shop/characteristic'
                ],
                [
                    'label' => 'Теги',
                    'icon' => 'fas fa-hashtag',
                    'url' => ['/shop/tag'],
                    'active' => $this->context->id == 'shop/tag'
                ],
                [
                    'label' => 'Методы доставки',
                    'icon' => 'fas fa-shipping-fast',
                    'url' => ['/shop/delivery'],
                    'active' => $this->context->id == 'shop/delivery'
                ],
                [
                    'label' => 'Заказы',
                    'icon' => 'fas fa-dolly',
                    'url' => ['/shop/order'],
                    'active' => $this->context->id == 'shop/order'
                ],
            ]
        ],
        ['label' => 'Блог', 'icon' => 'fas fa-bold', 'items' => [
            [
                'label' => 'Посты',
                'icon' => 'fas fa-file-signature',
                'url' => ['/blog/post/index'],
                'active' => $this->context->id == 'blog/post'
            ],
            [
                'label' => 'Комментарии',
                'icon' => 'fas fa-align-right',
                'url' => ['/blog/comment/index'],
                'active' => $this->context->id == 'blog/comment'
            ],
            [
                'label' => 'Теги',
                'icon' => 'fas fa-tags',
                'url' => ['/blog/tag/index'],
                'active' => $this->context->id == 'blog/tag'
            ],
            [
                'label' => 'Категории',
                'icon' => 'fas fa-folder-open',
                'url' => ['/blog/category/index'],
                'active' => $this->context->id == 'blog/category'
            ],
        ]],
        [
            'label' => 'Страницы',
            'icon' => 'file-o',
            'url' => ['/page/index'],
            'active' => $this->context->id == 'page'
        ],
        [
            'label' => 'Пользователи',
            'icon' => 'fas fa-users',
            'url' => ['/user/index'],
            'active' => $this->context->id == 'user'
        ],
        [
            'label' => 'Слайдер на главной',
            'icon' => 'far fa-images',
            'url' => ['/shop/main-slideshow/index'],
            'active' => $this->context->id == 'shop/main-slideshow'
        ],
    ],
]
) ?>

    </section>

</aside>
