@extends('errors::illustrated-layout')

@section('code', '500')
@section('title', __('Erro'))

@section('image')
    <div style="background-image: url({{ asset('images/error/500.svg') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center"></div>
@endsection

@section('message', __('Ops, algo deu errado em nossos servidores.'))
