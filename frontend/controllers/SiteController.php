<?php
namespace frontend\controllers;

use shop\entities\Shop\MainSlideshow;
use shop\entities\Shop\Newest;
use shop\entities\Shop\Product\Product;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $slider = MainSlideshow::find()->all();
        $newest = Newest::find()->one();
        $newProducts = Product::find()->limit($newest->quantity)->all();
        return $this->render('index', [
            'slider' => $slider,
            'newest' => $newest,
            'newProducts' => $newProducts,
        ]);
    }

    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            if ($exception->statusCode == 404)
                return $this->render('error404', ['exception' => $exception]);
            else
                return $this->render('error', ['exception' => $exception]);
        }
    }
    

//    /**
//     * Displays about page.
//     *
//     * @return mixed
//     */
//    public function actionAbout()
//    {
//        return $this->render('about');
//    }
}