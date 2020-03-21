<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 31.01.19
 * Time: 8:55
 */

namespace shop\fetching\Shop\views;


use shop\entities\Shop\Category;

class CategoryView
{
    public $category;
    public $count;

    public function __construct(Category $category, $count)
    {
        $this->category = $category;
        $this->count = $count;
    }
}