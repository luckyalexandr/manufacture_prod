<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 13.01.19
 * Time: 8:42
 */

namespace backend\controllers\shop;

use backend\forms\Shop\ProductSearch;
use shop\entities\Meta;
use shop\entities\Shop\Product\Modification;
use shop\entities\Shop\Product\Product;
use shop\forms\manage\Shop\Product\LongitudeForm;
use shop\forms\manage\Shop\Product\PhotosForm;
use shop\forms\manage\Shop\Product\PriceForm;
use shop\forms\manage\Shop\Product\ProductCreateForm;
use shop\forms\manage\Shop\Product\ProductEditForm;
use shop\forms\manage\Shop\Product\QuantityForm;
use shop\services\manage\Shop\ProductManageService;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ProductController extends Controller
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
                    'activate' => ['POST'],
                    'draft' => ['POST'],
					'delete-photo' => ['POST'],
					'move-photo-up' => ['POST'],
					'move-photo-down' => ['POST'],
				],
			],
		];
	}

	/**
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new ProductSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

    /**
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
	public function actionView($id)
	{
		$product = $this->findModel($id);

		$modificationsProvider = new ActiveDataProvider([
			'query' => $product->getModifications()->orderBy('name'),
            'key' => function (Modification $modification) use ($product) {
		        return [
		            'product_id' => $product->id,
                    'id' => $modification->id,
                ];
            },
            'pagination' => false,
		]);

        $photosForm = new PhotosForm();
        if ($photosForm->load(Yii::$app->request->post()) && $photosForm->validate()) {
            try {
                $this->service->addPhotos($product->id, $photosForm);
                return $this->redirect(['view', 'id' => $product->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('view', [
            'product' => $product,
            'modificationsProvider' => $modificationsProvider,
            'photosForm' => $photosForm,
        ]);
	}

    /**
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new ProductCreateForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $product = $this->service->create($form);
                return $this->redirect(['view', 'id' => $product->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', [
            'model' => $form,
        ]);
    }

    /**
     * @param integer $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $product = $this->findModel($id);
        $form = new ProductEditForm($product);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($product->id, $form);
                return $this->redirect(['view', 'id' => $product->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'model' => $form,
            'product' => $product,
        ]);
    }

    /**
     * @param $id
     * @throws NotFoundHttpException
     */
    public function actionSetSlug()
    {
//        $product = $this->findModel($id);

        foreach (Product::find()->all() as $product) {
            try {
                $this->service->setSlug($product);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
    }

    /**
     * @param integer $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionPrice($id)
    {
        $product = $this->findModel($id);

        $form = new PriceForm($product);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->changePrice($product->id, $form);
                return $this->redirect(['view', 'id' => $product->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('price', [
            'model' => $form,
            'product' => $product,
        ]);
    }

    /**
     * @param integer $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionLongitude($id)
    {
        $product = $this->findModel($id);

        $form = new LongitudeForm($product);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->changeLongitude($product->id, $form);
                return $this->redirect(['view', 'id' => $product->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('longitude', [
            'model' => $form,
            'product' => $product,
        ]);
    }

    /**
     * @param integer $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionQuantity($id)
    {
        $product = $this->findModel($id);
        $form = new QuantityForm($product);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->changeQuantity($product->id, $form);
                return $this->redirect(['view', 'id' => $product->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('quantity', [
            'model' => $form,
            'product' => $product,
        ]);
    }

    /**
     * @param integer $id
     * @return \yii\web\Response
     */
    public function actionDelete($id)
    {
        try {
            $this->service->remove($id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionActivate($id)
    {
        try {
            $this->service->activate($id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionDraft($id)
    {
        try {
            $this->service->draft($id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * @param integer $id
     * @param $photo_id
     * @return \yii\web\Response
     */
    public function actionDeletePhoto($id, $photo_id)
    {
        try {
            $this->service->removePhoto($id, $photo_id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'id' => $id, '#' => 'photos']);
    }

    /**
     * @param integer $id
     * @param $photo_id
     * @return \yii\web\Response
     */
    public function actionMovePhotoUp($id, $photo_id)
    {
        $this->service->movePhotoUp($id, $photo_id);
        return $this->redirect(['view', 'id' => $id, '#' => 'photos']);
    }

    /**
     * @param integer $id
     * @param $photo_id
     * @return \yii\web\Response
     */
    public function actionMovePhotoDown($id, $photo_id)
    {
        $this->service->movePhotoDown($id, $photo_id);
        return $this->redirect(['view', 'id' => $id, '#' => 'photos']);
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

    public function actionImportExcel()
    {
        $inputFile = 'uploads/export.xlsx';
        try{
            $inputFileType = \PHPExcel_IOFactory::identify($inputFile);
            $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFile);
        } catch (\DomainException $e) {
            die('Error');
        }

        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        for($row=1; $row <= $highestRow; $row++)
        {
            $rowData = $sheet->rangeToArray('A'.$row.':'.$highestColumn.$row,NULL,TRUE,FALSE);

            if($row==1)
            {
                continue;
            }

            $product = new Product();
            $product->brand_id = $rowData[0][0];
            $product->category_id  = $rowData[0][1];
            $product->code  = $rowData[0][2];
            $product->name  = $rowData[0][3];
            $product->description  = $rowData[0][4];
            $product->price_new  = $rowData[0][5];
            $product->price_min  = $rowData[0][6];
            $product->price_roll  = $rowData[0][7];
            $product->meta = new Meta($rowData[0][8],
                                    $rowData[0][9],
                                    $rowData[0][10]
                                );
            $product->status  = $rowData[0][11];
            $product->quantity  = $rowData[0][12];
            $product->min_long  = $rowData[0][13];
            $product->roll_long  = $rowData[0][14];
            $product->created_at = time();
            $product->save();

            print_r($product->getErrors());
        }
        return $this->redirect('index');
    }
}
