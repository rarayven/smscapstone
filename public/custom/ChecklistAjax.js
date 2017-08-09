$(document).ready(function() {
    var url = '/coordinator/checklist';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var id = '';
    var url2 = '/coordinator/checklist/allocation';
    var table = $('#student-table').DataTable({
        processing: true,
        serverSide: true,
        "columnDefs": [
        { "width": "130px", "targets": 4 },
        { "width": "150px", "targets": 3 },
        { "width": "150px", "targets": 2 }
        ],
        ajax: {
            type: 'POST',
            url: dataurl,
            data: function(d) {
                d.strUserFirstName = $('#strUserFirstName').val(),
                d.strUserMiddleName = $('#strUserMiddleName').val(),
                d.strUserLastName = $('#strUserLastName').val(),
                d.intDistID = $('#intDistID').val(),
                d.intCounID = $('#intCounID').val(),
                d.intBaraID = $('#intBaraID').val(),
                d.intBatcID = $('#intBatcID').val(),
                d.strPersStreet = $('#strPersStreet').val(),
                d.intStepID = $('#intStepID').val(),
                d.strPersReligion = $('#strPersReligion').val()
            }
        },
        columns: [
        { data: 'id', name: 'users.id' },
        { data: 'strStudName', name: 'strStudName' },
        { data: 'counter', name: 'counter', searchable: false, orderable: false },
        { data: 'stipend', name: 'stipend', searchable: false, orderable: false },
        { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
    $('#btn-advSearch').on('click', function(e) {
        table.draw();
        e.preventDefault();
        $('#frmAdv').trigger("reset");
        $('#advanced_search').modal('hide');
    });
    $('#advanced_search').on('hide.bs.modal', function() {
        $('#frmAdv').trigger("reset");
    });
    $('#view_step').on('hide.bs.modal', function() {
        $('#frmStep').trigger("reset");
        $('.steps').empty();
    });
    $('#view_claim').on('hide.bs.modal', function() {
        $('#frmClaim').trigger("reset");
        $('.stipend').empty();
    });
    $('#advsearch').click(function() {
        $('#advanced_search').modal('show');
    });
    $('#student-list').on('click', '.btn-progress', function() {
        $(".btn-progress").attr('disabled', 'disabled');
        setTimeout(function() {
            $(".btn-progress").removeAttr('disabled');
        }, 1000);
        var link_id = $(this).val();
        id = link_id;
        $.get(url + '/create/'+link_id, function(data) {
            $.each(data, function(index, value) {
                var show = "<li>" +
                "<input type='checkbox' id=check" + value.id + " name='steps[]' value=" + value.id + ">" +
                "<span class='text' style='padding-left: 15px;'>" + value.description + "</span>" +
                "</li>";
                $('.steps').append(show);
            });
            if (data[0] != undefined) {
                $('#view_step').modal('show');
            } else {
                $.notify({
                    icon: 'fa fa-check',
                    message: 'All requirement passed'
                }, {
                    type: 'success',
                    z_index: 2000,
                    delay: 5000,
                });
            }
        });
    });
    $('#student-list').on('click', '.open-modal', function() {
        $(".open-modal").attr('disabled', 'disabled');
        setTimeout(function() {
            $(".open-modal").removeAttr('disabled');
        }, 1000);
        var link_id = $(this).val();
        id = link_id;
        $.get(url + '/allocation/'+link_id, function(data) {
            $.each(data, function(index, value) {
                if (value.allocation_type_id != null) {
                    var show = "<li>" +
                    "<input type='checkbox' id=" + value.id + " name='claim[]' value=" + value.id + ">" +
                    "<span class='text' style='padding-left: 15px;'>" + value.description + "</span>" +
                    "</li>";
                    $('.stipend').append(show);
                } else {
                    var show = "<li class='done'>" +
                    "<span class='text' style='padding-left: 15px;'>" + value.description + "</span> Disabled" +
                    "</li>";
                    $('.stipend').append(show);
                }
            });
            if (data[0] != undefined) {
                $('#view_claim').modal('show');
            } else {
                $.notify({
                    icon: 'fa fa-check',
                    message: 'All allocation claimed'
                }, {
                    type: 'success',
                    z_index: 2000,
                    delay: 5000,
                });
            }
        });
    });
    $("#btn-save").click(function() {
        $("#btn-save").attr('disabled', 'disabled');
        setTimeout(function() {
            $("#btn-save").removeAttr('disabled');
        }, 1000);
        var formData = $('#frmClaim').serialize();
        $.ajax({
            url: url2 + '/' + id,
            type: "PUT",
            data: formData,
            dataType: 'json',
            success: function(data) {
                $('#view_claim').modal('hide');
                table.draw();
                getBudget();
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
    });
    $("#btn-submit").click(function() {
        $("#btn-submit").attr('disabled', 'disabled');
        setTimeout(function() {
            $("#btn-submit").removeAttr('disabled');
        }, 1000);
        var formData = $('#frmStep').serialize();
        $.ajax({
            url: url + '/' + id,
            type: "PUT",
            data: formData,
            dataType: 'json',
            success: function(data) {
                $('#view_step').modal('hide');
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
    });
    $('.todo-list').todoList();
    function getBudget() {
      $.get('/coordinator/budget/getlatest', function(data){
        $('.slot').text(data.slot_count);
        $('.budget').text(data.amount);
    });
  }
});
