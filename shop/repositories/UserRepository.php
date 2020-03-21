<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 29.07.18
 * Time: 13:42
 */

namespace shop\repositories;

use shop\entities\User\User;

class UserRepository
{
    public function findByUsernameOrEmail($value): ?User
    {
        return User::find()->andWhere(['or', ['username' => $value], ['email' => $value]])->one();
    }

    public function findByNetworkIdentity($network, $identity): ?User
    {
        return User::find()->joinWith('network n')->andWhere(['n.network' => $network, 'n.identity' => $identity])->one();
    }

    public function get($id): User
    {
        return $this->getBy(['id' => $id]);
    }

    public function getByEmailConfirmToken($token)
    {
        return $this->getBy(['email_confirm_token' => $token]);
    }
    public function getByEmail($email)
    {
        return $this->getBy(['email' => $email]);
    }

    public function getByPasswordResetToken($token)
    {
        return $this->getBy(['password_reset_token' => $token]);
    }

    public function existsByPasswordResetToken(string $token)
    {
        return (bool) User::findByPasswordResetToken($token);
    }

    public function save(User $user): void
    {
        if (!$user->save()) {
            throw new \RuntimeException('Ошибка при сохранении пользователя.');
        }
    }

    public function remove(User $user): void
    {
        if (!$user->delete()) {
            throw new \RuntimeException('Ошибка при удалении пользователя.');
        }
    }

    /**
     * @param array $condition
     * @return array|null|\yii\db\ActiveRecord
     */
    private function getBy(array $condition)
    {
        if (!$user = User::find()->andWhere($condition)->limit(1)->one()) {
            throw new NotFoundException('Проверьте правильность ссылки.');
        }
        return $user;
    }
}