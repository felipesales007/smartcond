<div class="header">
    <div class="container-fluid">
        <div class="header-body">
            <!-- cards -->
            <div class="row">
                <!-- total -->
                <div class="col-xl-6 col-lg-6">
                    <!-- card -->
                    <div class="card card-stats">
                        <!-- corpo -->
                        <div class="card-body">
                            <div class="row">
                                <!-- título -->
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total</h5>
                                    <span id="getCount" class="h2 font-weight-bold mb-0">{{ \App\Models\Menu\MenuItem::getCount() }}</span>
                                </div>
                                <!-- icone -->
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                        <i class="fas fa-genderless"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- informação -->
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success mr-2">Cadastrados</span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- bloqueados -->
                <div class="col-xl-6 col-lg-6">
                    <!-- card -->
                    <div class="card card-stats">
                        <!-- corpo -->
                        <div class="card-body">
                            <div class="row">
                                <!-- título -->
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Bloqueados</h5>
                                    <span id="getCountBlocked" class="h2 font-weight-bold mb-0">{{ \App\Models\Menu\MenuItem::getCountBlocked() }}</span>
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
                                <span class="text-danger mr-2">Bloqueados</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layout.menu-items.dashboard.ajax')
