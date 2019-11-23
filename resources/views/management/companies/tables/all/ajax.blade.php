<script>
    $(function () {
        // variável
        let table = '#datatable-companies';

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
                url: '{{ app('router')->has('company.list') ? route('company.list') : url('/') }}',
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
                { data: 'logo',    name: 'logo', className: 'text-center fe-td-img d-print-none', orderable: false, searchable: false },
                { data: 'name',    name: 'name' },
                { data: 'email',   name: 'email' },
                { data: 'contact', name: 'contact' },
                { data: 'cnpj',    name: 'cnpj' },
                { data: 'action',  name: 'action', className: 'text-center fe-td-action d-print-none', orderable: false, searchable: false },
            ]
        }).on('error.dt', function() {
            datatable.draw();
        });
    });
</script>
