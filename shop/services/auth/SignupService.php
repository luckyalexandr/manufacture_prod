<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 22.07.18
 * Time: 16:39
 */

namespace shop\services\auth;


use shop\entities\User\User;
use shop\repositories\UserRepository;
use shop\forms\auth\SignupForm;
use shop\access\Rbac;
use shop\services\RoleManager;
use shop\services\TransactionManager;
use yii\mail\MailerInterface;

class SignupService
{
    private $mailer;
    private $users;
    private $roles;
    private $transaction;

    public function __construct(
        UserRepository $users,
        MailerInterface $mailer,
        RoleManager $roles,
        TransactionManager $transaction
    )
    {
        $this->mailer = $mailer;
        $this->users = $users;
        $this->roles = $roles;
        $this->transaction = $transaction;
    }

    public function signup(SignupForm $form)
    {
        if (User::find()->andWhere(['username' => $form->username])->one()) {
            throw new \DomainException('Пользователь с таким username уже зарегистрирован. Попробуйте использовать другой.');
        }

        if (User::find()->andWhere(['email' => $form->email])->one()) {
            throw new \DomainException('Этот email уже зарегистрирован на сайте.');
        }

        $user = User::requestSignup(
            $form->username,
            $form->email,
            $form->password
        );

        $this->transaction->wrap(function () use ($user) {
            $this->users->save($user);
            $this->roles->assign($user->id, Rbac::ROLE_USER);
        });

        $sent = $this->mailer
            ->compose(
                [
                    'html' => 'auth/signup/confirm-html',
                    'text' => 'auth/signup/confirm-text'
                ],
                ['user' => $user]
            )
            ->setTo($form->email)
            ->setSubject('Подтверждение регистрации для ' . \Yii::$app->name)
            ->send();

        if (!$sent) {
            throw new \RuntimeException('Ошибка при отправке email.');
        }
    }

    public function confirm($token): void
    {
        if (empty($token)) {
            throw new \DomainException('Пустой токен подтверждения.');
        }

        $user = $this->users->getByEmailConfirmToken(['email_confirm_token' => $token]);

        if (!$user) {
            throw new \DomainException('Пользователь не найден.');
        }

        $user->confirmSignup();

        $this->users->save($user);
    }
}