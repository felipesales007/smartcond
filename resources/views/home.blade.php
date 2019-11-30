@extends('layouts.app', ['sidebarMenu' => $page['menu'], 'sidebarItem' => $page['item']])
@section('title', $page['item_name'])

@section('content')

    <!-- breadcrumbs -->
    @component('layouts.components.breadcrumbs')
        @slot('title'){{ $page['menu_name'] }}@endslot
    @endcomponent

    <!-- corpo -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

            </div>
        </div>
    </div>

@endsection
