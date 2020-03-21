<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 19.02.19
 * Time: 19:02
 */

namespace shop\forms\manage\Shop\Order;

use shop\entities\Shop\DeliveryMethod;
use shop\entities\Shop\Order\Order;
use shop\helpers\PriceHelper;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class DeliveryForm extends Model
{
    public $method;
    public $address;
    public $area;
    public $city;
    public $warehouse;

    private $_order;

    public function __construct(Order $order, array $config = [])
    {
        $this->method = $order->delivery_method_id;
        $this->address = $order->deliveryData->address;
        $this->area = $order->deliveryData->area;
        $this->area = $order->deliveryData->city;
        $this->warehouse = $order->deliveryData->warehouse;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['method'], 'integer'],
            [['address', 'area', 'city', 'warehouse'], 'required'],
            [['address', 'area', 'city', 'warehouse'], 'string'],
        ];
    }

    public function deliveryMethodsList(): array
    {
        $methods = DeliveryMethod::find()->orderBy('sort')->all();
        return ArrayHelper::map($methods, 'id', function (DeliveryMethod $method) {
            return $method->name . ' (' . PriceHelper::format($method->cost) . ')';
        });
    }
}