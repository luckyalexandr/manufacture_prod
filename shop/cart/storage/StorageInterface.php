<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 08.02.19
 * Time: 11:48
 */

namespace shop\cart\storage;

use shop\cart\CartItem;

interface StorageInterface
{
    /**
     * @return CartItem[]
     */
    public function load(): array;

    /**
     * @param CartItem[] $items
     */
    public function save(array $items): void;
}