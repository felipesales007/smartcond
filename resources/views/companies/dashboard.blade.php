@extends('layouts.app')
@section('title', __('Dashboard de empresas'))

@section('content')

    @include('companies.dashboard.cards')

@endsection
