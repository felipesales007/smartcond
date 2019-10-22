@push('js')
    <!-- argon core -->
    <script src="{{ asset('argon/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('argon/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('argon/vendor/js-cookie/js.cookie.js') }}"></script>

    <!-- argon plugins -->
    <script src="{{ asset('argon/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('argon/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('argon/vendor/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('argon/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('argon/vendor/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('argon/vendor/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('argon/vendor/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('argon/vendor/datatables.net-select/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('argon/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('argon/vendor/bootstrap-datepicker/dist/locales/bootstrap-datepicker.pt-BR.min.js') }}"></script>
    <script src="{{ asset('argon/vendor/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('argon/vendor/select2/dist/js/i18n/pt-BR.js') }}"></script>
    <script src="{{ asset('argon/vendor/fullcalendar/dist/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('argon/vendor/fullcalendar/dist/locale/pt-br.js') }}"></script>
    <script src="{{ asset('argon/vendor/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('argon/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('argon/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('argon/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
@endpush

@stack('js')

<!-- argon js -->
<script src="{{ asset('argon/js/argon.min.js') }}"></script>

<!-- plugins -->
<script src="{{ asset('js/plugins/jquery.md5.js') }}"></script>
<script src="{{ asset('js/plugins/jquery.mask.min.js') }}"></script>
<script src="{{ asset('js/plugins/jquery.maskMoney.min.js') }}"></script>
<script src="{{ asset('js/plugins/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('js/plugins/validate/additional-methods.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-config.js') }}"></script>
<script src="{{ asset('js/plugins/viacep/viacep.js') }}"></script>
<script src="{{ asset('js/plugins/viacep/viacep-required.js') }}"></script>
<script src="{{ asset('js/plugins/image-preview.js') }}"></script>
<script src="{{ asset('js/plugins/notify.js') }}"></script>

<!-- desenvolvedor js -->
<script src="{{ asset('js/global.js') }}"></script>
