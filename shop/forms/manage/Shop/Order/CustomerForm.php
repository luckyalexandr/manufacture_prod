<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 19.02.19
 * Time: 19:03
 */

namespace shop\forms\manage\Shop\Order;

use shop\entities\Shop\Order\Order;
use yii\base\Model;

class CustomerForm extends Model
{
    public $phone;
    public $name;
    public $email;

    public function __construct(Order $order, array $config = [])
    {
        $this->phone = $order->customerData->phone;
        $this->name = $order->customerData->name;
        $this->email = $order->customerData->email;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['phone', 'name', 'email'], 'required'],
            [['phone', 'name', 'email'], 'string', 'max' => 255],
            ['email', 'email'],
        ];
    }
}