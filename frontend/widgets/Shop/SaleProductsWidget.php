<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 21.02.19
 * Time: 16:32
 */

namespace frontend\widgets\Shop;

use shop\fetching\Shop\ProductFetchingRepository;
use yii\base\Widget;

class SaleProductsWidget extends Widget
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
        return $this->render('sale', [
            'sale' => $this->repository->getMainSale($this->limit),
        ]);
    }
}