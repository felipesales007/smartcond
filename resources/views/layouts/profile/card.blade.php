<!-- perfil -->
<div class="col-xl-4 order-xl-2 mb-2 mb-xl-0 d-none d-xl-block">
    <!-- card -->
    <div class="card">
        <!-- imagem -->
        <div class="row justify-content-center">
            <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                    <img src="{{ auth()->user()['photo'] ? url('storage/img/users/photo/' . auth()->user()['photo']) : url('img/default/default-user.png') }}" class="rounded-circle shadow" alt="">
                </div>
            </div>
        </div>
        <!-- corpo -->
        <div class="card-body mt-4 mb--5">
            <div class="row">
                <div class="col">
                    <span class="badge badge-dot float-right mt--5 mr--3"><i class="bg-success" data-toggle="tooltip" data-placement="top" title="perfil atualizado em {{ \App\Helpers\FormatHelpers::datetime_to_date_br(auth()->user()['last_update_at']) }}"></i></span>
                    <div class="card-profile-stats d-flex justify-content-center">
                        <div class="text-center">
                            <!-- nome e idade -->
                            <h3>{{ \App\Helpers\FormatHelpers::two_word(auth()->user()['name']) }}@if (auth()->user()['birthday'])<span class="font-weight-light">, {{ now()::parse(auth()->user()['birthday'])->diff(now())->format('%y') }}</span> @endif</h3>
                            <!-- local -->
                            <div class="h5 font-weight-300">{{ auth()->user()['city'] }}@if (auth()->user()['city'] && auth()->user()['state_id']), @endif @if (auth()->user()['state_id']){{ auth()->user()->getState['uf'] }} @endif</div>
                            <!-- formação -->
                            <div class="h5 mt-4">{{ auth()->user()['course'] }}@if (auth()->user()['course'] && auth()->user()['college']), @endif {{ auth()->user()['college'] }}</div>
                            <!-- profissão -->
                            <div>{{ auth()->user()['profession'] }}@if (auth()->user()['profession'] && auth()->user()['company']), @endif {{ auth()->user()['company'] }}</div>
                            @if (auth()->user()['description']) <hr class="my-4"> @endif
                            <!-- descrição -->
                            <p>{{ auth()->user()['description'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
