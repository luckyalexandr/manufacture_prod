<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 16.02.19
 * Time: 1:39
 */

namespace shop\forms\manage\Shop\Product;

use shop\entities\Shop\Product\Product;
use yii\base\Model;

class QuantityForm extends Model
{
    public $quantity;

    public function __construct(Product $product = null, $config = [])
    {
        if ($product) {
            $this->quantity = $product->quantity;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['quantity'], 'required'],
            [['quantity'], 'integer', 'min' => 0],
        ];
    }
}