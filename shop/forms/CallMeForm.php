<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 04.10.2019
 * Time: 17:15
 */

namespace shop\forms;

use yii\base\Model;

class CallMeForm extends Model
{
    public $name;
    public $phone;
    public $verifyCode;

    public function rules()
    {
        return [
            [['name', 'phone'], 'string', 'max' => 100],
            [['name', 'phone'], 'required'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Как к Вам обращаться?',
            'phone' => 'Номер телефона',
            'verifyCode' => 'Код проверки',
        ];
    }
}