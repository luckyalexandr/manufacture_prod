<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 26.01.19
 * Time: 12:13
 */

namespace shop\repositories\Shop;


use shop\entities\Shop\Newest;
use shop\repositories\NotFoundException;

class NewestRepository
{
    public function get($id): Newest
    {
        if (!$newest = Newest::findOne($id)) {
            throw new NotFoundException('Newest is not found.');
        }
        return $newest;
    }

    public function save(Newest $newest): void
    {
        if (!$newest->save()) {
            throw new \RangeException('Saving error.');
        }
    }

    public function remove(Newest $newest): void
    {
        if (!$newest->delete()) {
            throw new \RangeException('Removing error.');
        }
    }
}