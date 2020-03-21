<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 07.08.18
 * Time: 12:08
 */

namespace shop\forms\manage\User;

use shop\entities\User\User;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class UserCreateForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $role;

    public function rules(): array
    {
        return [
            [['username', 'email', 'role'], 'required'],
            ['email', 'email'],
            [['username', 'email'], 'string', 'max' => 255],
            [['username', 'email'], 'unique', 'targetClass' => User::class],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'username' => 'Имя пользователя',
            'email' => 'Емейл',
            'password' => 'Пароль',
            'role' => 'Роль',
        ];
    }

    public function rolesList(): array
    {
        return ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description');
    }
}