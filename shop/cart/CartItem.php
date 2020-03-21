<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 08.02.19
 * Time: 0:17
 */

namespace shop\cart;

use shop\entities\Shop\Product\Modification;
use shop\entities\Shop\Product\Product;

class CartItem
{
    private $product;
    private $modificationId;
    private $quantity;

    public function __construct(Product $product, $modificationId, $quantity)
    {
//        if (!$product->canBeCheckout($modificationId, $quantity)) {
//            throw new \RuntimeException('Вы выбрали большее количество, чем есть в наличии. может быть в другом месте эту ошибку вызывать чтобы не убивался сайт7 shop\cart\CartItem');
//        }
        $this->product = $product;
        $this->modificationId = $modificationId;
        $this->quantity = $quantity;
    }

    public function getId(): string
    {
        return md5(serialize([$this->product->id, $this->modificationId]));
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getModificationId(): ?Modification
    {
        return $this->modificationId;
    }

    public function getModification(): ?Modification
    {
        if ($this->modificationId) {
            return $this->product->getModification($this->modificationId);
        }
        return null;
    }

    public function getQuantity(): int
    {
        return $this->quantity ? $this->quantity : 1;
    }

    public function getPrice(): int
    {
        if ($this->modificationId) {
            return $this->product->getModificationPrice($this->modificationId);
        }
        // Крупный опт
        if ($this->product->price_roll && $this->product->roll_long && $this->quantity >= $this->product->roll_long) {
            return $this->product->price_roll;
        }
        // Мелкий опт
        if ($this->product->price_min && $this->product->min_long && $this->quantity >= $this->product->min_long) {
            return $this->product->price_min;
        }
        return $this->product->price_new;
    }

//    public function getWeight(): int
//    {
//        return $this->product->weight * $this->quantity;
//    }

    public function getCost(): int
    {
        return $this->getPrice() * $this->quantity;
    }

    public function plus($quantity)
    {
        return new static($this->product, $this->modificationId, $this->quantity + $quantity);
    }

    public function changeQuantity($quantity)
    {
        return new static($this->product, $this->modificationId, $quantity);
    }
}