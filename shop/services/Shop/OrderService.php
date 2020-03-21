<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 17.02.19
 * Time: 4:47
 */

namespace shop\services\Shop;

use shop\cart\Cart;
use shop\cart\CartItem;
use shop\entities\Shop\Order\CustomerData;
use shop\entities\Shop\Order\DeliveryData;
use shop\entities\Shop\Order\Order;
use shop\entities\Shop\Order\OrderItem;
use shop\forms\Shop\Order\OrderForm;
use shop\repositories\Shop\DeliveryMethodRepository;
use shop\repositories\Shop\OrderRepository;
use shop\repositories\Shop\ProductRepository;
use shop\repositories\UserRepository;
use shop\services\TransactionManager;
use yii\mail\MailerInterface;

class OrderService
{
    private $cart;
    private $orders;
    private $products;
    private $users;
    private $deliveryMethods;
    private $transaction;
    private $mailer;

    public function __construct(
        Cart $cart,
        OrderRepository $orders,
        ProductRepository $products,
        UserRepository $users,
        DeliveryMethodRepository $deliveryMethods,
        TransactionManager $transaction,
        MailerInterface $mailer
    )
    {
        $this->cart = $cart;
        $this->orders = $orders;
        $this->products = $products;
        $this->users = $users;
        $this->deliveryMethods = $deliveryMethods;
        $this->transaction = $transaction;
        $this->mailer = $mailer;
    }

    public function checkout($userId, OrderForm $form): Order
    {
        $user = $this->users->get($userId);

        $products = [];

        $items = array_map(function (CartItem $item) use (&$products) {
            $product = $item->getProduct();
            $product->checkout($item->getModificationId(), $item->getQuantity());
            $products[] = $product;
            return OrderItem::create(
                $product,
                $item->getModificationId(),
                $item->getPrice(),
                $item->getQuantity()
            );
        }, $this->cart->getItems());

        $order = Order::create(
            $user->id,
            new CustomerData(
                $form->customer->phone,
                $form->customer->name,
                $form->customer->email
            ),
            $items,
            $this->cart->getCost()->getTotal(),
            $form->note
        );

        $order->setDeliveryInfo(
            $this->deliveryMethods->get($form->delivery->method),
            new DeliveryData(
                $form->delivery->address,
                $form->delivery->area,
                $form->delivery->city,
                $form->delivery->warehouse
            )
        );

        $this->transaction->wrap(function () use ($order, $products) {
            $this->orders->save($order);
            foreach ($products as $product) {
                $this->products->save($product);
            }
            // Усли корзина живет в куках то здесь
//            $this->cart->clear();
        });
        // Если корзина хранится в БД то здесь
        $this->cart->clear();

        $office = $this->mailer->compose(
            [
                'html' => 'shop/checkout/user/checkout-user-html',
                'text' => 'shop/checkout/user/checkout-user-text'
            ],
            ['order' => $order, 'user' => $user]
        )
            ->setTo('office@manufacture17.com.ua')
            ->setSubject('Новый заказ ' . \Yii::$app->name)
            ->send();

        if (!$office) {
            throw new \RuntimeException('Ошибка при отправке email.');
        }

        $sent = $this->mailer->compose(
            [
                'html' => 'shop/checkout/user/checkout-user-html',
                'text' => 'shop/checkout/user/checkout-user-text'
            ],
            ['order' => $order, 'user' => $user]
        )
            ->setTo('elmira@psstudiomodel.com')
            ->setSubject('Новый заказ ' . \Yii::$app->name)
            ->send();

        if (!$sent) {
            throw new \RuntimeException('Ошибка при отправке email.');
        }

        $sentUser = $this->mailer->compose(
            [
                'html' => 'shop/checkout/user/checkout-user-to-html',
                'text' => 'shop/checkout/user/checkout-user-to-text'
            ],
            ['order' => $order, 'user' => $user]
        )
            ->setTo($form->customer->email)
            ->setSubject('Новый заказ ' . \Yii::$app->name)
            ->send();

        if (!$sentUser) {
            throw new \RuntimeException('Ошибка при отправке email.');
        }

        return $order;
    }

    public function guestCheckout(OrderForm $form): Order
    {
        $products = [];

        $items = array_map(function (CartItem $item) use (&$products) {
            $product = $item->getProduct();
            $product->checkout($item->getModificationId(), $item->getQuantity());
            $products[] = $product;
            return OrderItem::create(
                $product,
                $item->getModificationId(),
                $item->getPrice(),
                $item->getQuantity()
            );
        }, $this->cart->getItems());

        $order = Order::guest(
            new CustomerData(
                $form->customer->phone,
                $form->customer->name,
                $form->customer->email
            ),
            $items,
            $this->cart->getCost()->getTotal(),
            $form->note
        );

        $order->setDeliveryInfo(
            $this->deliveryMethods->get($form->delivery->method),
            new DeliveryData(
                $form->delivery->address,
                $form->delivery->area,
                $form->delivery->city,
                $form->delivery->warehouse
            )
        );

//        var_dump($order);die;

        $this->transaction->wrap(function () use ($order, $products) {
            $this->orders->save($order);
            foreach ($products as $product) {
                $this->products->save($product);
            }
            // Усли корзина живет в куках то здесь
//            $this->cart->clear();
        });
        // Если корзина хранится в БД то здесь
        $this->cart->clear();

        $office = $this->mailer->compose(
            [
                'html' => 'shop/checkout/guest/checkout-guest-html',
                'text' => 'shop/checkout/guest/checkout-guest-text'
            ],
            ['order' => $order]
        )
            ->setTo('office@manufacture17.com.ua')
            ->setSubject('Новый заказ ' . \Yii::$app->name)
            ->send();

        if (!$office) {
            throw new \RuntimeException('Ошибка при отправке email.');
        }

        $sent = $this->mailer->compose(
            [
                'html' => 'shop/checkout/guest/checkout-guest-html',
                'text' => 'shop/checkout/guest/checkout-guest-text'
            ],
            ['order' => $order]
            )
            ->setTo('elmira@psstudiomodel.com')
            ->setSubject('Новый заказ ' . \Yii::$app->name)
            ->send();

        if (!$sent) {
            throw new \RuntimeException('Ошибка при отправке email.');
        }

        $sentUser = $this->mailer->compose(
            [
                'html' => 'shop/checkout/guest/checkout-guest-to-html',
                'text' => 'shop/checkout/guest/checkout-guest-to-text'
            ],
            ['order' => $order]
        )
            ->setTo($form->customer->email)
            ->setSubject('Новый заказ ' . \Yii::$app->name)
            ->send();

        if (!$sentUser) {
            throw new \RuntimeException('Ошибка при отправке email.');
        }

        return $order;
    }

    public function pay($id): void
    {
        $order = $this->orders->get($id);
        $order->pay('liqpay');
        $this->orders->save($order);
    }
}
