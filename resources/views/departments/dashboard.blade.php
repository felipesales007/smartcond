@extends('layouts.app')
@section('title', __('Dashboard de departamentos'))

@section('content')

    @include('departments.dashboard.cards')

@endsection
