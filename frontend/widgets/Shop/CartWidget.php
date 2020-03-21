<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 10.02.19
 * Time: 0:59
 */

namespace frontend\widgets\Shop;

use shop\cart\Cart;
use yii\base\Widget;

class CartWidget extends Widget
{
    private $cart;

    public function __construct(Cart $cart, $config = [])
    {
        parent::__construct($config);
        $this->cart = $cart;
    }

    public function run(): string
    {
        return $this->render('cart', [
            'cart' => $this->cart,
        ]);
    }
}