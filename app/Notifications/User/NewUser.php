<?php

namespace App\Notifications\User;

use App\Helpers\FormatHelpers;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewUser extends Notification
{
    use Queueable;

    private $token;
    private $name;

    /**
     * Construtor NewUser.
     *
     * @param $token
     * @param $name
     */
    public function __construct($token, $name)
    {
        $this->token = $token;
        $this->name  = $name;
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

        $mailMessage->subject('Notificação de definição de senha');
        $mailMessage->greeting('Olá ' . FormatHelpers::first_word($this->name) . ',');
        $mailMessage->line('Você está recebendo este e-mail porque foi realizado uma criação de usuário com o seu e-mail no sistema ' . config('app.name') . ', para estarmos concluindo o cadastro por favor, clique no botão abaixo e confirme o seu endereço de e-mail e defina uma senha para acesso ao sistema.');
        $mailMessage->action('Concluir cadastro', route('password.reset', $this->token));
        $mailMessage->line('<span class="notice">Se você desconhece está solicitação de criação de usuário, nenhuma outra ação será necessária.</span>');

        return $mailMessage;
    }
}
