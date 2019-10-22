<?php

namespace App\Notifications\Company;

use App\Models\State;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EditCompany extends Notification
{
    use Queueable;

    private $collection;
    private $original;

    /**
     * Construtor EditCompany.
     *
     * @param $collection
     * @param $original
     */
    public function __construct($collection, $original)
    {
        $collection->state_id = $collection->state_id ? $collection->getState->name : null;
        $this->collection     = $collection;
        $this->original       = $original;
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

        $mailMessage->subject('Notificação de alteração de empresa');
        $mailMessage->greeting('Olá,');

        if (!$this->original['email'] && $this->collection->email || $this->original['email'] == $this->collection->email) {
            $mailMessage->line('Você está recebendo este e-mail porque foi realizado uma alteração dos dados da empresa no qual seu endereço de e-mail está relacionado no sistema ' . config('app.name') . ', e o seu endereço de e-mail está definido como contato da empresa, segue abaixo os dados alterados da empresa:');
        } elseif ($this->original['email'] && !$this->collection->email) {
            $mailMessage->line('Você está recebendo este e-mail porque foi realizado uma alteração dos dados da empresa no qual seu endereço de e-mail estava relacionado no sistema ' . config('app.name') . ', e o seu endereço de e-mail foi <span class="text-warning">removido</span> como contato da empresa, segue abaixo os dados alterados da empresa:');
        } elseif ($this->original['email'] != $this->collection->email) {
            $mailMessage->line('Você está recebendo este e-mail porque foi realizado uma alteração dos dados da empresa, no qual houve uma alteração de e-mail de <span class="text-warning">' . $this->original['email'] . '</span> para <span class="text-success">' . $this->collection->email . '</span> no sistema ' . config('app.name') . ', e o endereço de e-mail ' . $this->collection->email . ' foi definido como contato da empresa, segue abaixo os dados alterados da empresa:');
        }

        // cnpj
        if (isset($this->collection->getChanges()['cnpj']) && !$this->original['cnpj']) {
            $mailMessage->line('<b>CNPJ: </b>' . $this->collection->cnpj);
        }

        if (isset($this->collection->getChanges()['cnpj']) && $this->original['cnpj']) {
            $mailMessage->line('<b>CNPJ: </b>' . $this->collection->cnpj . '<br><small class="text-warning notice"><b>removido: </b>' . $this->original['cnpj'] . '</small>');
        }

        if (!$this->collection->cnpj && $this->original['cnpj']) {
            $mailMessage->line('<span class="text-warning"><b>CNPJ: </b>' . $this->original['cnpj'] . '</span> <span class="badge badge-pill badge-warning">removido</span>');
        }

        // nome
        if (isset($this->collection->getChanges()['name']) && !$this->original['name']) {
            $mailMessage->line('<b>Nome: </b>' . $this->collection->name);
        }

        if (isset($this->collection->getChanges()['name']) && $this->original['name']) {
            $mailMessage->line('<b>Nome: </b>' . $this->collection->name . '<br><small class="text-warning notice"><b>removido: </b>' . $this->original['name'] . '</small>');
        }

        if (!$this->collection->name && $this->original['name']) {
            $mailMessage->line('<span class="text-warning"><b>Nome: </b>' . $this->original['name'] . '</span> <span class="badge badge-pill badge-warning">removido</span>');
        }

        // Razão social
        if (isset($this->collection->getChanges()['corporate_name']) && !$this->original['corporate_name']) {
            $mailMessage->line('<b>Razão social: </b>' . $this->collection->corporate_name);
        }

        if (isset($this->collection->getChanges()['corporate_name']) && $this->original['corporate_name']) {
            $mailMessage->line('<b>Razão social: </b>' . $this->collection->corporate_name . '<br><small class="text-warning notice"><b>removido: </b>' . $this->original['corporate_name'] . '</small>');
        }

        if (!$this->collection->corporate_name && $this->original['corporate_name']) {
            $mailMessage->line('<span class="text-warning"><b>Razão social: </b>' . $this->original['corporate_name'] . '</span> <span class="badge badge-pill badge-warning">removido</span>');
        }

        // e-mail
        if (isset($this->collection->getChanges()['email']) && !$this->original['email']) {
            $mailMessage->line('<b>E-mail: </b>' . $this->collection->email);
        }

        if (isset($this->collection->getChanges()['email']) && $this->original['email']) {
            $mailMessage->line('<b>E-mail:</b> ' . $this->collection->email . '<br><small class="text-warning notice"><b>removido:</b> ' . $this->original['email'] . '</small>');
        }

        if (!$this->collection->email && $this->original['email']) {
            $mailMessage->line('<span class="text-warning"><b>E-mail: </b>' . $this->original['email'] . '</span> <span class="badge badge-pill badge-warning">removido</span>');
        }

        // contato
        if (isset($this->collection->getChanges()['contact']) && !$this->original['contact']) {
            $mailMessage->line('<b>Contato: </b>' . $this->collection->contact);
        }

        if (isset($this->collection->getChanges()['contact']) && $this->original['contact']) {
            $mailMessage->line('<b>Contato: </b>' . $this->collection->contact . '<br><small class="text-warning notice"><b>removido: </b>' . $this->original['contact'] . '</small>');
        }

        if (!$this->collection->contact && $this->original['contact']) {
            $mailMessage->line('<span class="text-warning"><b>Contato: </b>' . $this->original['contact'] . '</span> <span class="badge badge-pill badge-warning">removido</span>');
        }

        // cep
        if (isset($this->collection->getChanges()['postal_code']) && !$this->original['postal_code']) {
            $mailMessage->line('<b>CEP: </b>' . $this->collection->postal_code);
        }

        if (isset($this->collection->getChanges()['postal_code']) && $this->original['postal_code']) {
            $mailMessage->line('<b>CEP: </b>' . $this->collection->postal_code . '<br><small class="text-warning notice"><b>removido: </b>' . $this->original['postal_code'] . '</small>');
        }

        if (!$this->collection->postal_code && $this->original['postal_code']) {
            $mailMessage->line('<span class="text-warning"><b>CEP: </b>' . $this->original['postal_code'] . '</span> <span class="badge badge-pill badge-warning">removido</span>');
        }

        // cep
        if (isset($this->collection->getChanges()['postal_code']) && !$this->original['postal_code']) {
            $mailMessage->line('<b>CEP: </b>' . $this->collection->postal_code);
        }

        if (isset($this->collection->getChanges()['postal_code']) && $this->original['postal_code']) {
            $mailMessage->line('<b>CEP: </b>' . $this->collection->postal_code . '<br><small class="text-warning notice"><b>removido: </b>' . $this->original['postal_code'] . '</small>');
        }

        if (!$this->collection->postal_code && $this->original['postal_code']) {
            $mailMessage->line('<span class="text-warning"><b>CEP: </b>' . $this->original['postal_code'] . '</span> <span class="badge badge-pill badge-warning">removido</span>');
        }

        // endereço
        if (isset($this->collection->getChanges()['address']) && !$this->original['address']) {
            $mailMessage->line('<b>Endereço: </b>' . $this->collection->address);
        }

        if (isset($this->collection->getChanges()['address']) && $this->original['address']) {
            $mailMessage->line('<b>Endereço: </b>' . $this->collection->address . '<br><small class="text-warning notice"><b>removido: </b>' . $this->original['address'] . '</small>');
        }

        if (!$this->collection->address && $this->original['address']) {
            $mailMessage->line('<span class="text-warning"><b>Endereço: </b>' . $this->original['address'] . '</span> <span class="badge badge-pill badge-warning">removido</span>');
        }

        // nº
        if (isset($this->collection->getChanges()['house_number']) && !$this->original['house_number']) {
            $mailMessage->line('<b>nº: </b>' . $this->collection->house_number);
        }

        if (isset($this->collection->getChanges()['house_number']) && $this->original['house_number']) {
            $mailMessage->line('<b>nº: </b>' . $this->collection->house_number . '<br><small class="text-warning notice"><b>removido: </b>' . $this->original['house_number'] . '</small>');
        }

        if (!$this->collection->house_number && $this->original['house_number']) {
            $mailMessage->line('<span class="text-warning"><b>nº: </b>' . $this->original['house_number'] . '</span> <span class="badge badge-pill badge-warning">removido</span>');
        }

        // complemento
        if (isset($this->collection->getChanges()['complement']) && !$this->original['complement']) {
            $mailMessage->line('<b>Complemento: </b>' . $this->collection->complement);
        }

        if (isset($this->collection->getChanges()['complement']) && $this->original['complement']) {
            $mailMessage->line('<b>Complemento: </b>' . $this->collection->complement . '<br><small class="text-warning notice"><b>removido: </b>' . $this->original['complement'] . '</small>');
        }

        if (!$this->collection->complement && $this->original['complement']) {
            $mailMessage->line('<span class="text-warning"><b>Complemento: </b>' . $this->original['complement'] . '</span> <span class="badge badge-pill badge-warning">removido</span>');
        }

        // bairro
        if (isset($this->collection->getChanges()['neighborhood']) && !$this->original['neighborhood']) {
            $mailMessage->line('<b>Bairro: </b>' . $this->collection->neighborhood);
        }

        if (isset($this->collection->getChanges()['neighborhood']) && $this->original['neighborhood']) {
            $mailMessage->line('<b>Bairro: </b>' . $this->collection->neighborhood . '<br><small class="text-warning notice"><b>removido: </b>' . $this->original['neighborhood'] . '</small>');
        }

        if (!$this->collection->neighborhood && $this->original['neighborhood']) {
            $mailMessage->line('<span class="text-warning"><b>Cidade: </b>' . $this->original['neighborhood'] . '</span> <span class="badge badge-pill badge-warning">removido</span>');
        }

        // cidade
        if (isset($this->collection->getChanges()['city']) && !$this->original['city']) {
            $mailMessage->line('<b>Bairro: </b>' . $this->collection->city);
        }

        if (isset($this->collection->getChanges()['city']) && $this->original['city']) {
            $mailMessage->line('<b>Cidade: </b>' . $this->collection->city . '<br><small class="text-warning notice"><b>removido: </b>' . $this->original['city'] . '</small>');
        }

        if (!$this->collection->city && $this->original['city']) {
            $mailMessage->line('<span class="text-warning"><b>Cidade: </b>' . $this->original['city'] . '</span> <span class="badge badge-pill badge-warning">removido</span>');
        }

        // estado
        if (isset($this->collection->getChanges()['state_id']) && !$this->original['state_id']) {
            $mailMessage->line('<b>Estado: </b>' . $this->collection->state_id);
        }

        if (isset($this->collection->getChanges()['state_id']) && $this->original['state_id']) {
            $mailMessage->line('<b>Estado: </b>' . $this->collection->state_id . '<br><small class="text-warning notice"><b>removido: </b>' . State::getState($this->original['state_id'])->name . '</small>');
        }

        if (!$this->collection->state_id && $this->original['state_id']) {
            $mailMessage->line('<span class="text-warning"><b>Estado: </b>' . State::getState($this->original['state_id'])->name . '</span> <span class="badge badge-pill badge-warning">removido</span>');
        }

        // país
        if (isset($this->collection->getChanges()['country']) && !$this->original['country']) {
            $mailMessage->line('<b>País: </b>' . $this->collection->country);
        }

        if (isset($this->collection->getChanges()['country']) && $this->original['country']) {
            $mailMessage->line('<b>País: </b>' . $this->collection->country . '<br><small class="text-warning notice"><b>removido: </b>' . $this->original['country'] . '</small>');
        }

        if (!$this->collection->country && $this->original['country']) {
            $mailMessage->line('<span class="text-warning"><b>País: </b>' . $this->original['country'] . '</span> <span class="badge badge-pill badge-warning">removido</span>');
        }

        // logo
        if (isset($this->collection->getChanges()['logo']) && !$this->original['logo']) {
            $mailMessage->line('<b>Logo: </b><a href="' . url('storage/images/companies/logo/' . $this->collection->logo) . '" class="badge badge-pill badge-info">clique para visualizar</a>');
        }

        if (isset($this->collection->getChanges()['logo']) && $this->original['logo']) {
            $mailMessage->line('<b>Logo: </b><a href="' . url('storage/images/companies/logo/' . $this->collection->logo) . '" class="badge badge-pill badge-info">clique para visualizar</a><br><small class="text-warning notice"><b>removido: </b><span class="badge badge-pill badge-warning">logo anterior deletada</span></small>');
        }

        if (!$this->collection->logo && $this->original['logo']) {
            $mailMessage->line('<span class="text-warning"><b>Logo: </b><span class="badge badge-pill badge-warning">logo anterior removida</span>');
        }

        $mailMessage->action('Acessar sistema', route('login'));
        $mailMessage->line('<span class="notice">Se você desconhece está solicitação de alteração de empresa vinculada ao seu endereço de e-mail, procure o administrador do sistema.</span>');

        return $mailMessage;
    }
}
