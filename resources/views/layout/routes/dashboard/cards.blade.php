<div class="header">
    <div class="container-fluid">
        <div class="header-body">
            <!-- cards -->
            <div class="row">
                <!-- total -->
                <div class="col-xl-3 col-lg-6">
                    <!-- card -->
                    <div class="card card-stats">
                        <!-- corpo -->
                        <div class="card-body">
                            <div class="row">
                                <!-- título -->
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total</h5>
                                    <span id="getCount" class="h2 font-weight-bold mb-0">{{ \App\Models\Route\Route::getCount() }}</span>
                                </div>
                                <!-- icone -->
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                        <i class="fas fa-route"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- informação -->
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success mr-2">Cadastradas</span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- com get -->
                <div class="col-xl-3 col-lg-6">
                    <!-- card -->
                    <div class="card card-stats">
                        <!-- corpo -->
                        <div class="card-body">
                            <div class="row">
                                <!-- título -->
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">GET</h5>
                                    <span id="getCountGet" class="h2 font-weight-bold mb-0">{{ \App\Models\Route\Route::getCountGet() }}</span>
                                </div>
                                <!-- icone -->
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                        <i class="fas fa-reply"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- informação -->
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-info mr-2">Cadastradas</span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- com post -->
                <div class="col-xl-3 col-lg-6">
                    <!-- card -->
                    <div class="card card-stats">
                        <!-- corpo -->
                        <div class="card-body">
                            <div class="row">
                                <!-- título -->
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">POST</h5>
                                    <span id="getCountPost" class="h2 font-weight-bold mb-0">{{ \App\Models\Route\Route::getCountPost() }}</span>
                                </div>
                                <!-- icone -->
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-warning text-white rounded-circle shadow">
                                        <i class="fas fa-share"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- informação -->
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-warning mr-2">Cadastradas</span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- bloqueadas -->
                <div class="col-xl-3 col-lg-6">
                    <!-- card -->
                    <div class="card card-stats">
                        <!-- corpo -->
                        <div class="card-body">
                            <div class="row">
                                <!-- título -->
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Bloqueadas</h5>
                                    <span id="getCountBlocked" class="h2 font-weight-bold mb-0">{{ \App\Models\Route\Route::getCountBlocked() }}</span>
                                </div>
                                <!-- icone -->
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">
                                        <i class="fas fa-ban"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- informação -->
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-danger mr-2">Bloqueadas</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layout.routes.dashboard.ajax')
