<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 08.01.19
 * Time: 8:32
 */

namespace shop\entities\Shop\Product;


use shop\entities\Shop\Product\queries\ProductQuery;
use yii\db\ActiveRecord;

/**
 * Class Review
 * @package shop\entities\Shop\Product
 *
 * @property int $id
 * @property int $created_at
 * @property int $user_id
 * @property int $product_id
 * @property int $vote
 * @property string $text
 * @property bool $active
 */
class Review extends ActiveRecord
{
    public static function create($userId, int $vote, string $text): self
    {
         $review = new static();
         $review->user_id = $userId;
         $review->vote = $vote;
         $review->text = $text;
         $review->created_at = time();
         $review->active = false;
         return $review;
    }

    public function edit($vote, $text): void
    {
        $this->vote = $vote;
        $this->text = $text;
    }

    public function activate(): void
    {
        $this->active = true;
    }

    public function draft(): void
    {
        $this->active = false;
    }

    public function isActive(): bool
    {
        return $this->active == true;
    }

    public function getRating(): int
    {
        return $this->vote;
    }

    /**
     * @return ProductQuery
     */
    public function getProduct(): ProductQuery
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    public function isIdEqualTo($id): bool
    {
        return $this->id == $id;
    }

    public static function tableName(): string
    {
        return '{{%shop_reviews}}';
    }
}