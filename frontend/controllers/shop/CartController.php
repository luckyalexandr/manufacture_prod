<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 07.02.19
 * Time: 23:51
 */

namespace frontend\controllers\shop;


use shop\fetching\Shop\ProductFetchingRepository;
use shop\forms\Shop\AddToCartForm;
use shop\services\Shop\CartService;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class CartController extends Controller
{
    public $layout = 'blank';

    private $products;
    private $service;

    public function __construct($id, $module, CartService $service, ProductFetchingRepository $products, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->products = $products;
        $this->service = $service;
    }

    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'quantity' => ['POST'],
                    'remove' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $cart = $this->service->getCart();

        return $this->render('index', [
            'cart' => $cart,
        ]);
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionAdd($id)
    {
        if (!$product = $this->products->find($id)) {
            throw new NotFoundHttpException('Запрашиваемая страница не существует.');
        }

        if (!$product->modifications) {
            try {
                $q = Yii::$app->request->post('AddToCartForm');
                $this->service->add($product->id, null, $q['quantity']);
                Yii::$app->session->setFlash('success', 'Товар успешно добавлен в корзину!');
                return $this->redirect(Yii::$app->request->referrer);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        $this->layout = 'blank';

        $form = new AddToCartForm($product);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->add($product->id, $form->modification, $form->quantity);
                return $this->redirect(['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('add', [
            'product' => $product,
            'model' => $form,
        ]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function actionQuantity($id)
    {
        try {
            $this->service->set($id, (int)Yii::$app->request->post('quantity'));
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function actionRemove($id)
    {
        try {
            $this->service->remove($id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }
}