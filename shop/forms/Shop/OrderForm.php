<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 04.02.19
 * Time: 16:48
 */

namespace shop\forms\Shop;

use shop\entities\Shop\Product\Modification;
use shop\entities\Shop\Product\Product;
use shop\helpers\PriceHelper;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class OrderForm extends Model
{
    public $modification;
    public $quantity;

    private $_product;

    public function __construct(Product $product, $config = [])
    {
        $this->_product = $product;
        $this->quantity = 1;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return array_filter([
            $this->_product->modifications ? ['modification', 'required'] : false,
            ['quantity', 'required'],
        ]);
    }

    public function modificationsList(): array
    {
        return ArrayHelper::map($this->_product->modifications, 'id', function (Modification $modification) {
            return $modification->code . ' - ' . $modification->name . ' (' . PriceHelper::format($modification->price) . ') ';
        });
    }
}