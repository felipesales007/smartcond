@extends('errors::illustrated-layout')

@section('code', '429')
@section('title', __('Muitas solicitações'))

@section('image')
    <div style="background-image: url({{ asset('images/error/403.svg') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center"></div>
@endsection

@section('message', __('Você está fazendo muitas solicitações aos nossos servidores.'))
