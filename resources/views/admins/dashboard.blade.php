@extends('layouts.app')
@section('title', __('Dashboard de administradores'))

@section('content')

    @include('admins.dashboard.cards')

    @include('admins.dashboard.statistics')

@endsection
