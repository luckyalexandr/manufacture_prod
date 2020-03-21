<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 17.02.19
 * Time: 4:44
 */

namespace shop\forms\Shop\Order;

use yii\base\Model;

class CustomerForm extends Model
{
    public $phone;
    public $name;
    public $email;

    public function rules(): array
    {
        return [
            [['phone', 'name', 'email'], 'required'],
            [['name', 'phone', 'email'], 'string', 'max' => 255],
            ['email', 'email'],
//            ['phone', 'match', 'pattern' => '\+[0-9] \([0-9]{3}\) [0-9]{3}-[0-9]{2}-[0-9]{2}$', 'message' => ' Что-то не так'],
        ];
    }
}