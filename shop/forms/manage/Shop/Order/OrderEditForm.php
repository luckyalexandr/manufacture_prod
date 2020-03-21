<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 19.02.19
 * Time: 11:08
 */

namespace shop\forms\manage\Shop\Order;
use shop\entities\Shop\Order\Order;
use shop\forms\CompositeForm;
/**
 * @property DeliveryForm $delivery
 * @property CustomerForm $customer
 */
class OrderEditForm extends CompositeForm
{
    public $note;

    public function __construct(Order $order, array $config = [])
    {
        $this->note = $order->note;
        $this->delivery = new DeliveryForm($order);
        $this->customer = new CustomerForm($order);
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['note'], 'string'],
        ];
    }

    protected function internalForms(): array
    {
        return ['delivery', 'customer'];
    }
}