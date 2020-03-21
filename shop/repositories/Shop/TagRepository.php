<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 12.08.18
 * Time: 17:27
 */

namespace shop\repositories\Shop;


use shop\entities\Shop\Tag;
use shop\repositories\NotFoundException;

class TagRepository
{
    public function get($id): Tag
    {
        if (!$tag = Tag::findOne($id)) {
            throw new NotFoundException('Tag is not foun.');
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