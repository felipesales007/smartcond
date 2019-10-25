@extends('errors::illustrated-layout')

@section('code', '405')
@section('title', __('Página não encontrada'))

@section('image')
    <div style="background-image: url({{ asset('images/error/404.svg') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center"></div>
@endsection

@section('message', __('Não foi possível encontrar a página que você estava procurando.'))
