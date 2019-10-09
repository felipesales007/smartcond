<?php

namespace App\Notifications\Company;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RecoverCompany extends Notification
{
    use Queueable;

    private $name;

    /**
     * Construtor RecoverCompany.
     *
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
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

        $mailMessage->subject('Notificação de recuperação do condomínio');
        $mailMessage->greeting('Olá,');
        $mailMessage->line('Você está recebendo este e-mail porque foi realizado a <span class="text-success">recuperação do condomínio <b>' . $this->name . '</b></span> no sistema ' . config('app.name'));
        $mailMessage->action('Acessar sistema', route('login'));
        $mailMessage->line('<span class="notice">Se você desconhece está ação, procure o administrador do sistema.</span>');

        return $mailMessage;
    }
}
