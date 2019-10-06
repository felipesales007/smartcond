# Smartcond

![version](https://img.shields.io/badge/version-3.0.0-blue.svg)

Sistema de gerenciamento de condomínio web desenvolvido no **framework Laravel** por Felipe Sales.

Conheça o framework [Laravel](https://laravel.com) e [Felipe Sales](https://www.felipesales.com.br).

## Versão disponível

![](public/img/readme/version/laravel.png)

## Start project

Recomendações para execução do projeto:

- Na pasta desejada execute no terminal de comando `git clone git@github.com:felipesales007/smartcond.git`.
- Dentro do projeto copie `.env.exemple` e cole na mesma pasta renomeando para `.env` e configure adequadamente.
- Dentro da pasta smartcond execute no terminal de comando `composer update`.
- E em seguida execute o comando `php artisan key:generate` para gerar uma key (chave) do projeto.
- E em seguida execute o comando `php artisan storage:link` para gerar um atalho dos arquivos salvo no projeto na pasta pública.
- E em seguida o comando `php artisan migrate:refresh --seed` para migração do banco MySQL.
- E em seguida o comando `php artisan serve` para inicializar o servidor.
- E por final acesse no navegador desejado o endereço local `http://127.0.0.1:8000` para acesso ao sistema Smartcond.

Requisitos para execução do projeto:

- PHP
- MySQL
- Composer

Em caso de problemas para a execução do projeto execute dentro da pasta smartcond no terminal de comando os seguintes comandos abaixo:

- `php artisan cache:clear`
- `php artisan view:clear`
- `php artisan route:clear`
- `php artisan clear-compiled`
- `composer dump-autoload`

## Documentação
A documentação do Laravel está disponível no [website](https://laravel.com/docs/).

## Suporte nos navegadores

![](public/img/readme/browsers/chrome.png)
![](public/img/readme/browsers/firefox.png)
![](public/img/readme/browsers/edge.png)
![](public/img/readme/browsers/safari.png)
![](public/img/readme/browsers/opera.png)
