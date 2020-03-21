<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 04.10.2019
 * Time: 21:48
 */

namespace shop\services;


use shop\forms\SamplesForm;
use yii\mail\MailerInterface;

class SamplesService
{
    private $adminEmail;
    private $mailer;

    public function __construct($adminEmail, MailerInterface $mailer)
    {
        $this->mailer = $mailer;
        $this->adminEmail = $adminEmail;
    }

    public function send(SamplesForm $form): void
    {
        $sent = $this->mailer->compose(
            [
                'html' => 'samples/form-html',
                'text' => 'samples/form-text'
            ],
            ['form' => $form])
            ->setTo('office@manufacture17.com.ua')
            ->setSubject($form->name)
            ->setTextBody($form->address)
            ->send();

        if (!$sent) {
            throw new \RuntimeException('Ошибка отправки.');
        }
    }
}