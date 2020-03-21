<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 19.02.19
 * Time: 11:07
 */

namespace shop\services\manage\Shop;

use shop\entities\Shop\Order\CustomerData;
use shop\entities\Shop\Order\DeliveryData;
use shop\forms\manage\Shop\Order\OrderEditForm;
use shop\repositories\Shop\DeliveryMethodRepository;
use shop\repositories\Shop\OrderRepository;

class OrderManageService
{
    private $orders;
    private $deliveryMethods;
    public function __construct(OrderRepository $orders, DeliveryMethodRepository $deliveryMethods)
    {
        $this->orders = $orders;
        $this->deliveryMethods = $deliveryMethods;
    }
    public function edit($id, OrderEditForm $form): void
    {
        $order = $this->orders->get($id);
        $order->edit(
            new CustomerData(
                $form->customer->phone,
                $form->customer->name,
                $form->customer->email
            ),
            $form->note
        );
        $order->setDeliveryInfo(
            $this->deliveryMethods->get($form->delivery->method),
            new DeliveryData(
                $form->delivery->address,
                $form->delivery->area,
                $form->delivery->city,
                $form->delivery->warehouse
            )
        );
        $this->orders->save($order);
    }
    public function remove($id): void
    {
        $order = $this->orders->get($id);
        $this->orders->remove($order);
    }
}