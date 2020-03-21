<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 04.01.19
 * Time: 15:24
 */

namespace shop\entities\Shop\Product;

use yii\db\ActiveRecord;

/**
 * Class RelatedAssignment
 * @package shop\entities\Shop\Product
 *
 * @property integer $product_id
 * @property integer $related_id
 */
class RelatedAssignment extends ActiveRecord
{
    public static function create($productId): self
    {
        $assignment = new static();
        $assignment->related_id = $productId;
        return $assignment;
    }

    public function isForProduct($id): bool
    {
        return $this->related_id == $id;
    }

    public static function tableName(): string
    {
        return '{{%shop_related_assignments}}';
    }
}