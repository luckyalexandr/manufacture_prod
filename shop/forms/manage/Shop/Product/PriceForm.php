<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 31.12.18
 * Time: 9:27
 */

namespace shop\forms\manage\Shop\Product;

use shop\entities\Shop\Product\Product;
use yii\base\Model;

class PriceForm extends Model
{
    public $old;
    public $new;
    public $min;
    public $roll;

    public function __construct(Product $product = null, $config = [])
    {
        if ($product) {
            $this->new = $product->price_new;
            $this->old = $product->price_old;
            $this->min = $product->price_min;
            $this->roll = $product->price_roll;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['new'], 'required'],
            [['new', 'old', 'min', 'roll'], 'integer', 'min' => 0],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'new' => 'Новая',
            'old' => 'Старая',
            'min' => 'Опт',
            'roll' => 'Рулон',
        ];
    }
}