<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 30.07.18
 * Time: 14:17
 */

namespace frontend\controllers\auth;

use shop\forms\auth\LoginForm;
use shop\services\auth\AuthService;
use Yii;
use yii\web\Controller;

class AuthController extends Controller
{
    private $service;

    public function __construct(string $id, $module, AuthService $service,  $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $form = new LoginForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $user = $this->service->auth($form);
                Yii::$app->user->login($user, $form->rememberMe ? 3600 * 24 * 30 : 0);
                return $this->goBack();
            } catch (\DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('login', [
            'model' => $form,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}