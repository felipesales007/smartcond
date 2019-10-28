@extends('layouts.app')
@section('title', __('Home'))

@section('content')

    <!-- breadcrumbs -->
    @component('layouts.headers.background')
        @component('layouts.headers.breadcrumbs')
            @slot('title')
                {{ __('Home') }}
            @endslot
        @endcomponent
    @endcomponent

    <!-- corpo -->
    <div class="container-fluid mt--8">
        <div class="row">
            <!-- calendário -->
            <div class="col-lg-6">
                <!-- card -->
                <div class="card card-calendar">
                    <div class="card-header">
                        <!-- título -->
                        <div class="fullcalendar-title text-uppercase text-monospace h3 mb--4 fe-calendar-title-fix">
                            <b>{{ __('Calendário') }}</b>
                        </div>
                        <!-- botões -->
                        <div class="float-right">
                            <a href="javascript:void(0)" class="fullcalendar-btn-prev btn btn-sm btn-outline-primary">
                                <i class="fas fa-angle-left"></i>
                            </a>
                            <a href="javascript:void(0)" class="fullcalendar-btn-next btn btn-sm btn-outline-primary">
                                <i class="fas fa-angle-right"></i>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-primary active" data-calendar-view="month">{{ __('Mês') }}</a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-primary" data-calendar-view="basicWeek">{{ __('Semana') }}</a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-primary" data-calendar-view="basicDay">{{ __('Dia') }}</a>
                        </div>
                    </div>
                    <!-- datas -->
                    <div class="card-body p-0">
                        <div id="calendar" class="calendar" data-toggle="calendar"></div>
                    </div>
                </div>
            </div>

            <!-- informações -->
            <div class="col-lg-6">
                <!-- card -->
                <div class="card">
                    <div class="card-header">
                        <!-- título -->
                        <div class="text-uppercase text-monospace h3 mb-1 fe-informative-title-fix">
                            <b>{{ __('Informativo') }}</b>
                        </div>
                    </div>
                    <!-- lista -->
                    <div class="card-body p-0">
                        <div class="accordion" id="accordionExample">
                            <div class="mb-0">
                                <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    <h5 class="mb-0">Collapsible Group Item #1</h5>
                                </div>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>Um momento especial de renovação para sua alma e seu espírito, porque Deus, na sua infinita sabedoria, deu à natureza a capacidade de desabrochar a cada nova estação e a nós capacidade de recomeçar a cada ano.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-0">
                                <div class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <h5 class="mb-0">Collapsible Group Item #2</h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>Um momento especial de renovação para sua alma e seu espírito, porque Deus, na sua infinita sabedoria, deu à natureza a capacidade de desabrochar a cada nova estação e a nós capacidade de recomeçar a cada ano.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-0">
                                <div class="card-header" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <h5 class="mb-0">Collapsible Group Item #3</h5>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>Um momento especial de renovação para sua alma e seu espírito, porque Deus, na sua infinita sabedoria, deu à natureza a capacidade de desabrochar a cada nova estação e a nós capacidade de recomeçar a cada ano.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
