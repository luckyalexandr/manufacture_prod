<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 17.02.19
 * Time: 4:24
 */

namespace shop\entities\Shop\Order;


class CustomerData
{
    public $phone;
    public $name;
    public $email;

    public function __construct($phone, $name, $email)
    {
        $this->phone = $phone;
        $this->name = $name;
        $this->email = $email;
    }
}