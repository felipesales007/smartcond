@extends('layouts.app')
@section('title', __('Home'))

@section('content')

    <!-- fundo -->
    <div class="bg-gradient-primary pb-7 pb-xl-7 pt-7 pt-md-7 pt-xl-7"></div>

    <!-- corpo -->
    <div class="container-fluid mt--7">
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
                        <div class="calendar" data-toggle="calendar" id="calendar"></div>
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
                                        <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-0">
                                <div class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <h5 class="mb-0">Collapsible Group Item #2</h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-0">
                                <div class="card-header" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <h5 class="mb-0">Collapsible Group Item #3</h5>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- slide -->
            <div class="col-lg-12">
                <div id="carouselExampleIndicators" class="carousel slide mb-4" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1" class=""></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2" class=""></li>
                    </ol>
                    <div class="carousel-inner fe-radius">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{ url('template/img/theme/img-1-1200x1000.jpg') }}" alt="" height="200px">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ url('template/img/theme/img-2-1200x1000.jpg') }}" alt="" height="200px">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ url('template/img/theme/img-1-1200x1000.jpg') }}" alt="" height="200px">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Voltar</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Próximo</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
