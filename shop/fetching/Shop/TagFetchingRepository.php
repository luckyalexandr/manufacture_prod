<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 31.01.19
 * Time: 0:32
 */

namespace shop\fetching\Shop;

use shop\entities\Shop\Tag;

class TagFetchingRepository
{
    public function find($id): ?Tag
    {
        return Tag::findOne($id);
    }
}