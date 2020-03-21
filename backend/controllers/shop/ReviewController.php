<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 02.03.19
 * Time: 16:47
 */

namespace backend\controllers\shop;

use backend\forms\Shop\ReviewSearch;
use shop\entities\Shop\Product\Product;
use shop\forms\manage\Shop\Product\ReviewEditForm;
use shop\services\manage\Shop\ReviewManageService;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class ReviewController extends Controller
{
    private $service;

    public function __construct($id, $module, ReviewManageService $service, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new ReviewSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param integer $product_id
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionUpdate($product_id, $id)
    {
        $product = $this->findModel($product_id);
        $review = $product->getReview($id);

        $form = new ReviewEditForm($review);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($product->id, $review->id, $form);
                return $this->redirect(['view', 'product_id' => $product->id, 'id' => $review->id]);
            } catch (\DomainException $e) {

            }  Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->render('update', [
            'product' => $product,
            'model' => $form,
            'review' => $review,
        ]);
    }

    /**
     * @param integer $product_id
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionView($product_id, $id)
    {
        $product = $this->findModel($product_id);
        $review = $product->getReview($id);
        return $this->render('view', [
            'product' => $product,
            'review' => $review
        ]);
    }

    /**
     * @param $product_id
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionActivate($product_id, $id)
    {
        $product = $this->findModel($product_id);
        try {
            $this->service->activate($product->id, $id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'product_id' => $product_id, 'id' => $id]);
    }

    /**
     * @param integer $product_id
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionDelete($product_id, $id)
    {
        $product = $this->findModel($product_id);
        try {
            $this->service->remove($product->id, $id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }


    /**
     * @param $id
     * @return Product
     * @throws NotFoundHttpException
     */
    protected function findModel($id): Product
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}