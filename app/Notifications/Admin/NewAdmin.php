<?php

namespace App\Notifications\Admin;

use App\Helpers\FormatHelpers;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewAdmin extends Notification
{
    use Queueable;

    private $token;
    private $name;
    private $company;

    /**
     * Construtor NewUser.
     *
     * @param $token
     * @param $name
     * @param $company
     */
    public function __construct($token, $name, $company)
    {
        $this->token   = $token;
        $this->name    = $name;
        $this->company = $company;
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
        $mailMessage->line('Você está recebendo este e-mail porque foi realizado uma criação de usuário administrador com o seu e-mail no sistema ' . config('app.name') . ' vinculado na empresa ' . $this->company . ', para estarmos concluindo o cadastro por favor, clique no botão abaixo e confirme o seu endereço de e-mail e defina uma senha para acesso ao sistema.');
        $mailMessage->action('Concluir cadastro', route('password.reset', $this->token));
        $mailMessage->line('<span class="notice">Se você desconhece está solicitação de criação de usuário administrador, nenhuma outra ação será necessária.</span>');

        return $mailMessage;
    }
}
