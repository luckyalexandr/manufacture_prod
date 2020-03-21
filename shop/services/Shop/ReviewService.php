<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 02.03.19
 * Time: 15:35
 */

namespace shop\services\Shop;


use shop\entities\Shop\Product\Review;
use shop\forms\Shop\ReviewForm;
use shop\repositories\Shop\ProductRepository;
use shop\repositories\UserRepository;

class ReviewService
{
    private $products;
    private $users;

    public function __construct(ProductRepository $products, UserRepository $users)
    {
        $this->products = $products;
        $this->users = $users;
    }

    public function create($productId, $userId, ReviewForm $form): Review
    {
        $product = $this->products->get($productId);
        $user = $this->users->get($userId);

        $review = $product->addReview($user->id, $form->vote, $form->text);

        $this->products->save($product);

        return $review;
    }
}