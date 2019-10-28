<!-- cards do dashboard -->
<div class="container-fluid">
    <div class="header-body">
        <!-- cards -->
        <div class="row">
            <!-- total -->
            <div class="col-xl-3 col-lg-6">
                <!-- card -->
                <div class="card card-stats mb-4 mb-xl-0">
                    <!-- corpo -->
                    <div class="card-body">
                        <div class="row">
                            <!-- título -->
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total de empresas</h5>
                                <span id="getCountCompanies" class="h2 font-weight-bold mb-0">{{ \App\Models\Company\Company::getCount() }}</span>
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
                <div class="card card-stats mb-4 mb-xl-0">
                    <!-- corpo -->
                    <div class="card-body">
                        <div class="row">
                            <!-- título -->
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Empresas com e-mail</h5>
                                <span id="getCountEmailCompanies" class="h2 font-weight-bold mb-0">{{ \App\Models\Company\Company::getCountEmail() }}</span>
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

            <!-- com contato -->
            <div class="col-xl-3 col-lg-6">
                <!-- card -->
                <div class="card card-stats mb-4 mb-xl-0">
                    <!-- corpo -->
                    <div class="card-body">
                        <div class="row">
                            <!-- título -->
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Empresas com contato</h5>
                                <span id="getCountContactCompanies" class="h2 font-weight-bold mb-0">{{ \App\Models\Company\Company::getCountContact() }}</span>
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
                            <span class="text-warning mr-2">Contatos cadastrados</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- bloqueadas e suspensas -->
            <div class="col-xl-3 col-lg-6">
                <!-- card -->
                <div class="card card-stats mb-4 mb-xl-0">
                    <!-- corpo -->
                    <div class="card-body">
                        <div class="row">
                            <!-- título -->
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Empresas bloqueadas</h5>
                                <span id="getCountBlockedCompanies" class="h2 font-weight-bold mb-0">{{ \App\Models\Company\Company::getCountBlocked() }}</span>
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

@include('companies.includes.charts')
