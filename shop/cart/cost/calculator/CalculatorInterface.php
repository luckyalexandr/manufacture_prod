<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 08.02.19
 * Time: 11:46
 */

namespace shop\cart\cost\calculator;

use shop\cart\CartItem;
use shop\cart\cost\Cost;

interface CalculatorInterface
{
    /**
     * @param CartItem[] $items
     * @return Cost
     */
    public function  getCost(array $items): Cost;
}