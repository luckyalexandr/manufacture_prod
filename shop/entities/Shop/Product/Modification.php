<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 04.01.19
 * Time: 15:06
 */

namespace shop\entities\Shop\Product;


use yii\db\ActiveRecord;

/**
 * Class Modification
 * @package shop\entities\Shop\Product
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $price
 * @property int $quantity
 */
class Modification extends ActiveRecord
{
    public static function create($code, $name, $price, $quantity): self
    {
        $modification = new static();
        $modification->code = $code;
        $modification->name = $name;
        $modification->price = $price;
        $modification->quantity = $quantity;
        return $modification;
    }

    public function edit($code, $name, $price, $quantity): void
    {
        $this->code = $code;
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    public function checkout($quantity): void
    {
        if ($quantity > $this->quantity) {
            throw new \DomainException('Доступно ' . $this->quantity . ' едииц товара.');
        }
        $this->quantity -= $quantity;
    }

    public function isIdEqualTo($id): bool
    {
        return $this->id == $id;
    }

    public function isCodeEqualTo($code): bool
    {
        return $this->code == $code;
    }

    public static function tableName(): string
    {
        return '{{%shop_modifications}}';
    }
}