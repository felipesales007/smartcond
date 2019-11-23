<div class="header">
    <div class="container-fluid">
        <div class="header-body">
            <!-- cards -->
            <div class="row">
                <!-- total -->
                <div hidden class="col-xl-3 col-lg-6">
                    <!-- card -->
                    <div class="card card-stats">
                        <!-- corpo -->
                        <div class="card-body">
                            <div class="row">
                                <!-- título -->
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total</h5>
                                    <span id="getCount" class="h2 font-weight-bold mb-0">{{ \App\Models\Menu\Menu::getCount() }}</span>
                                </div>
                                <!-- icone -->
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                        <i class="fas fa-list-ul"></i>
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

                <!-- collapse -->
                <div class="col-xl-3 col-lg-6">
                    <!-- card -->
                    <div class="card card-stats">
                        <!-- corpo -->
                        <div class="card-body">
                            <div class="row">
                                <!-- título -->
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Collapse</h5>
                                    <span id="getCountCollapses" class="h2 font-weight-bold mb-0">{{ \App\Models\Menu\Menu::getCountCollapses() }}</span>
                                </div>
                                <!-- icone -->
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-purple text-white rounded-circle shadow">
                                        <i class="fas fa-indent"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- informação -->
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-purple mr-2">Cadastrados</span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- dropdown -->
                <div class="col-xl-3 col-lg-6">
                    <!-- card -->
                    <div class="card card-stats">
                        <!-- corpo -->
                        <div class="card-body">
                            <div class="row">
                                <!-- título -->
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Dropdown</h5>
                                    <span id="getCountDropdowns" class="h2 font-weight-bold mb-0">{{ \App\Models\Menu\Menu::getCountDropdowns() }}</span>
                                </div>
                                <!-- icone -->
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                        <i class="fas fa-comment-alt fa-rotate-180"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- informação -->
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-info mr-2">Cadastrados</span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- link -->
                <div class="col-xl-3 col-lg-6">
                    <!-- card -->
                    <div class="card card-stats">
                        <!-- corpo -->
                        <div class="card-body">
                            <div class="row">
                                <!-- título -->
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Links</h5>
                                    <span id="getCountLinks" class="h2 font-weight-bold mb-0">{{ \App\Models\Menu\Menu::getCountLinks() }}</span>
                                </div>
                                <!-- icone -->
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-blue text-white rounded-circle shadow">
                                        <i class="fas fa-link"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- informação -->
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-blue mr-2">Cadastrados</span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- bloqueados -->
                <div class="col-xl-3 col-lg-6">
                    <!-- card -->
                    <div class="card card-stats">
                        <!-- corpo -->
                        <div class="card-body">
                            <div class="row">
                                <!-- título -->
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Bloqueados</h5>
                                    <span id="getCountBlocked" class="h2 font-weight-bold mb-0">{{ \App\Models\Menu\Menu::getCountBlocked() }}</span>
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

@include('layout.menu.dashboard.ajax')
