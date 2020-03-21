<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 19.01.19
 * Time: 13:21
 */

namespace backend\controllers\shop;


use shop\entities\Shop\Product\Product;
use shop\forms\manage\Shop\Product\ModificationForm;
use shop\services\manage\Shop\ProductManageService;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ModificationController extends Controller
{
    private $service;

    public function __construct($id, $module, ProductManageService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->redirect('shop/products');
    }

    /**
     * @param $product_id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionCreate($product_id)
    {
        $product = $this->findModel($product_id);

        $form = new ModificationForm();
        if ($form->load(\Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->addModification($product->id, $form);
                return $this->redirect(['shop/product/view', 'id' => $product->id, '#' => 'modifications']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', [
            'product' => $product,
            'model' => $form,
        ]);
    }

    /**
     * @param $product_id
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($product_id, $id)
    {
        $product = $this->findModel($product_id);
        $modification = $product->getModification($id);

        $form = new ModificationForm($modification);
        if ($form->load(\Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->editModification($product->id, $modification->id, $form);
                return $this->redirect(['shop/product/view', 'id' => $product->id, '#' => 'modifications']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', [
            'product' => $product,
            'model' => $form,
            'modification' => $modification,
        ]);
    }

    public function actionDelete($product_id, $id)
    {
        $product = $this->findModel($product_id);
        try {
            $this->service->removeModification($product->id, $id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['shop/product/view', 'id' => $product->id, '#' => 'modifications']);
    }

    /**
     * @param integer $id
     * @return Product
     * @throws NotFoundHttpException
     */
    protected function findModel($id): Product
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Запрашеваема страница не существует. ');
    }
}