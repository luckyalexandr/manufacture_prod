<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 29.07.18
 * Time: 16:06
 */

namespace shop\services\auth;


use shop\entities\User\User;
use shop\forms\auth\LoginForm;
use shop\repositories\UserRepository;

class AuthService
{
    private $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function auth(LoginForm $form): User
    {
        $user = $this->users->findByUsernameOrEmail($form->username);
        if (!$user || !$user->isActive() || !$user->validatePassword($form->password)) {
            throw new \DomainException('Неверный логин или пароль.');
        }
        return $user;
    }

}