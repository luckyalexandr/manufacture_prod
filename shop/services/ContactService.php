<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 25.07.18
 * Time: 10:25
 */

namespace shop\services;


use shop\forms\ContactForm;
use yii\mail\MailerInterface;

class ContactService
{
    private $adminEmail;
    private $mailer;

    public function __construct($adminEmail, MailerInterface $mailer)
    {
        $this->adminEmail = $adminEmail;
        $this->mailer = $mailer;
    }

    /**
     * @param \shop\forms\ContactForm $form
     */
    public function send(ContactForm $form): void
    {
        $sent = $this->mailer->compose(
            [
                'html' => 'contact/form-html',
                'text' => 'contact/form-text'
            ],
            ['form' => $form])
            ->setTo('office@manufacture17.com.ua')
            ->setSubject($form->subject)
            ->setTextBody($form->body)
            ->send();

        if (!$sent) {
            throw new \RuntimeException('Ошибка отправки.');
        }
    }
}