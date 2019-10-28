@extends('layouts.app')
@section('title', __('Dashboard de departamentos'))

@section('content')

    <!-- breadcrumbs e cards -->
    @component('layouts.headers.background')
        @component('layouts.headers.breadcrumbs')
            @slot('title')
                {{ __('Departamentos') }}
            @endslot

            <li class="breadcrumb-item fe-mouse-default active" aria-current="page">@yield('title')</li>
        @endcomponent

        @include('departments.dashboard.cards')
    @endcomponent

@endsection
