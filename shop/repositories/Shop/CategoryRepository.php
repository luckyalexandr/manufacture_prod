<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 10.12.18
 * Time: 9:28
 */

namespace shop\repositories\Shop;


use shop\entities\Shop\Category;
use shop\repositories\NotFoundException;
use yii\caching\TagDependency;

class CategoryRepository
{
    public function get($id): Category
    {
        if (!$category = Category::findOne($id)) {
            throw new NotFoundException('Category is not found.');
        }
        return $category;
    }

    public function save(Category $category): void
    {
        if (!$category->save()) {
            throw new \RangeException('Saving error.');
        }
        TagDependency::invalidate(\Yii::$app->cache, 'categories');
    }

    public function remove(Category $category): void
    {
        if (!$category->delete()) {
            throw new \RangeException('Removing error.');
        }
    }
}