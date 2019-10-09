<?php

namespace App\Notifications\Company;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BlockCompany extends Notification
{
    use Queueable;

    private $name;
    private $blocked;

    /**
     * Construtor BlockCompany.
     *
     * @param $name
     * @param $blocked
     */
    public function __construct($name, $blocked)
    {
        $this->name    = $name;
        $this->blocked = $blocked;
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

        if ($this->blocked) {
            $mailMessage->subject('Notificação de bloqueio do condomínio');
            $mailMessage->greeting('Olá,');
            $mailMessage->line('Você está recebendo este e-mail porque foi realizado o <span class="text-warning">bloqueio do condomínio <b>' . $this->name . '</b>' . $this->blocked . '</span>no qual seu e-mail está vinculado no sistema ' . config('app.name'));
            $mailMessage->action('Visualizar sistema', route('login'));
            $mailMessage->line('<span class="notice">Se você desconhece está ação, procure o administrador do sistema.</span>');
        } else {
            $mailMessage->subject('Notificação de desbloqueio do condomínio');
            $mailMessage->greeting('Olá,');
            $mailMessage->line('Você está recebendo este e-mail porque foi realizado o <span class="text-success">desbloqueio do condomínio <b>' . $this->name . '</b></span> no qual seu e-mail está vinculado no sistema ' . config('app.name'));
            $mailMessage->action('Acessar sistema', route('login'));
            $mailMessage->line('<span class="notice">Se você desconhece está ação, procure o administrador do sistema.</span>');
        }

        return $mailMessage;
    }
}
