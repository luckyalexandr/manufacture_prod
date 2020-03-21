<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 22.02.19
 * Time: 9:53
 */

namespace shop\fetching\Blog;

use shop\entities\Blog\Tag;

class TagFetchingRepository
{
    public function findBySlug($slug): ?Tag
    {
        return Tag::findOne(['slug' => $slug]);
    }
}