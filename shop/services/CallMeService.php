<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 04.10.2019
 * Time: 16:04
 */

namespace shop\services;

use shop\forms\CallMeForm;
use yii\mail\MailerInterface;

class CallMeService
{
    private $adminEmail;
    private $mailer;

    public function __construct($adminEmail, MailerInterface $mailer)
    {
        $this->adminEmail = $adminEmail;
        $this->mailer = $mailer;
    }

    public function send(CallMeForm $form): void
    {
        $sent = $this->mailer->compose(
            [
                'html' => 'call-me/form-html',
                'text' => 'call-me/form-text'
            ],
            ['form' => $form])
            ->setTo('office@manufacture17.com.ua')
            ->setSubject($form->name)
            ->setTextBody($form->phone)
            ->send();

        if (!$sent) {
            throw new \RuntimeException('Ошибка отправки.');
        }
    }
}