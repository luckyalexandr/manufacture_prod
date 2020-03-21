<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 20.02.19
 * Time: 15:30
 */

namespace frontend\controllers\cabinet;

//use shop\cart\LiqPay;
//use shop\entities\Shop\Order\Order;
//use shop\entities\Shop\Order\Status;
//use Yii;
//use yii\helpers\Url;
use shop\fetching\Shop\OrderFetchingRepository;
use shop\services\Shop\OrderService;
use yii\filters\AccessControl;
use yii\mail\MailerInterface;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class OrderController extends Controller
{
    public $layout = 'cabinet';
    private $orders;
    private $service;
    private $mailer;

//    private $public_key = 'i72808534072';
//    private $private_key = 'T2amsDDJbyNdND7IqNeN3F8gaE7G3RqhgS7hRPQX';

    public function __construct($id, $module, OrderFetchingRepository $orders, OrderService $service, MailerInterface $mailer, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->orders = $orders;
        $this->service = $service;
        $this->mailer = $mailer;
    }

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
//                    [
//                        'actions' => ['view'],
//                        'allow' => true,
//                        'roles' => ['?'],
//                    ],
                ],
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = $this->orders->getOwm(\Yii::$app->user->id);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        if (!$order = $this->orders->findOwn(\Yii::$app->user->id, $id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $this->render('view', [
            'order' => $order,
        ]);
    }

//    /**
//     * @param $id
//     * @return mixed
//     * @throws NotFoundHttpException
//     */
//    public function actionView($id)
//    {
//        if (!$order = $this->orders->findOwn(\Yii::$app->user->id, $id)) {
//            throw new NotFoundHttpException('The requested page does not exist.');
//        }
//
//        $liqpay = new LiqPay($this->public_key, $this->private_key);
//        $html = $liqpay->cnb_form(array(
//            'action'         => 'pay',
//            'amount'         => $order->cost,
//            'currency'       => 'UAH',
//            'sandbox'        => true,
//            'description'    => 'Оплата заказа на Manufacture17.com.ua',
//            'order_id'       => $order->id,
//            'version'        => '3',
//            'server_url'     => Url::home('https') .  'cabinet/order/result',
//            'result_url'     => Url::home('https') .  'cabinet/order/result'
//        ));
//
//        return $this->render('view', [
//            'order' => $order,
//            'html' => $html,
//        ]);
//    }

//    public function actionResult()
//    {
//        $arr = json_decode(base64_decode(Yii::$app->request->post('data')), true, 2,JSON_OBJECT_AS_ARRAY);
//
//        $order = Order::findOne(['id' => $arr['order_id']]);
//
//        if ($arr['status'] == 'sandbox') {
//            $this->service->pay($arr['order_id']);
//            $office = $this->mailer->compose(
//                [
//                    'html' => 'shop/checkout-html',
//                    'text' => 'shop/checkout-text'
//                ],
//                ['order' => $order]
//            )
//                ->setTo('office@manufacture17.com.ua')
//                ->setSubject('Новый заказ ' . \Yii::$app->name)
//                ->send();
//
//            if (!$office) {
//                throw new \RuntimeException('Ошибка при отправке email.');
//            }
//
//            $sent = $this->mailer->compose(
//                [
//                    'html' => 'shop/checkout-html',
//                    'text' => 'shop/checkout-text'
//                ],
//                ['order' => $order]
//                )
//                ->setTo('elmira@psstudiomodel.com')
//                ->setSubject('Новый заказ ' . \Yii::$app->name)
//                ->send();
//
//            if (!$sent) {
//                throw new \RuntimeException('Ошибка при отправке email.');
//            }
//        }
//
//        return $this->redirect(['view', 'id' => $arr['order_id'],
//            'order' => $order,
//            'arr' => $arr,
//        ]);
//    }
//
//    /**
//     * @inheritdoc
//     */
//    public function beforeAction($action)
//    {
//        if ($action->id == 'result') {
//            $this->enableCsrfValidation = false;
//        }
//
//        return parent::beforeAction($action);
//    }
}