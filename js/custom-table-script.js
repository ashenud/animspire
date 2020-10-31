$(document).ready(function () {
    var table = $('#datatable').DataTable({
        responsive: true,
        "pagingType": "simple_numbers",
        "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
        "dom": "<'container'<'row'<'col-md-4'l><'col-md-2'><'col-md-6'f>>>" +
            "<'container'<'row mt-3 d-flex justify-content-center't>>" +
            "<'container'<'row mt-3'<'col-md-3'i><'col-md-9 d-flex justify-content-end'p>>>",

        "language": {
            "lengthMenu": 'Display <select class="mdl-textfield__input select-btn">' +
                '<option value="5">5</option>' +
                '<option value="10">10</option>' +
                '<option value="25">25</option>' +
                '<option value="-1">All</option>' +
                '</select> Records'
        }

    });
    
        var table = $('#datatable2').DataTable({
        responsive: true,
        "pagingType": "simple_numbers",
        "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
        "dom": "<'container'<'row'<'col-md-3'l><'col-md-5'><'col-md-4'f>>>" +
            "<'container'<'row mt-3 d-flex justify-content-center't>>" +
            "<'container'<'row mt-3'<'col-md-3'i><'col-md-9 d-flex justify-content-end'p>>>",

        "language": {
            "lengthMenu": 'Display <select class="mdl-textfield__input select-btn">' +
                '<option value="5">5</option>' +
                '<option value="10">10</option>' +
                '<option value="25">25</option>' +
                '<option value="-1">All</option>' +
                '</select> Records'
        }

    });
});