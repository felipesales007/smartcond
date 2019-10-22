<?php

namespace App\Notifications\Company;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendEmailCompany extends Notification
{
    use Queueable;

    private $name;
    private $message;

    /**
     * Construtor SendEmailCompany.
     *
     * @param $collection
     */
    public function __construct($collection)
    {
        $this->name    = $collection['name_send_email_company'];
        $this->message = $collection['message_send_email_company'];
    }

    /**
     * Receba os canais de entrega da notificação.
     *
     * @return array
     */
    public function via()
    {
        return ['mail'];
    }

    /**
     * Obtenha a representação de correio da notificação.
     *
     * @return MailMessage
     */
    public function toMail()
    {
        $mailMessage = new MailMessage();

        $mailMessage->subject('Notificação de e-mail');
        $mailMessage->greeting('Olá ' . $this->name . ',');
        $mailMessage->line('Sou ' . auth()->user()['name'] . ' e venho através deste e-mail informar a mensagem abaixo:');
        $mailMessage->line($this->message);
        $mailMessage->action('Acessar sistema', route('login'));
        $mailMessage->line('<span class="notice">Se você desconhece está mensagem, nenhuma outra ação será necessária.</span>');

        return $mailMessage;
    }
}
