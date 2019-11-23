<script>
    $(function () {
        // variável
        let table = '#datatable-admins';

        // tabela
        let datatable = $(table).DataTable({
            language:    datatables_pt_br,
            dom:         datatables_edited_button,
            buttons: [
                { extend: 'print', text: '<i class="fas fa-print"></i>', autoPrint: true },
                { extend: 'print', text: '<i class="fas fa-sync"></i>', action: function (e) { datatable.draw(); animateItem(e.target, 'fa-pulse'); }}
            ],
            lengthMenu:  [[5, 10, 15, 20, 25, 30, 40, 50, 100, -1], ['5', '10', '15', '20', '25', '30', '40', '50', '100', 'todos']],
            pageLength:  10,
            order:       [1, 'asc'],
            stateSave:   true,
            processing:  true,
            serverSide:  true,
            deferRender: true,
            ajax: {
                url: '{{ app('router')->has('admin.list') ? route('admin.list') : url('/') }}',
                data: {
                    search: function () {
                        return $(table + '_filter input').val();
                    },
                    orderBy: function () {
                        $(document).off('click', table + ' th').on('click', table + ' th', function () {
                            if ($(this).hasClass('sorting') || $(this).hasClass('sorting_desc')) {
                                sessionStorage.setItem('table.order.' + table, $(this).data('base') + ' asc');
                            } else if ($(this).hasClass('sorting_asc')) {
                                sessionStorage.setItem('table.order.' + table, $(this).data('base') + ' desc');
                            }
                        });

                        return sessionStorage.getItem('table.order.' + table);
                    }
                }
            },
            columns: [
                { data: 'photo',        name: 'photo', className: 'text-center fe-td-img d-print-none', orderable: false, searchable: false },
                { data: 'name',         name: 'name' },
                { data: 'company_name', name: 'company_name', className: '{{ auth()->user()['admin'] == 1 && \App\Models\Company\Company::id() != 1 ? 'd-none' : '' }}' },
                { data: 'email',        name: 'email' },
                { data: 'date',         name: 'date', searchable: false },
                { data: 'action',       name: 'action', className: 'text-center fe-td-action d-print-none', orderable: false, searchable: false },
            ]
        }).on('error.dt', function() {
            datatable.draw();
        });

        // reenviando e-mail de confirmação do administrador
        $(document).on('click', '.btn-resend-email-admin', function (e) {
            e.preventDefault();
            $('.tooltip').remove();
            let btn = $(this).attr('disabled', 'disabled').html('<i class="fas fa-sync-alt fa-pulse"></i>');

            if ($('.form-resend-email-admin').valid()) {
                $.ajax({
                    data: $(this).parent().serialize(),
                    url: '{{ app('router')->has('admin.resend.email') ? route('admin.resend.email') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        btn.removeAttr('disabled', 'disabled').html('<i class="fas fa-sync-alt" data-toggle="tooltip" data-placement="top" title="reenviar e-mail de confirmação para o administrador"></i>');
                        removeValidate();
                        notify(data);
                    },
                    error: function (data) {
                        btn.removeAttr('disabled', 'disabled').html('<i class="fas fa-exclamation-circle" data-toggle="tooltip" data-placement="top" title="ops, ocorreu um erro ao tentar reenviar o e-mail, por favor tente novamente mais tarde"></i>');
                        $('.form-resend-email-admin').valid();
                        serverValidate(data);
                        notifyError('Erro ao reenviar o e-mail de confirmação de e-mail.');
                    }
                });
            } else {
                $(this).removeAttr('disabled', 'disabled').html('<i class="fas fa-exclamation-circle" data-toggle="tooltip" data-placement="top" title="ops, ocorreu um erro ao tentar reenviar o e-mail, por favor tente novamente mais tarde"></i>');
                return false;
            }
        });
    });
</script>
