<?php

namespace App\Notifications\Admin;

use App\Helpers\FormatHelpers;
use App\Models\Gender;
use App\Models\State;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EditAdmin extends Notification
{
    use Queueable;

    private $token;
    private $collection;
    private $original;
    private $company;

    /**
     * Construtor EditUser.
     *
     * @param $token
     * @param $collection
     * @param $original
     * @param $company
     */
    public function __construct($token, $collection, $original, $company)
    {
        $collection->gender_id = $collection->gender_id ? $collection->getGender->name : null;
        $collection->state_id  = $collection->state_id ? $collection->getState->name : null;

        $this->token      = $token;
        $this->collection = $collection;
        $this->original   = $original;
        $this->company    = $company;
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

        $mailMessage->subject('Notificação de alteração de usuário administrador');
        $mailMessage->greeting('Olá ' . FormatHelpers::first_word($this->collection->name) . ',');
        $mailMessage->line('Você está recebendo este e-mail porque foi realizado uma alteração de usuário administrador na sua conta no sistema ' . config('app.name') . ', segue abaixo as alterações realizadas:');

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

        // cpf
        if (isset($this->collection->getChanges()['cpf']) && !$this->original['cpf']) {
            $mailMessage->line('<b>CPF: </b>' . $this->collection->cpf);
        }

        if (isset($this->collection->getChanges()['cpf']) && $this->original['cpf']) {
            $mailMessage->line('<b>CPF: </b>' . $this->collection->cpf . '<br><small class="text-warning notice"><b>removido: </b>' . $this->original['cpf'] . '</small>');
        }

        if (!$this->collection->cpf && $this->original['cpf']) {
            $mailMessage->line('<span class="text-warning"><b>CPF: </b>' . $this->original['cpf'] . '</span> <span class="badge badge-pill badge-warning">removido</span>');
        }

        // rg
        if (isset($this->collection->getChanges()['rg']) && !$this->original['rg']) {
            $mailMessage->line('<b>RG: </b>' . $this->collection->rg);
        }

        if (isset($this->collection->getChanges()['rg']) && $this->original['rg']) {
            $mailMessage->line('<b>RG: </b>' . $this->collection->rg . '<br><small class="text-warning notice"><b>removido: </b>' . $this->original['rg'] . '</small>');
        }

        if (!$this->collection->rg && $this->original['rg']) {
            $mailMessage->line('<span class="text-warning"><b>RG: </b>' . $this->original['rg'] . '</span> <span class="badge badge-pill badge-warning">removido</span>');
        }

        // e-mail
        if (isset($this->collection->getChanges()['email']) && !$this->original['email']) {
            $mailMessage->line('<b>E-mail: </b>' . $this->collection->email);
        }

        if (isset($this->collection->getChanges()['email']) && $this->original['email']) {
            $mailMessage->line('<b>E-mail:</b> ' . $this->collection->email . '<br><small class="text-warning notice"><b>removido:</b> ' . $this->original['email'] . '</small><br><small class="text-danger">Nota: com esta alteração será necessário uma nova confirmação de e-mail no novo endereço de e-mail para acesso ao sistema.</small>');
        }

        if (!$this->collection->email && $this->original['email']) {
            $mailMessage->line('<span class="text-warning"><b>E-mail: </b>' . $this->original['email'] . '</span> <span class="badge badge-pill badge-warning">removido</span>');
        }

        // senha
        if (isset($this->collection->getChanges()['password']) && !isset($this->collection->getChanges()['email']) && $this->token) {
            $mailMessage->line('<b>Senha: </b><span class="badge badge-pill badge-warning">criptografada</span>');
        }

        if (isset($this->collection->getChanges()['password']) && isset($this->collection->getChanges()['email']) && $this->token) {
            $mailMessage->line('<b>Senha: </b><span class="badge badge-pill badge-warning">criptografada</span>');
        }

        if (isset($this->collection->getChanges()['password']) && isset($this->collection->getChanges()['email']) && !$this->token) {
            $mailMessage->line('<b>Senha: </b><span class="badge badge-pill badge-warning">criptografada</span><br><small class="text-danger">Nota: se necessário realizar a recuperação de senha, o mesmo deverá ser feito no novo endereço de e-mail cadastrado.</small>');
        }

        // aniversário
        if (isset($this->collection->getChanges()['birthday']) && !$this->original['birthday']) {
            $mailMessage->line('<b>Aniversário: </b>' . FormatHelpers::date_to_date_br($this->collection->birthday));
        }

        if (isset($this->collection->getChanges()['birthday']) && $this->original['birthday']) {
            $mailMessage->line('<b>Aniversário: </b>' . FormatHelpers::date_to_date_br($this->collection->birthday) . '<br><small class="text-warning notice"><b>removido: </b>' . FormatHelpers::date_to_date_br($this->original['birthday']) . '</small>');
        }

        if (!$this->collection->birthday && $this->original['birthday']) {
            $mailMessage->line('<span class="text-warning"><b>Aniversário: </b>' . FormatHelpers::date_to_date_br($this->original['birthday']) . '</span> <span class="badge badge-pill badge-warning">removido</span>');
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

        // sexo
        if (isset($this->collection->getChanges()['gender_id']) && !$this->original['gender_id']) {
            $mailMessage->line('<b>Sexo: </b>' . $this->collection->gender_id);
        }

        if (isset($this->collection->getChanges()['gender_id']) && $this->original['gender_id']) {
            $mailMessage->line('<b>Sexo: </b>' . $this->collection->gender_id . '<br><small class="text-warning notice"><b>removido: </b>' . Gender::getGender($this->original['gender_id'])->name . '</small>');
        }

        if (!$this->collection->gender_id && $this->original['gender_id']) {
            $mailMessage->line('<span class="text-warning"><b>Sexo: </b>' . Gender::getGender($this->original['gender_id'])->name . '</span> <span class="badge badge-pill badge-warning">removido</span>');
        }

        // curso
        if (isset($this->collection->getChanges()['course']) && !$this->original['course']) {
            $mailMessage->line('<b>Curso: </b>' . $this->collection->course);
        }

        if (isset($this->collection->getChanges()['course']) && $this->original['course']) {
            $mailMessage->line('<b>Curso: </b>' . $this->collection->course . '<br><small class="text-warning notice"><b>removido: </b>' . $this->original['course'] . '</small>');
        }

        if (!$this->collection->course && $this->original['course']) {
            $mailMessage->line('<span class="text-warning"><b>Curso: </b>' . $this->original['course'] . '</span> <span class="badge badge-pill badge-warning">removido</span>');
        }

        // faculdade
        if (isset($this->collection->getChanges()['college']) && !$this->original['college']) {
            $mailMessage->line('<b>Faculdade: </b>' . $this->collection->college);
        }

        if (isset($this->collection->getChanges()['college']) && $this->original['college']) {
            $mailMessage->line('<b>Faculdade: </b>' . $this->collection->college . '<br><small class="text-warning notice"><b>removido: </b>' . $this->original['college'] . '</small>');
        }

        if (!$this->collection->college && $this->original['college']) {
            $mailMessage->line('<span class="text-warning"><b>Faculdade: </b>' . $this->original['college'] . '</span> <span class="badge badge-pill badge-warning">removido</span>');
        }

        // profissão
        if (isset($this->collection->getChanges()['profession']) && !$this->original['profession']) {
            $mailMessage->line('<b>Profissão: </b>' . $this->collection->profession);
        }

        if (isset($this->collection->getChanges()['profession']) && $this->original['profession']) {
            $mailMessage->line('<b>Profissão: </b>' . $this->collection->profession . '<br><small class="text-warning notice"><b>removido: </b>' . $this->original['profession'] . '</small>');
        }

        if (!$this->collection->profession && $this->original['profession']) {
            $mailMessage->line('<span class="text-warning"><b>Profissão: </b>' . $this->original['profession'] . '</span> <span class="badge badge-pill badge-warning">removido</span>');
        }

        // empresa
        if (isset($this->collection->getChanges()['company']) && !$this->original['company']) {
            $mailMessage->line('<b>Empresa: </b>' . $this->collection->company);
        }

        if (isset($this->collection->getChanges()['company']) && $this->original['company']) {
            $mailMessage->line('<b>Empresa: </b>' . $this->collection->company . '<br><small class="text-warning notice"><b>removido: </b>' . $this->original['company'] . '</small>');
        }

        if (!$this->collection->company && $this->original['company']) {
            $mailMessage->line('<span class="text-warning"><b>Empresa: </b>' . $this->original['company'] . '</span> <span class="badge badge-pill badge-warning">removido</span>');
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

        // foto
        if (isset($this->collection->getChanges()['photo']) && !$this->original['photo']) {
            $mailMessage->line('<b>Foto: </b><a href="' . url('storage/images/users/photo/' . $this->collection->photo) . '" class="badge badge-pill badge-info">clique para visualizar</a>');
        }

        if (isset($this->collection->getChanges()['photo']) && $this->original['photo']) {
            $mailMessage->line('<b>Foto: </b><a href="' . url('storage/images/users/photo/' . $this->collection->photo) . '" class="badge badge-pill badge-info">clique para visualizar</a><br><small class="text-warning notice"><b>removido: </b><span class="badge badge-pill badge-warning">foto anterior deletada</span></small>');
        }

        if (!$this->collection->photo && $this->original['photo']) {
            $mailMessage->line('<span class="text-warning"><b>Foto: </b><span class="badge badge-pill badge-warning">foto anterior removida</span>');
        }

        // capa
        if (isset($this->collection->getChanges()['background']) && !$this->original['background']) {
            $mailMessage->line('<b>Capa: </b><a href="' . url('storage/images/users/background/' . $this->collection->background) . '" class="badge badge-pill badge-info">clique para visualizar</a>');
        }

        if (isset($this->collection->getChanges()['background']) && $this->original['background']) {
            $mailMessage->line('<b>Capa: </b><a href="' . url('storage/images/users/background/' . $this->collection->background) . '" class="badge badge-pill badge-info">clique para visualizar</a><br><small class="text-warning notice"><b>removido: </b><span class="badge badge-pill badge-warning">capa anterior deletada</span></small>');
        }

        if (!$this->collection->background && $this->original['background']) {
            $mailMessage->line('<span class="text-warning"><b>Capa: </b><span class="badge badge-pill badge-warning">capa anterior removida</span>');
        }

        // descrição
        if (isset($this->collection->getChanges()['description']) && !$this->original['description']) {
            $mailMessage->line('<b>Descrição: </b>' . $this->collection->description);
        }

        if (isset($this->collection->getChanges()['description']) && $this->original['description']) {
            $mailMessage->line('<b>Descrição: </b>' . $this->collection->description . '<br><small class="text-warning notice"><b>removido: </b>' . $this->original['description'] . '</small>');
        }

        if (!$this->collection->description && $this->original['description']) {
            $mailMessage->line('<span class="text-warning"><b>Descrição: </b>' . $this->original['description'] . '</span> <span class="badge badge-pill badge-warning">removido</span>');
        }

        // empresa
        if ($this->company) {
            $mailMessage->line('<b>Acesso a empresa: </b>' . $this->company);
        }

        if (isset($this->collection->getChanges()['password']) && $this->token) {
            $mailMessage->action('Recuperar senha', route('password.reset', $this->token));
        } else {
            $mailMessage->action('Acessar sistema', route('login'));
        }

        $mailMessage->line('<span class="notice">Se você desconhece está solicitação de alteração de usuário administrador, procure o administrador do sistema.</span>');

        return $mailMessage;
    }
}
