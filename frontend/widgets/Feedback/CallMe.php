<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 04.10.2019
 * Time: 15:39
 */

namespace frontend\widgets\Feedback;

use shop\forms\CallMeForm;
use shop\services\CallMeService;
use Yii;
use yii\base\Widget;

class CallMe extends Widget
{
    private $service;

    public function __construct(CallMeService $service, $config = [])
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * @return mixed
     */
    public function run()
    {
        $form = new CallMeForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate())
        {
            try {
                $this->service->send($form);
                Yii::$app->session->setFlash('callMeFormSubmitted');
            } catch (\Exception $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }
        }
        return $this->render('call-me', [
            'model' => $form,
        ]);
    }
}