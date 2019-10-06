<?php

namespace App\Notifications\Profile;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendSupport extends Notification
{
    use Queueable;

    private $user;
    private $message;

    /**
     * Construtor SendSupport.
     *
     * @param $user
     * @param $message
     */
    public function __construct($user, $message)
    {
        $this->user    = $user;
        $this->message = $message;
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

        $mailMessage->subject('Notificação de suporte ao usuário');
        $mailMessage->greeting('Olá,');
        $mailMessage->line('Sou <b>' . $this->user->name . '</b> e venho através deste(a) <b>' . $this->message->reason_send_support_profile . '</b> informar a mensagem abaixo:');
        $mailMessage->line($this->message->message_send_support_profile);
        $mailMessage->line('<b>E-mail para resposta: </b><a href="mailto:' . $this->user->email . '">' . $this->user->email . '</a>');
        $mailMessage->action('Acessar sistema', route('login'));

        return $mailMessage;
    }
}
