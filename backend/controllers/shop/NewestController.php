<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 28.01.19
 * Time: 3:51
 */

namespace backend\controllers\shop;


use backend\forms\Shop\NewestSearch;
use shop\entities\Shop\Newest;
use shop\forms\manage\Shop\NewestForm;
use shop\services\manage\Shop\NewestManageService;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class NewestController extends Controller
{
    private $service;

    public function __construct(string $id, $module, NewestManageService $service, $config = [])
    {
        $this->service = $service;
        parent::__construct($id, $module, $config);
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

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'newest' => $this->findModel($id)
        ]);
    }

    /**
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new NewestForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $newest = $this->service->create($form);
                return $this->redirect(['view', 'id' => $newest->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', ['model' => $form]);
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $newest = $this->findModel($id);
        $form = new NewestForm($newest);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($newest->id, $form);
                return $this->redirect(['view', 'id' => $newest->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'model' => $form,
            'newest' => $newest,
        ]);
    }

    /**
     * @param $id
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
     * @param $id
     * @return Newest
     * @throws NotFoundHttpException
     */
    public function findModel($id): Newest
    {
        if (($model = Newest::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Запрашиваемая страница не найдена.');
    }
}