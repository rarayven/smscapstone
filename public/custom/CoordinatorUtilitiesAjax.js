$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var id = '';
    var url = "/coordinator/utilities";
    $('#view_step').on('hide.bs.modal', function() {
        $('#frmStep').trigger("reset");
        $('.steps').empty();
    });
    $('#view_claim').on('hide.bs.modal', function() {
        $('#frmClaim').trigger("reset");
        $('.stipend').empty();
    });
    $('.table').DataTable();
    $('td').on('click', '.btn-progress', function() {
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
                    message: 'No requirement passed'
                }, {
                    type: 'success',
                    z_index: 2000,
                    delay: 5000,
                });
            }
        });
    });
    $('td').on('click', '.open-modal', function() {
        $(".open-modal").attr('disabled', 'disabled');
        setTimeout(function() {
            $(".open-modal").removeAttr('disabled');
        }, 1000);
        var link_id = $(this).val();
        id = link_id;
        $.get(url + '/allocation/'+link_id, function(data) {
            $.each(data, function(index, value) {
                var show = "<li>" +
                "<input type='checkbox' id=" + value.id + " name='claim[]' value=" + value.id + ">" +
                "<span class='text' style='padding-left: 15px;'>" + value.description + "</span>" +
                "</li>";
                $('.stipend').append(show);
            });
            if (data[0] != undefined) {
                $('#view_claim').modal('show');
            } else {
                $.notify({
                    icon: 'fa fa-check',
                    message: 'No allocation claimed'
                }, {
                    type: 'success',
                    z_index: 2000,
                    delay: 5000,
                });
            }
        });
    });
    $('td').on('change', '#isActive', function() {
        var link_id = $(this).val();
        $.ajax({
            url: url + '/checkbox/' + link_id,
            type: "PUT",
            success: function(data) {
                Pace.restart();
            },
            error: function(data) {
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
            url: url  + '/allocation/'+ id,
            type: "PUT",
            data: formData,
            dataType: 'json',
            success: function(data) {
                $('#view_claim').modal('hide');
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
    function getBudget() {
      $.get('/coordinator/budget/getlatest', function(data){
        $('.slot').text(data.slot_count);
        $('.budget').text(data.amount);
    });
  }
  $('.todo-list').todoList();
});
