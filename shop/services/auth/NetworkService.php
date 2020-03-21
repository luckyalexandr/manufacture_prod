<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 05.08.18
 * Time: 10:48
 */

namespace shop\services\auth;


use shop\entities\User\User;
use shop\repositories\UserRepository;

class NetworkService
{
    private $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * @param $network
     * @param $identity
     * @return User
     * @throws \yii\base\Exception
     */
    public function auth($network, $identity): User
    {
        if ($user = $this->users->findByNetworkIdentity($network, $identity)) {
            return $user;
        }
        $user = User::signupByNetwork($network, $identity);
        $this->users->save($user);
        return $user;
    }

    public function attach($id, $network, $identity): void
    {
        if ($this->users->findByNetworkIdentity($network, $identity)) {
            throw new \DomainException('Эта соц. сеть уже подвязана.');
        }
        $user = $this->users->get($id);
        $user->attachNetwork($network, $identity);
        $this->users->save($user);
    }
}