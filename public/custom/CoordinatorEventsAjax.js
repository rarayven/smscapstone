$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(".timepicker").timepicker({
        showInputs: false
    });
    var id = '';
    var url = "/coordinator/events";
    var url2 = "/coordinator/events/checkbox";
    var dt = new Date();
    dt.setDate(dt.getDate());
    $('#datepicker').datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 3,
        autoclose: true,
        format: 'yyyy-mm-dd',
        startDate: dt
    });
    var table = $('#table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: dataurl,
        "columnDefs": [
        { "width": "180px", "targets": 5 },
        { "width": "70px", "targets": 4 }
        ],
        columns: [
        { data: 'title', name: 'title' },
        { data: 'date_held', name: 'date_held' },
        { data: 'time_from', name: 'time_from' },
        { data: 'time_to', name: 'time_to' },
        { data: 'status', name: 'status', searchable: false },
        { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
    $('#table-done').DataTable({
        "columnDefs": [
        { "width": "70px", "targets": 5 },
        { "width": "70px", "targets": 4 }
        ]
    });
    //display modal form for creating new task
    $('#btn-add').click(function() {
        $('#txt').text('Add Event');
        $('#btn-save').val("add");
        $('#frmEvent').trigger("reset");
        $('#add_event').modal('show');
    });
    $('#list').on('click', '.open-modal', function() {
        var link_id = $(this).val();
        id = link_id;
        $.get(url + '/' + link_id + '/edit', function(data) {
            if (data == "Deleted") {
                refresh();
            } else {
                $('#txt').text('Edit Event');
                $('#frmEvent').trigger("reset");
                $('#title').val(data.title),
                $('#place_held').val(data.place_held),
                $('#time_from').val(data.time_from),
                $('#time_to').val(data.time_to),
                $('#datepicker').val(data.date_held),
                $('#description').val(data.description)
                $('#btn-save').val("update");
                $('#add_event').modal('show');
            }
        })
    });
    function refresh() {
        swal({
            title: "Record Deleted!",
            type: "warning",
            text: "<center>Refresh Records?</center>",
            html: true,
            showCancelButton: true,
            confirmButtonClass: "btn-success",
            confirmButtonText: "Refresh",
            cancelButtonText: "Cancel",
            closeOnConfirm: true,
            allowOutsideClick: true,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                table.draw();
            }
        });
    }
    $("#btn-save").click(function() {
        $('#frmEvent').parsley().destroy();
        if ($('#frmEvent').parsley().isValid()) {
            $("#btn-save").attr('disabled', 'disabled');
            setTimeout(function() {
                $("#btn-save").removeAttr('disabled');
            }, 1000);
            var formData = {
                title: $('#title').val(),
                place_held: $('#place_held').val(),
                time_from: $('#time_from').val(),
                time_to: $('#time_to').val(),
                date_held: $('#datepicker').val(),
                description: $('#description').val()
            }
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
                dataType: 'json',
                success: function(data) {
                    $('#add_event').modal('hide');
                    table.draw();
                    swal({
                        title: "Success!",
                        text: "<center>Data Stored</center>",
                        type: "success",
                        timer: 1000,
                        showConfirmButton: false,
                        html: true
                    });
                },
                error: function(data) {
                    $.notify({
                        icon: 'fa fa-warning',
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
                            if (data == "Deleted") {
                                refresh();
                            } else {
                                if (data[0] == "true") {
                                    swal({
                                        title: "Failed!",
                                        text: "<center>Data in use</center>",
                                        type: "error",
                                        showConfirmButton: false,
                                        allowOutsideClick: true,
                                        html: true
                                    });
                                } else {
                                    table.draw();
                                    swal({
                                        title: "Deleted!",
                                        text: "<center>Data Deleted</center>",
                                        type: "success",
                                        timer: 1000,
                                        showConfirmButton: false,
                                        html: true
                                    });
                                }
                            }
                        },
                        error: function(data) {
                        }
                    });
                }
            }, 500);
        });
    });
    $('#list').on('change', '#isActive', function() {
        var link_id = $(this).val();
        $.ajax({
            url: url2 + '/' + link_id,
            type: "PUT",
            success: function(data) {
                Pace.restart();
                if (data == "Deleted") {
                    refresh();
                }
            },
            error: function(data) {
            }
        });
    });
});
