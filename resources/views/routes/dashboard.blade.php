@extends('layouts.app')
@section('title', __('Dashboard de grupos e rotas'))

@section('content')

    <div class="bg-dark pb-7 pb-xl-8 pt-6 pt-md-7 pt-xl-8">
        <div class="mb-xl-5">
            @include('routes.groups.dashboard.cards')
        </div>
        <div class="mt-xl--3">
            @include('routes.routes.dashboard.cards')
        </div>
    </div>

@endsection
