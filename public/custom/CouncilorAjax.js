$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var url = "/admin/councilor";
    var id = '';
    var url2 = "/admin/councilor/checkbox";
    var table = $('#councilor-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: dataurl,
        "columnDefs": [
        { "width": "180px", "targets": 3 },
        { "width": "70px", "targets": 2 }
        ],
        columns: [
        { data: 'strCounName', name: 'strCounName' },
        { data: 'district_description', name: 'districts.description' },
        { data: 'is_active', name: 'councilors.is_active', searchable: false },
        { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
    $('#add_councilor').on('hide.bs.modal', function() {
        $('#frmCouncilor').parsley().destroy();
        $('#frmCouncilor').trigger("reset");
    });
    $('#councilor-list').on('change', '#isActive', function() {
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
    //display modal form for task editing
    $('#councilor-list').on('click', '.open-modal', function() {
        var link_id = $(this).val();
        id = link_id;
        $.get(url + '/' + link_id + '/edit', function(data) {
            if (data == "Deleted") {
                refresh();
            } else {
                var textToFind = data.district_description;
                var dd = document.getElementById('intCounDistID');
                for (var i = 0; i < dd.options.length; i++) {
                    if (dd.options[i].text === textToFind) {
                        dd.selectedIndex = i;
                        break;
                    }
                }
                $('h4').text('Edit Councilor');
                $('#strCounFirstName').val(data.first_name);
                $('#strCounMiddleName').val(data.middle_name);
                $('#strCounLastName').val(data.last_name);
                $('#strCounEmail').val(data.email);
                $('#strCounCell').val(data.cell_no);
                $('#strUserEmail').val(data.user_email);
                $('#btn-save').val("update");
                $('#add_councilor').modal('show');
            }
        })
    });
    $('#councilor-list').on('click', '.btn-view', function() {
        var link_id = $(this).val();
        $.get(url + '/' + link_id, function(data) {
            if (data == "Deleted") {
                refresh();
            } else {
                var modalbody =
                "<div class='col-md-2'><img src='"+asset+"/"+data.picture+"' class='profile-user-img img-responsive img-square pull-right' alt='User Image'>"+
                "</div><div class='col-md-10'><div class='form-group'><label>District:</label><br>" + data.district_description +
                "</div><div class='form-group'><label>Name:</label><br>" + data.strCounName +
                "</div><div class='form-group'><label>E-mail Address:</label><br>" + data.email +
                "</div><div class='form-group'><label>Contact Number:</label><br>" + data.cell_no +
                "</div><div class='form-group'><label>Coordinator E-mail Address:</label><br>" + data.user_email +"</div></div>";
                bootbox.alert({
                    title: 'View Councilor',
                    message: modalbody,
                    backdrop: true,
                    buttons: {
                        ok: {
                            label: 'Ok',
                            className: 'btn-success btn-md'
                        }
                    }
                });
            }
        })
    });
    //display modal form for creating new task
    $('#btn-add').click(function() {
        $('h4').text('Add Councilor');
        $('#btn-save').val("add");
        $('#frmCouncilor').trigger("reset");
        $('#add_councilor').modal('show');
    });
    //delete task and remove it from list
    $('#councilor-list').on('click', '.btn-delete', function() {
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
                            if (data[0] == "true") {
                                swal({
                                    title: "Failed!",
                                    text: "<center>" + data[1].last_name + " is in use</center>",
                                    type: "error",
                                    showConfirmButton: false,
                                    allowOutsideClick: true,
                                    html: true
                                });
                            } else {
                                table.draw();
                                swal({
                                    title: "Deleted!",
                                    text: "<center>" + data.last_name + " is Deleted</center>",
                                    type: "success",
                                    timer: 1000,
                                    showConfirmButton: false,
                                    html: true
                                });
                            }
                        },
                        error: function(data) {
                        }
                    });
                }
            }, 500);
        });
    });
    //create new task / update existing task
    $("#btn-save").click(function() {
        $('#frmCouncilor').parsley().destroy();
        if ($('#frmCouncilor').parsley().isValid()) {
            $("#btn-save").attr('disabled', 'disabled');
            setTimeout(function() {
                $("#btn-save").removeAttr('disabled');
            }, 1000);
            var formData = new FormData($('#frmCouncilor')[0]);
            var state = $('#btn-save').val();
            var type = "POST"; //for creating new resource
            var my_url = url;
            if (state == "update") {
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
                    $('#add_councilor').modal('hide');
                    table.draw();
                    swal({
                        title: "Success!",
                        text: "<center>" + data.last_name + " is Stored</center>",
                        type: "success",
                        timer: 1000,
                        showConfirmButton: false,
                        html: true
                    });
                },
                error: function(data) {
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
});
