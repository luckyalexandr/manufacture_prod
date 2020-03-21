<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 04.01.19
 * Time: 1:36
 */

namespace shop\services;


class TransactionManager
{
    public function wrap(callable $function): void
    {
        \Yii::$app->db->transaction($function);
    }
}