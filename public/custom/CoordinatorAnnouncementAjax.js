$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var url = "/coordinator/announcements";
    var id = '';
    var table = $('#district-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: dataurl,
        "columnDefs": [
        { "width": "200px", "targets": 3 },
        { "width": "150px", "targets": 2 }
        ],
        columns: [
        { data: 'title', name: 'title' },
        { data: 'description', name: 'description' },
        { data: 'date_post', name: 'date_post', searchable: false },
        { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
    $('#btn-add').click(function() {
        $('#btn-save').val("add");
        $('#frmAnnouncement').trigger("reset");
        $('#add_announcement').modal('show');
    });
    $('#add_announcement').on('hidden.bs.modal', function() {
        $('#frmAnnouncement').trigger("reset");
        $('#frmAnnouncement').parsley().destroy();
    });
    //create new task / update existing task
    $("#btn-save").click(function() {
        $('#frmAnnouncement').parsley().destroy();
        if ($('#frmAnnouncement').parsley().isValid()) {
            $("#btn-save").attr('disabled', 'disabled');
            setTimeout(function() {
                $("#btn-save").removeAttr('disabled');
            }, 1000);
            var formData = new FormData($('#frmAnnouncement')[0]);
            var state = $('#btn-save').val();
            var type = "POST";
            var my_url = url;
            if (state == "update") {
                type = "PUT";
                my_url += '/' + id;
            }
            $.ajax({
                type: type,
                url: my_url,
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function(data) {
                    $('#add_announcement').modal('hide');
                    table.draw();
                    swal({
                        title: "Success!",
                        text: "<center>" + data.description + " is Stored</center>",
                        type: "success",
                        timer: 1000,
                        showConfirmButton: false,
                        html: true
                    });
                },
                error: function(data) {
                    console.log('Error:', data.responseText);
                    $.notify({
                        message: data.responseText.replace(/['"]+/g, '')
                    }, {
                        type: 'warning',
                        z_index: 2000,
                        delay: 5000,
                    });
                }
            });
        }
    });
    $('#list').on('click', '.btn-delete', function() {
        var link_id = $(this).val();
        swal({
            title: "Are you sure?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Delete",
            cancelButtonText: "Cancel",
            closeOnConfirm: false,
            allowOutsideClick: true,
            showLoaderOnConfirm: true,
            closeOnCancel: true
        },
        function(isConfirm) {
            setTimeout(function() {
                if (isConfirm) {
                    $.ajax({
                        url: url + '/' + link_id,
                        type: "DELETE",
                        success: function(data) {
                            table.draw();
                            swal({
                                title: "Deleted!",
                                text: "<center>" + data.title + " is Deleted</center>",
                                type: "success",
                                timer: 1000,
                                showConfirmButton: false,
                                html: true
                            });
                        },
                        error: function(data) {
                            console.log(data);
                        }
                    });
                }
            }, 500);
        });
    });
});
