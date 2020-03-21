<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 04.10.2019
 * Time: 21:30
 */

namespace shop\forms;

use yii\base\Model;

class SamplesForm extends Model
{
    public $name;
    public $phone;
    public $email;
    public $address;
    public $articles;
    public $verifyCode;

    public function rules()
    {
        return [
            [['name', 'phone', 'address', 'articles'], 'string'],
            [['name', 'phone', 'email', 'address', 'articles'], 'required'],
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Ф.И.О.',
            'phone' => 'Телефон',
            'email' => 'Email',
            'address' => 'Адрес',
            'articles' => 'Список артикулов',
            'verifyCode' => 'Код проверки',
        ];
    }
}