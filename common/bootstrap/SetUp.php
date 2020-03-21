<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 17.07.18
 * Time: 14:35
 */

namespace common\bootstrap;

use frontend\urls\CategoryUrlRule;
use shop\cart\Cart;
use shop\cart\cost\calculator\DynamicCost;
use shop\cart\cost\calculator\SimpleCost;
use shop\cart\storage\CookieStorage;
use shop\cart\storage\SessionStorage;
use shop\fetching\Shop\CategoryFetchingRepository;
use shop\services\auth\PasswordResetService;
use shop\services\CallMeService;
use shop\services\ContactService;
use shop\services\SamplesService;
use yii\base\BootstrapInterface;
use yii\di\Instance;
use yii\mail\MailerInterface;
use yii\rbac\ManagerInterface;
use yii\caching\Cache;

class SetUp implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $container = \Yii::$container;

        $container->setSingleton(PasswordResetService::class);

        $container->setSingleton(MailerInterface::class, function () use ($app) {
            return $app->mailer;
        });

        $container->setSingleton('cache', function () use ($app) {
            return $app->cache;
        });

        $container->setSingleton(ManagerInterface::class, function () use ($app) {
            return $app->authManager;
        });

        $container->setSingleton(ContactService::class, [], [
            $app->params['adminEmail'],
        ]);

        $container->setSingleton(CallMeService::class, [], [
            $app->params['adminEmail'],
        ]);

        $container->setSingleton(SamplesService::class, [], [
            $app->params['adminEmail'],
        ]);

        $container->setSingleton(Cache::class, function () use ($app) {
            return $app->cache;
        });

        $container->setSingleton(Cart::class, function () {
            return new Cart(
                new SessionStorage('cart', \Yii::$app->session),
                new DynamicCost(new SimpleCost())
            );
        });
    }
}