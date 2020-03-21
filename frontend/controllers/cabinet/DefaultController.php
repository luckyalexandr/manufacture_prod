<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 05.08.18
 * Time: 13:42
 */

namespace frontend\controllers\cabinet;


use yii\filters\AccessControl;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function behaviors(): array
    {
        return [
            'access' =>  [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'cabinet';
        return $this->render('index');
    }
}