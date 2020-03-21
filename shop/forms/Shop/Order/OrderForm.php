<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 17.02.19
 * Time: 4:43
 */

namespace shop\forms\Shop\Order;

use shop\forms\CompositeForm;

/**
 * @property DeliveryForm $delivery
 * @property CustomerForm $customer
 */
class OrderForm extends CompositeForm
{
    public $payment_type;
    public $note;

    public function __construct(array $config = [])
    {
        $this->delivery = new DeliveryForm();
        $this->customer = new CustomerForm();
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['note'], 'string'],
            [['payment_type'], 'integer'],
        ];
    }

    protected function internalForms(): array
    {
        return ['delivery', 'customer'];
    }
}