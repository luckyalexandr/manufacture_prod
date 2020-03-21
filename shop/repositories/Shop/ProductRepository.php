<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 03.01.19
 * Time: 9:52
 */

namespace shop\repositories\Shop;


use shop\entities\Shop\Product\Product;
use shop\repositories\NotFoundException;

class ProductRepository
{
    public function get($id): Product
    {
        if (!$product = Product::findOne($id)) {
            throw new NotFoundException('Product is not found.');
        }
        return $product;
    }

    public function existsByBrand(int $id): bool
    {
        return Product::find()->andWhere(['brand_id' => $id])->exists();
    }

    public function existsByMainCategory($id): bool
    {
        return Product::find()->andWhere(['category_id' => $id])->exists();
    }

    public function save(Product $product): void
    {
        if (!$product->save()) {
            throw new \RangeException('Saving error.');
        }
    }

    public function remove(Product $product): void
    {
        if (!$product->delete()) {
            throw new \RangeException('Removing error.');
        }
    }
}