<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 03.02.19
 * Time: 21:09
 */

namespace shop\forms\manage\Shop\Product;

use shop\entities\Shop\Product\Product;
use yii\base\Model;

class LongitudeForm extends Model
{
    public $min_long;
    public $roll_long;

    public function __construct(Product $product = null, $config = [])
    {
        if ($product) {
            $this->min_long = $product->min_long;
            $this->roll_long = $product->roll_long;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['min_long', 'roll_long'], 'integer', 'min' => 0],
            ['min_long', 'default', 'value' => 10],
            ['roll_long', 'default', 'value' => 35],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'min_long' => 'Мелкий опт',
            'roll_long' => 'Крупный опт',
        ];
    }
}