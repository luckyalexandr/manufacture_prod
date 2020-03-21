<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 21.02.19
 * Time: 23:17
 */

namespace shop\repositories\Blog;

use shop\entities\Blog\Tag;
use shop\repositories\NotFoundException;

class TagRepository
{
    public function get($id): Tag
    {
        if (!$tag = Tag::findOne($id)) {
            throw new NotFoundException('Tag is not found.');
        }
        return $tag;
    }

    public function findByName($name): ?Tag
    {
        return Tag::findOne(['name' => $name]);
    }

    public function save(Tag $tag): void
    {
        if (!$tag->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Tag $tag): void
    {
        if (!$tag->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}