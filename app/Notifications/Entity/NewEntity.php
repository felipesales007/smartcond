<?php

namespace App\Notifications\Entity;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewEntity extends Notification
{
    use Queueable;

    private $collection;

    /**
     * Construtor NewEntity.
     *
     * @param $collection
     */
    public function __construct($collection)
    {
        $collection->state_id = $collection->state_id ? $collection->getState->name : null;
        $this->collection = $collection;
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

        $mailMessage->subject('Notificação de criação de condomínio');
        $mailMessage->greeting('Olá,');
        $mailMessage->line('Você está recebendo este e-mail porque foi realizado uma criação de condomínio no sistema ' . config('app.name') . ', e o seu endereço de e-mail foi definido como contato do condomínio criado, segue abaixo os dados do condomínio:');

        if ($this->collection->cnpj) {
            $mailMessage->line('<b>CNPJ: </b>' . $this->collection->cnpj);
        }

        if ($this->collection->name) {
            $mailMessage->line('<b>Nome: </b>' . $this->collection->name);
        }

        if ($this->collection->corporate_name) {
            $mailMessage->line('<b>Razão social: </b>' . $this->collection->corporate_name);
        }

        if ($this->collection->email) {
            $mailMessage->line('<b>E-mail:</b> ' . $this->collection->email);
        }

        if ($this->collection->contact) {
            $mailMessage->line('<b>Contato: </b>' . $this->collection->contact);
        }

        if ($this->collection->postal_code) {
            $mailMessage->line('<b>CEP: </b>' . $this->collection->postal_code);
        }

        if ($this->collection->address) {
            $mailMessage->line('<b>Endereço: </b>' . $this->collection->address);
        }

        if ($this->collection->house_number) {
            $mailMessage->line('<b>nº: </b>' . $this->collection->house_number);
        }

        if ($this->collection->complement) {
            $mailMessage->line('<b>Complemento: </b>' . $this->collection->complement);
        }

        if ($this->collection->neighborhood) {
            $mailMessage->line('<b>Bairro: </b>' . $this->collection->neighborhood);
        }

        if ($this->collection->city) {
            $mailMessage->line('<b>Cidade: </b>' . $this->collection->city);
        }

        if ($this->collection->state_id) {
            $mailMessage->line('<b>Estado: </b>' . $this->collection->state_id);
        }

        if ($this->collection->country) {
            $mailMessage->line('<b>País: </b>' . $this->collection->country);
        }

        if ($this->collection->logo) {
            $mailMessage->line('<b>Logo: </b><a href="' . url('storage/images/companies/logo/' . $this->collection->logo) . '" class="badge badge-pill badge-info">clique para visualizar</a>');
        }

        $mailMessage->action('Acessar sistema', route('login'));
        $mailMessage->line('<span class="notice">Se você desconhece está solicitação de criação de condomínio vinculada ao seu endereço de e-mail, procure o administrador do sistema.</span>');

        return $mailMessage;
    }
}
