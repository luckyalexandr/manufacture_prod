<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 28.01.19
 * Time: 5:21
 */

namespace backend\controllers\shop;


use backend\forms\Shop\MainSlideshowSearch;
use shop\entities\Shop\MainSlideshow;
use shop\forms\manage\Shop\MainSlideshowForm;
use shop\services\manage\Shop\MainSlideshowManageService;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class MainSlideshowController extends Controller
{
    private $service;

    public function __construct($id, $module, MainSlideshowManageService $service, $config = [])
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

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MainSlideshowSearch();
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
        return $this->render('view', [
            'slideshow' => $this->findModel($id),
        ]);
    }

    /**
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new MainSlideshowForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $slideshow = $this->service->create($form);
                return $this->redirect(['view', 'id' => $slideshow->id]);
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
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $slide = $this->findModel($id);
        $form = new MainSlideshowForm($slide);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($slide->id, $form);
                return $this->redirect(['view', 'id' => $slide->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('update', [
            'model' => $form,
            'slide' => $slide,
        ]);
    }

    /**
     * @param integer $id
     * @return mixed
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
     * @return MainSlideshow the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id): MainSlideshow
    {
        if (($model = MainSlideshow::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The request page does not exist.');
    }
}