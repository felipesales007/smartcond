@extends('layouts.app')
@section('title', __('Dashboard de usuários'))

@section('content')

    @include('users.dashboard.cards')

    @include('users.dashboard.statistics')

@endsection
