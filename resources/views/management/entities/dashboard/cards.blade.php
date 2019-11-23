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
                                <span id="getCountEntities" class="h2 font-weight-bold mb-0">{{ \App\Models\Entity\Entity::getCount() }}</span>
                            </div>
                            <!-- icone -->
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                    <i class="fas fa-hotel"></i>
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

            <!-- com e-mail -->
            <div class="col-xl-3 col-lg-6">
                <!-- card -->
                <div class="card card-stats">
                    <!-- corpo -->
                    <div class="card-body">
                        <div class="row">
                            <!-- título -->
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Com e-mail</h5>
                                <span id="getCountEmailEntities" class="h2 font-weight-bold mb-0">{{ \App\Models\Entity\Entity::getCountEmail() }}</span>
                            </div>
                            <!-- icone -->
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                    <i class="far fa-envelope"></i>
                                </div>
                            </div>
                        </div>
                        <!-- informação -->
                        <p class="mt-3 mb-0 text-muted text-sm">
                            <span class="text-info mr-2">E-mails cadastrados</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- com telefone -->
            <div class="col-xl-3 col-lg-6">
                <!-- card -->
                <div class="card card-stats">
                    <!-- corpo -->
                    <div class="card-body">
                        <div class="row">
                            <!-- título -->
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Com telefone</h5>
                                <span id="getCountContactEntities" class="h2 font-weight-bold mb-0">{{ \App\Models\Entity\Entity::getCountContact() }}</span>
                            </div>
                            <!-- icone -->
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-warning text-white rounded-circle shadow">
                                    <i class="fas fa-phone"></i>
                                </div>
                            </div>
                        </div>
                        <!-- informação -->
                        <p class="mt-3 mb-0 text-muted text-sm">
                            <span class="text-warning mr-2">Telefones cadastrados</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- bloqueadas e suspensas -->
            <div class="col-xl-3 col-lg-6">
                <!-- card -->
                <div class="card card-stats">
                    <!-- corpo -->
                    <div class="card-body">
                        <div class="row">
                            <!-- título -->
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Bloqueadas</h5>
                                <span id="getCountBlockedEntities" class="h2 font-weight-bold mb-0">{{ \App\Models\Entity\Entity::getCountBlocked() }}</span>
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
                            <span class="text-danger mr-2">Bloqueadas e suspensas</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('management.entities.dashboard.ajax')
