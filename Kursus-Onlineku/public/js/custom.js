// public/js/custom.js

$(function () {

    // Cek dulu, plugin DataTable ada atau nggak
    if ($.fn.DataTable) {
        $('.datatables').DataTable();   // pastikan class di HTML juga "datatables"
    }

    // Tooltip Bootstrap
    $('[data-toggle="tooltip"]').tooltip();

    // Autofocus input di dalam modal
    $('.modal').on('shown.bs.modal', function () {
        $(this).find('form input:eq(1)').focus();
    });
});

