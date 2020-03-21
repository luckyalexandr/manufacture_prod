<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 17.02.19
 * Time: 4:47
 */

namespace shop\services\Shop;

use yii\base\Model;

class CustomerForm extends Model
{
    public $phone;
    public $name;

    public function rules(): array
    {
        return [
            [['phone', 'name'], 'required'],
            [['phone', 'name'], 'string', 'max' => 255],
        ];
    }
}