<!-- notificação -->
@if (session('notify'))
    <script>window.onload = function () {notify(JSON.parse('{!! session('notify') !!}'.replace(/&quot;/g, '"')));}</script>
@endif

<!-- jquery ajax -->
<script src="{{ asset('js/core/ajax.jquery.min.js') }}"></script>

<!-- gráficos -->
<script src="{{ asset('template/vendor/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('template/vendor/moment/min/moment-with-locales.js') }}"></script>
<script src="{{ asset('template/vendor/chart.js/dist/Chart.min.js') }}"></script>
<script src="{{ asset('template/vendor/chart.js/dist/Chart.extension.js') }}"></script>

<!-- corrige erros de navegador -->
<script>
    $(function () {
        if (typeof EventTarget !== 'undefined') {
            let func = EventTarget.prototype.addEventListener;
            EventTarget.prototype.addEventListener = function (type, fn, capture) {
                this.func = func;
                if(typeof capture !== 'boolean'){
                    capture = capture || {};
                    capture.passive = false;
                }
                this.func(type, fn, capture);
            };
        }
    }());
</script>
