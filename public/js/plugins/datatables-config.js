// inicializa o datatables personalizado
$.fn.DataTable.ext.pager.numbers_length = 5;
$.fn.dataTable.ext.errMode = 'none';

let dataTables_pt_br = {
    sEmptyTable: 'Nenhum registro encontrado',
    sInfo: 'Mostrando de _START_ até _END_ de _TOTAL_ registros',
    sInfoEmpty: 'Mostrando 0 até 0 de 0 registros',
    sInfoFiltered: '(Filtrados de _MAX_ registros)',
    sInfoPostFix: '',
    sInfoThousands: '.',
    sLengthMenu: 'resultados por página _MENU_',
    sLoadingRecords: '<i class="fa fa-spinner fa-pulse mr-2"></i>Carregando',
    sProcessing: '<i class="fa fa-spinner fa-pulse mr-2"></i>Carregando',
    sZeroRecords: 'Nenhum registro encontrado',
    sSearchPlaceholder: 'Pesquisar',
    sSearch: '',
    oPaginate: {
        sNext: '<i class="fas fa-angle-right">',
        sPrevious: '<i class="fas fa-angle-left">',
        sFirst: '<i class="fas fa-angle-double-left"></i>',
        sLast: '<i class="fas fa-angle-double-right"></i>'
    },
    oAria: {
        sSortAscending: 'Ordenar colunas de forma ascendente',
        sSortDescending: 'Ordenar colunas de forma descendente'
    }
};

let dataTables_edited =
    '<"row"<"col-md-6" <"float-left ml-3 mr--4" f>><"text-right col-md-6" l>>' +
    '<"row"<"col-md-12" tr>>' +
    '<"row"<"col-md-6" i><"col-md-6" p>>';

let dataTables_edited_button =
    '<"row"<"col-md-6" <"float-left ml-3 mr--4" f><B>><"text-right col-md-6" l>>' +
    '<"row"<"col-md-12" tr>>' +
    '<"row"<"col-md-6" i><"col-md-6" p>>';

$('body').tooltip({
    selector: '[data-toggle="tooltip"]'
});
