<div id="modal-block-group" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-block-group-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- título -->
            <div class="modal-header">
                <h5 id="modal-block-group-label" class="modal-title text-uppercase text-monospace ml-1">
                    <b>{{ __('Bloquear grupo') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- form -->
                <form id="form-block-group" role="form" autocomplete="off" novalidate>
                    @csrf
                    <!-- inputs -->
                    <div class="row">
                        <!-- id -->
                        <div hidden class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="id-block-group">{{ __('ID') }}</label>
                                <div class="input-group input-group-merge validate-id-block-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_block_group') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id do grupo') }}">*</span>
                                    <input readonly type="number" id="id-block-group" name="id_block_group" class="form-control {{ $errors->has('id_block_group') ? 'is-invalid' : '' }}" placeholder="{{ __('ID do grupo') }}" value="{{ old('id_block_group') }}" maxlength="20" required onkeypress="return soNumeros(event);" @if ($errors->has('id_block_group')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_block_group'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_block_group') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- bloquear -->
                        <div class="col-lg-12">
                            <div class="form-group mt--1 mb-0">
                                <label class="form-control-label fe-toggle-title" for="blocked-block-group">Bloqueado </label>
                                <div class="input-group input-group-merge fe-toggle-line validate-blocked-block-group">
                                    <label class="custom-toggle custom-toggle-warning">
                                        <input type="checkbox" id="blocked-block-group" name="blocked_block_group" onchange="changeCheckbox(this, 'grupo')">
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="Não" data-label-on="Sim"></span>
                                    </label>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('blocked_block_group'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('blocked_block_group') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- informação -->
                    <div class="fe-mouse-off">
                        <div class="mt--1">
                            <small class="text-light">{{ __('ao bloquear o grupo nenhum usuário poderá acessar as rotas vinculadas ao grupo') }}</small>
                        </div>
                    </div>
                    <!-- botões -->
                    <div class="text-right float-right fe-form-footer">
                        <a href="javascript:void(0)" class="mr-4" data-dismiss="modal">{{ __('Cancelar') }}</a>
                        @if (app('router')->has('group.block') && \App\Models\Permission::routePermission('group.block'))
                            <button type="submit" id="btn-block-group" class="btn btn-outline-warning mr-4">{{ __('Bloquear grupo') }}</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
