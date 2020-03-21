<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 17.02.19
 * Time: 5:46
 */

namespace frontend\controllers\shop;

use LisDev\Delivery\NovaPoshtaApi2;
use shop\cart\Cart;
use shop\forms\Shop\Order\DeliveryForm;
use shop\forms\Shop\Order\OrderForm;
use shop\services\Shop\OrderService;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class CheckoutController extends Controller
{
    public $layout = 'blank';

    private $service;
    private $cart;
    public $option;
    public $cities;

    public function __construct($id, $module, OrderService $service, Cart $cart, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
        $this->cart = $cart;
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
                    [
                        'actions' => ['guest', 'cities', 'warehouses', 'finish'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $form = new OrderForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $order = $this->service->checkout(Yii::$app->user->id, $form);
                return $this->redirect(['/shop/checkout/finish']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('index', [
            'cart' => $this->cart,
            'model' => $form,
        ]);
    }

    /**
     * @return mixed
     */
    public function actionGuest()
    {
        $form = new OrderForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->guestCheckout($form);
                Yii::$app->session->setFlash('success', 'Ваш заказ принят. В ближайшее время наши менеджеры свяжутся с вами для уточнения деталей оплаты.');
                return $this->redirect(['/shop/checkout/finish']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('index', [
            'cart' => $this->cart,
            'model' => $form,
        ]);
    }

    public function actionCities()
    {
        $cities = [];
        if(Yii::$app->request->isAjax)
        {
            $area = (int)Yii::$app->request->post('area');
            $model = new OrderForm();
            $np = new NovaPoshtaApi2('91a670da73ca78be05a661578766a6f6');
            $ref = $np->getAreas()['data'][$area]['Ref'];
            foreach ($np->getCities()['data'] as $i => $city) {
                if ($city['Area'] == $ref) {
                    $cities[] = $city;
                }
            }
            $this->option  = '<option value="0">Выберите населенный пункт...</option>';
            foreach($cities as $i => $city){
                $this->option .= '<option value="'.$city['Ref'].'">'.$city['DescriptionRu'].'</option>';
            }
        }
        return $this->option;
    }

    public function actionWarehouses()
    {
        if(Yii::$app->request->isAjax)
        {
            $city = Yii::$app->request->post('city');
            $model = new OrderForm();
//            var_dump($city);die;
            $np = new NovaPoshtaApi2('91a670da73ca78be05a661578766a6f6');
            $warehouses = $np->getWarehouses($city);
//            var_dump($warehouses);die;
            $this->option  = '<option value="0">Выберите отделение...</option>';
            foreach($warehouses['data'] as $i => $warehouse){
                $this->option .= '<option>'.$warehouse['DescriptionRu'].'</option>';
            }
        }
        return $this->option;
    }

    public function actionFinish()
    {
        return $this->render('finish');
    }
}