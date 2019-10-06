<script>
    $(function () {
        // tabela
        let databasePermission = '#datatable-permissions-users';
        let tablePermissions   = $(databasePermission).DataTable({
            language:    dataTables_pt_br,
            dom:         dataTables_edited_button,
            buttons: [
                { extend: 'print', text: '<i class="fas fa-print"></i>', autoPrint: true },
                { extend: 'print', text: '<i class="fas fa-sync"></i>', action: function (e) { tablePermissions.draw(); animateItem(e.target, 'fa-pulse'); }}
            ],
            lengthMenu:  [[5, 10, 15, 20, 25, 30, 40, 50, 100, -1], ['5', '10', '15', '20', '25', '30', '40', '50', '100', 'todos']],
            pageLength:  10,
            order:       [2, 'desc'],
            stateSave:   true,
            processing:  true,
            serverSide:  true,
            deferRender: true,
            ajax: {
                url: '{{ app('router')->has('permission.user.list') ? route('permission.user.list') : url('/') }}',
                data: {
                    search: function () {
                        return $(databasePermission + '_filter input').val();
                    },
                    orderBy: function () {
                        $(document).off('click', databasePermission + ' th').on('click', databasePermission + ' th', function () {
                            if ($(this).hasClass('sorting') || $(this).hasClass('sorting_desc')) {
                                sessionStorage.setItem('table.order.' + databasePermission, $(this).data('base') + ' asc');
                            } else if ($(this).hasClass('sorting_asc')) {
                                sessionStorage.setItem('table.order.' + databasePermission, $(this).data('base') + ' desc');
                            }
                        });

                        return sessionStorage.getItem('table.order.' + databasePermission);
                    }
                }
            },
            columns: [
                { data: 'photo',  name: 'photo', className: 'text-center fe-td-img d-print-none', orderable: false, searchable: false },
                { data: 'name',   name: 'name' },
                { data: 'date',   name: 'date', searchable: false },
                { data: 'action', name: 'action', className: 'text-center fe-td-action d-print-none', orderable: false, searchable: false },
            ]
        }).on('error.dt', function() {
            tablePermissions.draw();
        });

        // tabela
        let databasePermissionAll = $(databasePermission + '-all').DataTable({
            language:    dataTables_pt_br,
            dom:         dataTables_edited_button,
            buttons: [
                { extend: 'print', text: '<i class="fas fa-print"></i>', autoPrint: true },
                { extend: 'print', text: '<i class="fas fa-sync"></i>', action: function (e) { databasePermissionAll.draw(); animateItem(e.target, 'fa-pulse'); }}
            ],
            lengthMenu:  [[5, 10, 15, 20, 25, 30, 40, 50, 100, -1], ['5', '10', '15', '20', '25', '30', '40', '50', '100', 'todos']],
            pageLength:  10,
            order:       [2, 'asc'],
            stateSave:   true,
            processing:  true,
            serverSide:  true,
            deferRender: true,
            ajax: {
                url: '{{ app('router')->has('permission.user.list.all') ? route('permission.user.list.all') : url('/') }}',
                data: {
                    search: function () {
                        return $(databasePermission + '-all_filter input').val();
                    },
                    orderBy: function () {
                        $(document).off('click', databasePermission + '-all th').on('click', databasePermission + '-all th', function () {
                            if ($(this).hasClass('sorting') || $(this).hasClass('sorting_desc')) {
                                sessionStorage.setItem('table.order.' + databasePermission, $(this).data('base') + ' asc');
                            } else if ($(this).hasClass('sorting_asc')) {
                                sessionStorage.setItem('table.order.' + databasePermission, $(this).data('base') + ' desc');
                            }
                        });

                        return sessionStorage.getItem('table.order.' + databasePermission);
                    }
                }
            },
            columns: [
                { data: 'photo',  name: 'photo', className: 'text-center fe-td-img d-print-none', orderable: false, searchable: false },
                { data: 'name',   name: 'name' },
                { data: 'date',   name: 'date', searchable: false },
                { data: 'action', name: 'action', className: 'text-center fe-td-action d-print-none', orderable: false, searchable: false },
            ]
        }).on('error.dt', function() {
            databasePermissionAll.draw();
        });
    });
</script>
