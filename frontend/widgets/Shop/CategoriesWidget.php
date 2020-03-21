<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 31.01.19
 * Time: 8:52
 */

namespace frontend\widgets\Shop;

use shop\entities\Shop\Category;
use shop\entities\Shop\Product\Product;
use shop\fetching\Shop\CategoryFetchingRepository;
use shop\fetching\Shop\views\CategoryView;
use yii\base\Widget;
use yii\helpers\Html;

class CategoriesWidget extends Widget
{
    /** @var Category|null */
    public $active;

    private $categories;

    public function __construct(CategoryFetchingRepository $categories, $config = [])
    {
        parent::__construct($config);
        $this->categories = $categories;
    }

//    public function run(): string
//    {
//        return Html::tag('div', implode(PHP_EOL, array_map(function (CategoryView $view) {
//            $indent = ($view->category->depth > 1 ? str_repeat('&nbsp;&nbsp;&nbsp;', $view->category->depth - 1) . '- ' : '');
//            $active = $this->active && ($this->active->id == $view->category->id || $this->active->isChildOf($view->category));
//            return Html::a(
//                $indent . Html::encode($view->category->name) . ' (' . count($view->category->children) . ')',
//                ['/shop/catalog/category', 'id' => $view->category->id],
//                ['class' => $active ? 'list-group-item active' : 'list-group-item']
//            );
//        }, $this->categories->getFullTreeStructure())), [
//            'class' => 'list-group',
//        ]);
//    }
    public function run(): string
    {
        return Html::tag('div', implode(PHP_EOL, array_map(function (CategoryView $view) {
            $indent = ($view->category->depth > 1 ? str_repeat('&nbsp;&nbsp;&nbsp;', $view->category->depth - 1) . '- ' : '');
            $active = $this->active && ($this->active->id == $view->category->id || $this->active->isChildOf($view->category));
            return Html::a(
                $indent . Html::encode($view->category->name)/** . ' (' . count(Product::find()->where(['category_id' => $view->category->id])->all()) . ')'**/,
                ['/shop/catalog/category', 'id' => $view->category->id],
                ['class' => $active ? 'list-group-item active' : 'list-group-item']
            );
        }, $this->categories->getTreeWithSubsOf($this->active))), [
            'class' => 'list-group',
        ]);
    }
}