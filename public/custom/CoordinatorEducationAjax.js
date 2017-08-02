$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var table = $('#table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: dataurl,
        columns: [
        { data: 'description', name: 'description' },
        { data: 'is_active', name: 'is_active', searchable: false, orderable: false }
        ]
    });
    $('#list').on('change', '#isActive', function() {
        var link_id = $(this).val();
        $.ajax({
            url: url + '/' + link_id,
            type: "PUT",
            success: function(data) {
                Pace.restart();
            },
            error: function(data) {
            }
        });
    });
});
