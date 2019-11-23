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
                                <span id="getCountUsers" class="h2 font-weight-bold mb-0">{{ \App\Models\User\User::getCount() }}</span>
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

            <!-- confirmados -->
            <div class="col-xl-3 col-lg-6">
                <!-- card -->
                <div class="card card-stats">
                    <!-- corpo -->
                    <div class="card-body">
                        <div class="row">
                            <!-- título -->
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Confirmados</h5>
                                <span id="getCountConfirmationUsers" class="h2 font-weight-bold mb-0">{{ \App\Models\User\User::getCountConfirmation() }}</span>
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

            <!-- pendentes -->
            <div class="col-xl-3 col-lg-6">
                <!-- card -->
                <div class="card card-stats">
                    <!-- corpo -->
                    <div class="card-body">
                        <div class="row">
                            <!-- título -->
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Pendentes</h5>
                                <span id="getCountNotConfirmationUsers" class="h2 font-weight-bold mb-0">{{ \App\Models\User\User::getCountNotConfirmation() }}</span>
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

            <!-- bloqueados e suspensos -->
            <div class="col-xl-3 col-lg-6">
                <!-- card -->
                <div class="card card-stats">
                    <!-- corpo -->
                    <div class="card-body">
                        <div class="row">
                            <!-- título -->
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Bloqueados</h5>
                                <span id="getCountBlockedUsers" class="h2 font-weight-bold mb-0">{{ \App\Models\User\User::getCountBlocked() }}</span>
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

@include('management.users.dashboard.ajax')
