<div id="modal-view-route" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-view-route-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content bg-dark">
            <!-- título e capa -->
            <div class="modal-header">
                <h5 id="modal-view-route-label" class="modal-title text-uppercase text-monospace text-white ml-1">
                    <b>{{ __('Visualizar rota') }}</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- corpo -->
            <div class="modal-body">
                <!-- dados -->
                <div class="row fe-mouse opacity-7">
                    <div class="col-lg-12">
                        <!-- copiar e informações -->
                        <div class="mt--3 mb-4">
                            <!-- página e copiar -->
                            <div class="d-inline-flex text-secondary">
                                <div id="view-view-route"></div>
                                <i onclick="copyToClipboard('#copy-route-view-route'); animateItem(this, 'faa-burst');"  class="far fa-copy fe-pointer mt-1" data-toggle="tooltip" data-placement="top" title="clique para copiar"></i>
                            </div>
                            <!-- status -->
                            <small id="status-view-route" class="float-right d-none"></small>
                        </div>
                        <!-- copia -->
                        <label hidden for="copy-route-view-route"></label>
                        <textarea hidden id="copy-route-view-route" class="form-control" rows="4" resize="none"></textarea>
                        <!-- rota -->
                        <div class="small">
                            <div>
                                <span class="text-teal">Route</span><span class="text-white"><span class="ml-1 mr-1">:</span><span class="mr-1">:</span></span><span class="text-orange">group</span><span class="text-white"><span class="mr-1">(</span><span class="mr-1">[</span></span><span class="text-green">'prefix'</span><span class="text-white"> => </span><span id="group-view-route" class="text-green"></span><span class="text-white ml-1">], </span><span class="text-purple">function</span><span class="text-white"><span class="mr-1"> (</span>) {</span>
                            </div>
                            <div class="ml-4">
                                <span class="text-teal">Route</span><span class="text-white"><span class="ml-1 mr-1">:</span><span class="mr-1">:</span></span><span id="type-view-route" class="text-orange"></span><span class="text-white mr-1">(</span><span id="url-view-route" class="text-green"></span><span class="text-white mr-1">, [</span><span class="text-green">'as'</span><span class="text-white"> => </span><span id="route-view-route" class="text-green"></span><span class="text-white">, </span><span class="text-green">'uses'</span><span class="text-white"> => </span><span id="controller-view-route" class="text-green"></span><span class="text-white"><span class="ml-1 mr-1">]</span><span class="mr-1">)</span>;</span>
                            </div>
                            <div class="text-white"><span class="mr-1">}</span><span class="mr-1">)</span>;</div>
                        </div>
                        <!-- descrição -->
                        <small id="description-view-route"></small>
                    </div>
                    <!-- data de criação e data da última atualização no sistema -->
                    <div class="col-lg-12">
                        <br>
                        <small class="float-left fe-view-fix-last-login-ip">&nbsp;</small>
                        <small id="created-at-view-route" class="text-light float-right fe-font-size-11 fe-view-fix-created-at"></small>
                        <small id="updated-at-view-route" class="text-light float-right fe-font-size-11 fe-view-fix-updated-at"></small>
                    </div>
                </div>
                <!-- fechar -->
                <div class="text-right float-right fe-form-footer fe-line-footer-white">
                    <a href="javascript:void(0)" class="mr-4 text-white" data-dismiss="modal">{{ __('Fechar') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
