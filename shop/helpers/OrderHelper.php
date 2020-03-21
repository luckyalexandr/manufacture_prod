<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 19.02.19
 * Time: 15:09
 */

namespace shop\helpers;

use shop\entities\Shop\Order\Status;
use shop\entities\Shop\Product\Product;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class OrderHelper
{
    public static function statusList(): array
    {
        return [
            Status::NEW => 'Новый',
            Status::PAID => 'Оплачен',
            Status::SENT => 'Отправлен',
            Status::COMPLETED => 'Завершен',
            Status::CANCELLED => 'Отменен',
            Status::CANCELLED_BY_CUSTOMER => 'Отменен пользователем',
        ];
    }

    public static function statusName($status): string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    public static function statusLabel($status): string
    {
        switch ($status) {
            case Product::STATUS_DRAFT:
                $class = 'label label-default';
                break;
            case Product::STATUS_ACTIVE:
                $class = 'label label-success';
                break;
            default:
                $class = 'label label-default';
        }
        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class,
        ]);
    }
}