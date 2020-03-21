<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 03.01.19
 * Time: 12:05
 */

namespace shop\entities\Shop\Product;


use yii\db\ActiveRecord;

/**
 * Class CategoryAssignment
 * @package shop\entities\Shop\Product
 *
 * @property integer $product_id;
 * @property integer $category_id;
 */
class CategoryAssignment extends ActiveRecord
{
    public static function create($categoryId): self
    {
        $assignment = new static();
        $assignment->category_id = $categoryId;
        return $assignment;
    }

    public function isForCategory($id): bool
    {
        return $this->category_id == $id;
    }

    public static function tableName(): string
    {
        return '{{%shop_category_assignments}}';
    }
}