<!-- cards do dashboard -->
<div class="container-fluid">
    <div class="header-body">
        <!-- cards -->
        <div class="row">
            <!-- total de administradores -->
            <div class="col-xl-3 col-lg-6">
                <!-- card -->
                <div class="card card-stats mb-4 mb-xl-0">
                    <!-- corpo -->
                    <div class="card-body">
                        <div class="row">
                            <!-- título -->
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total de administradores</h5>
                                <span id="getCountAdmins" class="h2 font-weight-bold mb-0">{{ \App\Models\Admin::getCount() }}</span>
                            </div>
                            <!-- icone -->
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                    <i class="fas fa-users"></i>
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

            <!-- administradores confirmados -->
            <div class="col-xl-3 col-lg-6">
                <!-- card -->
                <div class="card card-stats mb-4 mb-xl-0">
                    <!-- corpo -->
                    <div class="card-body">
                        <div class="row">
                            <!-- título -->
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Administradores confirmados</h5>
                                <span id="getCountConfirmationAdmins" class="h2 font-weight-bold mb-0">{{ \App\Models\Admin::getCountConfirmation() }}</span>
                            </div>
                            <!-- icone -->
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                    <i class="far fa-envelope-open"></i>
                                </div>
                            </div>
                        </div>
                        <!-- informação -->
                        <p class="mt-3 mb-0 text-muted text-sm">
                            <span class="text-info mr-2">E-mails confirmados</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- administradores pendentes -->
            <div class="col-xl-3 col-lg-6">
                <!-- card -->
                <div class="card card-stats mb-4 mb-xl-0">
                    <!-- corpo -->
                    <div class="card-body">
                        <div class="row">
                            <!-- título -->
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Administradores pendentes</h5>
                                <span id="getCountNotConfirmationAdmins" class="h2 font-weight-bold mb-0">{{ \App\Models\Admin::getCountNotConfirmation() }}</span>
                            </div>
                            <!-- icone -->
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-warning text-white rounded-circle shadow">
                                    <i class="far fa-envelope"></i>
                                </div>
                            </div>
                        </div>
                        <!-- informação -->
                        <p class="mt-3 mb-0 text-muted text-sm">
                            <span class="text-warning mr-2">Faltam confirmar e-mail</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- administradores bloqueados e suspensos -->
            <div class="col-xl-3 col-lg-6">
                <!-- card -->
                <div class="card card-stats mb-4 mb-xl-0">
                    <!-- corpo -->
                    <div class="card-body">
                        <div class="row">
                            <!-- título -->
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Administradores bloqueados</h5>
                                <span id="getCountBlockedAdmins" class="h2 font-weight-bold mb-0">{{ \App\Models\Admin::getCountBlocked() }}</span>
                            </div>
                            <!-- icone -->
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">
                                    <i class="fas fa-user-times"></i>
                                </div>
                            </div>
                        </div>
                        <!-- informação -->
                        <p class="mt-3 mb-0 text-muted text-sm">
                            <span class="text-danger mr-2">Bloqueados e suspensos</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admins.includes.charts')
