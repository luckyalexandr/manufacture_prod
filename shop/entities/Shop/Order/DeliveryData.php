<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 17.02.19
 * Time: 4:25
 */

namespace shop\entities\Shop\Order;

class DeliveryData
{
    public $address;
    public $area;
    public $city;
    public $warehouse;

    public function __construct($address, $area, $city, $warehouse)
    {
        $this->address = $address;
        $this->area = $area;
        $this->city = $city;
        $this->warehouse = $warehouse;
    }
}