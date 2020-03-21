<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 24.07.18
 * Time: 16:37
 */

namespace shop\services\auth;


use shop\entities\User\User;
use shop\repositories\UserRepository;
use shop\forms\auth\PasswordResetRequestForm;
use shop\forms\auth\ResetPasswordForm;
use Yii;
use yii\mail\MailerInterface;

class PasswordResetService
{
    private $mailer;
    private $users;

    public function __construct(UserRepository $users, MailerInterface $mailer)
    {
        $this->mailer = $mailer;
        $this->users = $users;
    }

    /**
     * @param \shop\forms\auth\PasswordResetRequestForm $form
     * @throws \yii\base\Exception
     */
    public function request(PasswordResetRequestForm $form): void
    {
        /* @var $user \shop\entities\User\User */
        $user = $this->users->getByEmail($form->email);

        if (!$user->isActive()) {
            throw new \DomainException('Пользователь не активен.');
        }

        $user->requestPasswordReset();
        $this->users->save($user);

        $sent = $this->mailer
            ->compose(
                [
                    'html' => 'auth/reset/confirm-html',
                    'text' => 'auth/reset/confirm-text'
                ],
                ['user' => $user]
            )
            ->setTo($user->email)
            ->setSubject('Сброс пароля для ' . Yii::$app->name)
            ->send();

        if (!$sent) {
            throw new \RuntimeException('Ошибка отправки.');
        }
    }

    /**
     * @param $token
     */
    public function validateToken($token): void
    {
        if (empty($token) || !is_string($token)) {
            throw new \DomainException('Токен сброса пароля не может быть пустым.');
        }
        if (!$this->users->existsByPasswordResetToken($token)) {
            throw new \DomainException('Неверный токен сброса пароля.');
        }
    }

    /**
     * @param string $token
     * @param \shop\forms\auth\ResetPasswordForm $form
     * @throws \yii\base\Exception
     */
    public function reset(string $token, ResetPasswordForm $form): void
    {
        $user = $this->users->getByPasswordResetToken($token);

        if (!$user) {
            throw new \DomainException('Пользователь не найден.');
        }

        $user->resetPassword($form->password);

       $this->users->save($user);
    }
}