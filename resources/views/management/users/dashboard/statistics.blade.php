<div class="container-fluid fe-statistics">
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
                            <h6 class="text-uppercase text-muted ls-1 mb--1">Visão evolutiva dos usuários</h6>
                        </div>
                    </div>
                </div>
                <!-- dados -->
                <div class="card-body">
                    <div class="chart">
                        <canvas id="users-evolutionary"></canvas>
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
                            <h6 class="text-uppercase text-muted ls-1 mb--1">Visão global dos usuários por status</h6>
                        </div>
                    </div>
                </div>
                <!-- dados -->
                <div class="card-body">
                    <div class="chart">
                        <canvas id="users-status"></canvas>
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
                            <h6 class="text-uppercase text-muted ls-1 mb--1">Visão global dos usuários por gêneros</h6>
                        </div>
                    </div>
                </div>
                <!-- dados -->
                <div class="card-body">
                    <div class="chart">
                        <canvas id="users-genders"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
