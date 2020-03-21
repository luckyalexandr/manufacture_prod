<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 30.01.19
 * Time: 2:17
 */

namespace frontend\controllers\shop;


use shop\entities\Shop\Product\Product;
use shop\fetching\Shop\BrandFetchingRepository;
use shop\fetching\Shop\CategoryFetchingRepository;
use shop\fetching\Shop\ProductFetchingRepository;
use shop\fetching\Shop\TagFetchingRepository;
use shop\forms\Shop\AddToCartForm;
use shop\forms\Shop\OrderForm;
use shop\forms\Shop\ReviewForm;
use shop\forms\Shop\Search\SearchForm;
use shop\services\merchant\Merchant;
use shop\services\Shop\ReviewService;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class CatalogController extends Controller
{
    public $layout = 'catalog';

    private $service;
    private $products;
    private $categories;
    private $brands;
    private $tags;

    public function __construct(
        $id,
        $module,
        ReviewService $service,
        ProductFetchingRepository $products,
        CategoryFetchingRepository $categories,
        BrandFetchingRepository $brands,
        TagFetchingRepository $tags,
        $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
        $this->products = $products;
        $this->categories = $categories;
        $this->brands = $brands;
        $this->tags = $tags;
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = $this->products->getAll();
        $category = $this->categories->getRoot();

        return $this->render('index', [
            'category' => $category,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return mixed
     */
    public function actionSale()
    {
        $dataProvider = $this->products->getSale();

        return $this->render('sale', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionCategory($id)
    {
        if (!$category = $this->categories->find($id)) {
            throw new NotFoundHttpException('Запрашиваемая страница не существует.');
        }

        $dataProvider = $this->products->getAllByCategory($category);

        if (Yii::$app->request->get('page') > 1) {
            Yii::$app->view->registerLinkTag([
                'rel' => 'canonical',
                'href' => Yii::$app->urlManager->createAbsoluteUrl($category->slug),
            ]);
        }

        return $this->render('category', [
            'category' => $category,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionBrand($id)
    {
        if (!$brand = $this->brands->find($id)) {
            throw new NotFoundHttpException('Запрашиваемая страница не существует.');
        }

        $dataProvider = $this->products->getAllByBrand($brand);

        return $this->render('brand', [
            'brand' => $brand,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionTag($id)
    {
        if (!$tag = $this->tags->find($id)) {
            throw new NotFoundHttpException('Запрашиваемая страница не существует.');
        }

        $dataProvider = $this->products->getAllByTag($tag);

        return $this->render('tag', [
            'tag' => $tag,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionNewest()
    {
        $dataProvider = $this->products->getNewestP();

        return $this->render('newest', [
            'dataProvider' => $dataProvider
            ]);
    }

    /**
     * @return mixed
     */
    public function actionSearch()
    {
        $form = new SearchForm();
        $form->load(\Yii::$app->request->queryParams);
        $form->validate();

        $dataProvider = $this->products->search($form);

        return $this->render('search', [
            'dataProvider' => $dataProvider,
            'searchForm' => $form,
        ]);
    }

    public function actionProduct($id)
    {
        if (!$product = $this->products->find($id)) {
            throw new NotFoundHttpException('Запрашиваемая страница не существует.');
        }
        $this->redirect(['slug-product', 'slug' => $product->slug], 301);
    }

    /**
     * @param $slug
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionSlugProduct($slug)
    {
        if (!$product = $this->products->findBySlug($slug)) {
            throw new NotFoundHttpException('Запрашиваемая страница не существует.');
        }

        $this->layout = 'blank';

        $cartForm = new AddToCartForm($product);
        $reviewForm = new ReviewForm();
        $recommended = $this->products->getRecommended(4);

        if ($reviewForm->load(Yii::$app->request->post()) && $reviewForm->validate()) {
            try {
                $review = $this->service->create($product->id, Yii::$app->user->id, $reviewForm);
                return $this->redirect(['product', 'id' => $product->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        Yii::$app->view->registerLinkTag([
            'rel' => 'canonical',
            'href' => Yii::$app->urlManager->createAbsoluteUrl($product->category->slug),
        ]);

        return $this->render('product', [
            'product' => $product,
            'cartForm' => $cartForm,
            'reviewForm' => $reviewForm,
            'recommended' => $recommended,
        ]);
    }

    public function actionMerchant()
    {
        $merchant = new Merchant();
        if (Yii::$app->cache->get('renderFeed') != $merchant->renderFeed()) {
            $xml_merchant = $merchant->renderFeed();
            Yii::$app->cache->set('renderFeed', $xml_merchant, 3600*12);
        } else {
            $xml_merchant = Yii::$app->cache->get('renderFeed');
        }

        return Yii::$app->response->sendContentAsFile($xml_merchant, Url::canonical(), [
            'mimeType' => 'application/xml',
            'inline' => true
        ]);
    }
}