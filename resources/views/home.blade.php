@extends('layouts.app', ['sidebarMenu' => '1', 'sidebarItem' => '1'])
@section('title', \App\Models\Menu\MenuItem::getMenuItem(1)['name'])

@section('content')

    <!-- breadcrumbs -->
    @component('layouts.components.breadcrumbs')
        @slot('title'){{ 1 }}@endslot
    @endcomponent

    <!-- corpo -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

            </div>
        </div>
    </div>

@endsection
