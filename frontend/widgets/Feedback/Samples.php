<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 04.10.2019
 * Time: 21:09
 */

namespace frontend\widgets\Feedback;

use shop\forms\SamplesForm;
use shop\services\SamplesService;
use Yii;
use yii\base\Widget;

class Samples extends Widget
{
    private $service;

    public function __construct(SamplesService $service, $config = [])
    {
        parent::__construct($config);
        $this->service = $service;
    }

    public function run()
    {
        $form = new SamplesForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate())
        {
            try {
                $this->service->send($form);
                Yii::$app->session->setFlash('success', 'Запрос отправлен. Мы свяжемся с Вами в ближайшее время.');
            } catch (\Exception $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }
        }
        return $this->render('samples', [
            'model' => $form,
        ]);
    }
}