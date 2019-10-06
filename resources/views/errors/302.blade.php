@extends('errors::illustrated-layout')

@section('code', '302')
@section('title', __('Page Not Found'))

@section('image')
    <div style="background-image: url({{ asset('img/auth/info-1.png') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection

@section('message', __('Sorry, the page you are looking for could not be found.'))
