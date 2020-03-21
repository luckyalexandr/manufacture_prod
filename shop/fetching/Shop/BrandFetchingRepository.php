<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 31.01.19
 * Time: 0:35
 */

namespace shop\fetching\Shop;


use shop\entities\Shop\Brand;

class BrandFetchingRepository
{
    public function find($id): ?Brand
    {
        return Brand::findOne($id);
    }
}