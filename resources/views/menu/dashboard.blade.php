@extends('layouts.app')
@section('title', __('Dashboard de menu e itens do menu'))

@section('content')

    <div class="bg-gradient-primary pb-7 pb-xl-8 pt-6 pt-md-7 pt-xl-8">
        <div class="mb-xl-5">
            @include('menu.menu.dashboard.cards')
        </div>
        <div class="mt-xl--3">
            @include('menu.menu-item.dashboard.cards')
        </div>
    </div>

@endsection
