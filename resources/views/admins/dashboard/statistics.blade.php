<div class="container-fluid mt--7 fe-statistics">
    <!-- gráficos -->
    <div class="row">
        <!-- gráfico em linha -->
        <div class="col-xl-12 mb-2 mb-xl-0">
            <!-- corpo -->
            <div class="card">
                <!-- título -->
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb--1">Visão evolutiva dos administradores</h6>
                        </div>
                    </div>
                </div>
                <!-- dados -->
                <div class="card-body">
                    <div class="chart">
                        <canvas id="admins-evolutionary"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- gráfico circular -->
        <div class="col-xl-6 mb-2 mb-xl-0">
            <!-- corpo -->
            <div class="card">
                <!-- título -->
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb--1">Visão global dos administradores por status</h6>
                        </div>
                    </div>
                </div>
                <!-- dados -->
                <div class="card-body">
                    <div class="chart">
                        <canvas id="admins-status"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- gráfico circular -->
        <div class="col-xl-6 mb-2 mb-xl-0">
            <!-- corpo -->
            <div class="card">
                <!-- título -->
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb--1">Visão global dos administradores por gêneros</h6>
                        </div>
                    </div>
                </div>
                <!-- dados -->
                <div class="card-body">
                    <div class="chart">
                        <canvas id="admins-genders"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
