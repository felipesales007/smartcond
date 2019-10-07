@push('js')
    <!-- template core -->
    <script src="{{ asset('template/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/vendor/js-cookie/js.cookie.js') }}"></script>

    <!-- template plugins -->
    <script src="{{ asset('template/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables.net-select/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap-datepicker/dist/locales/bootstrap-datepicker.pt-BR.min.js') }}"></script>
    <script src="{{ asset('template/vendor/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('template/vendor/select2/dist/locales/select2.pt-BR.min.js') }}"></script>
    <script src="{{ asset('template/vendor/dropzone/dist/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('template/vendor/fullcalendar/dist/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('template/vendor/fullcalendar/dist/locales/fullcalendar.pt-br.js') }}"></script>
    <script src="{{ asset('template/vendor/list.js/dist/list.min.js') }}"></script>
    <script src="{{ asset('template/vendor/quill/dist/quill.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('template/vendor/nouislider/distribute/nouislider.min.js') }}"></script>
    <script src="{{ asset('template/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('template/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('template/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
    <script src="{{ asset('template/vendor/lavalamp/js/jquery.lavalamp.min.js') }}"></script>
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script> -->
@endpush

@stack('js')

<!-- template js -->
<script src="{{ asset('template/js/template.min.js') }}"></script>

<!-- plugins -->
<script src="{{ asset('js/plugins/jquery.md5.js') }}"></script>
<script src="{{ asset('js/plugins/jquery.mask.min.js') }}"></script>
<script src="{{ asset('js/plugins/jquery.maskMoney.min.js') }}"></script>
<script src="{{ asset('js/plugins/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('js/plugins/validate/additional-methods.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-config.js') }}"></script>
<script src="{{ asset('js/plugins/viacep/viacep-profile-edit.js') }}"></script>
<script src="{{ asset('js/plugins/viacep/viacep-user-edit.js') }}"></script>
<script src="{{ asset('js/plugins/viacep/viacep-company-new.js') }}"></script>
<script src="{{ asset('js/plugins/viacep/viacep-company-edit.js') }}"></script>
<script src="{{ asset('js/plugins/img-preview.js') }}"></script>
<script src="{{ asset('js/plugins/notify.js') }}"></script>

<!-- desenvolvedor js -->
<script src="{{ asset('js/global.js') }}"></script>
