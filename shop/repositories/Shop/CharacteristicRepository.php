<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 09.01.19
 * Time: 23:34
 */

namespace shop\repositories\Shop;


use shop\entities\Shop\Characteristic;
use shop\repositories\NotFoundException;

class CharacteristicRepository
{
    public function get($id): Characteristic
    {
        if (!$characteristic = Characteristic::findOne($id)) {
            throw new NotFoundException('Characteristic is not found.');
        }
        return $characteristic;
    }

    public function save(Characteristic $characteristic): void
    {
        if (!$characteristic->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Characteristic $characteristic): void
    {
        if (!$characteristic->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}