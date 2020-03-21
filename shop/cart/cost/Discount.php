<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 08.02.19
 * Time: 11:45
 */

namespace shop\cart\cost;

final class Discount
{
    private $value;
    private $name;

    public function __construct(float $value, string $name)
    {
        $this->value = $value;
        $this->name = $name;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function getName(): string
    {
        return $this->name;
    }
}