@extends('layouts.app')
@section('title', __('Dashboard de inventário'))

@section('content')

    <div class="bg-dark pb-7 pb-xl-8 pt-6 pt-md-7 pt-xl-8">
        <div class="mb-xl-5">
            @include('inventories.inventories.dashboard.cards')
        </div>
        <div class="mt-xl--3">
            @include('inventories.inventory-categories.dashboard.cards')
        </div>
    </div>

@endsection
