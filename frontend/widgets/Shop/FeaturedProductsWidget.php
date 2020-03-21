<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 01.02.19
 * Time: 14:59
 */

namespace frontend\widgets\Shop;

use shop\fetching\Shop\ProductFetchingRepository;
use yii\base\Widget;

class FeaturedProductsWidget extends Widget
{
    public $limit;

    private $repository;

    public function __construct(ProductFetchingRepository $repository, $config = [])
    {
        parent::__construct($config);
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->render('featured', [
            'products' => $this->repository->getFeatured($this->limit),
        ]);
    }
}