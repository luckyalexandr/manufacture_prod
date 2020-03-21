<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 20.02.19
 * Time: 21:51
 */

namespace frontend\controllers\shop;

use shop\cart\LiqPay;
use shop\entities\Shop\Order\Order;
use shop\fetching\Shop\OrderFetchingRepository;
use shop\services\Shop\OrderService;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PaymentController extends Controller
{
    public $enableCsrfValidation = false;

    private $public_key = 'i72808534072';
    private $private_key = 'T2amsDDJbyNdND7IqNeN3F8gaE7G3RqhgS7hRPQX';
    private $orders;
    private $service;

    public function __construct($id, $module, OrderFetchingRepository $orders, OrderService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->orders = $orders;
        $this->service = $service;
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'invoice' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionInvoice($id)
    {
        $order = $this->loadModel($id);
        $liqpay = new LiqPay($this->public_key, $this->private_key);
        $html = $liqpay->cnb_form(array(
            'action'         => 'pay',
            'amount'         => $order->cost,
            'currency'       => 'UAH',
            'sandbox'        => '1',
            'description'    => 'description text',
            'order_id'       => $order->id,
            'version'        => '3'
        ));

            echo $html;
    }

    /**
     * @param $id
     * @return Order
     * @throws NotFoundHttpException
     */
    private function loadModel($id): Order
    {
        if (!$order = $this->orders->findOwn(\Yii::$app->user->id, $id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        return $order;
    }

    private function payment()
    {
        $liqpay = new LiqPay($this->public_key, $this->private_key);
        $html = $liqpay->cnb_form(array(
            'action'         => 'pay',
            'amount'         => '1',
            'currency'       => 'UAH',
            'sandbox'        => '1',
            'description'    => 'description text',
            'order_id'       => 'order_id_1',
            'version'        => '3'
        ));
    }
}