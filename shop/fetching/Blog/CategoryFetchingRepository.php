<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 22.02.19
 * Time: 9:51
 */

namespace shop\fetching\Blog;

use shop\entities\Blog\Category;

class CategoryFetchingRepository
{
    public function getAll(): array
    {
        return Category::find()->orderBy('sort')->all();
    }

    public function find($id): ?Category
    {
        return Category::findOne($id);
    }

    public function findBySlug($slug): ?Category
    {
        return Category::find()->andWhere(['slug' => $slug])->one();
    }
}