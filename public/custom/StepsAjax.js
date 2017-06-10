$(document).ready(function() {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var url = "/admin/steps";
  var id = '';
  var url2 = "/admin/steps/checkbox";
  var table = $('#steps-table').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    ajax: dataurl,
    "columnDefs": [
    { "width": "130px", "targets": 4 },
    { "width": "70px", "targets": 3 }
    ],
    columns: [
    { data: 'order', name: 'order' },
    { data: 'description', name: 'description' },
    { data: 'deadline', name: 'deadline' },
    { data: 'is_active', name: 'is_active', searchable: false },
    { data: 'action', name: 'action', orderable: false, searchable: false }
    ]
  });
  $('#add_steps').on('hide.bs.modal', function() {
    $('#frmSteps').parsley().destroy();
    $('#frmSteps').trigger("reset");
  });
  $('#steps-list').on('change', '#isActive', function() {
    var link_id = $(this).val();
    $.ajax({
      url: url2 + '/' + link_id,
      type: "PUT",
      success: function(data) {
        Pace.restart();
        if (data == "Deleted") {
          refresh();
        } else {
          $('#num' + link_id).replaceWith("<div id=num" + data.id + ">" + data.order + "</div>");
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
    $('#steps-list').on('click', '.open-modal', function() {
      var link_id = $(this).val();
      id = link_id;
      $.get(url + '/' + link_id + '/edit', function(data) {
        if (data == "Deleted") {
          refresh();
        } else {
          $('#strStepDesc').val(data.description);
          $('#intStepDeadline').val(data.deadline);
                $('#intStepOrder').val(data.order).attr('readonly', 'readonly'); //.removeAttr('readonly');
                $('h4').text('Edit Step');
                $('#btn-save').val("update");
                $('#add_steps').modal('show');
              }
            })
    });
    //display modal form for creating new task
    $('#btn-add').click(function() {
      $.get(url + '/create', function(data) {
        $('#btn-save').val("add");
        $('h4').text('Add Step');
        $('#intStepOrder').val(data).attr('readonly', 'readonly');
        $('#add_steps').modal('show');
      })
    });
    //display modal form for creating new task
    $('#btn-order').click(function() {
      $('h4').text('Order Steps');
      $.get(url + '/order', function(data) {
        $('.todo-list').empty();
        $('#count').empty();
        var ctr = 1;
        $.each(data, function(index, value) {
          var showOrder = "<li style='height: 35px;'><h5>#"+ ctr++ +"</h5></li>"
          var show = "<li style='height: 40px;'>" +
          "<div class='col-xs-12 handle'>" +
          "<span>" +
          "<i class='fa fa-ellipsis-v'></i>" +
          "<i class='fa fa-ellipsis-v'></i>" +
          "</span>" +
          "<label>&emsp;" + value.description + "</label>" +
          "<input type='hidden' name='order[]' value=" + value.id + ">" +
          "</div>" +
          "</li>";
          $('.todo-list').append(show);
          $('#count').append(showOrder);
        });
        $('#order_steps').modal('show');
      })
    });
    //delete task and remove it from list
    $('#steps-list').on('click', '.btn-delete', function() {
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
                      text: "<center>" + data[1].description + " is in use</center>",
                      type: "error",
                      showConfirmButton: false,
                      allowOutsideClick: true,
                      html: true
                    });
                  } else {
                    table.draw();
                    swal({
                      title: "Deleted!",
                      text: "<center>" + data.description + " is Deleted</center>",
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
    //create new task / update existing task
    $("#btn-save").click(function() {
      $('#frmSteps').parsley().destroy();
      if ($('#frmSteps').parsley().isValid()) {
        $("#btn-save").attr('disabled', 'disabled');
        setTimeout(function() {
          $("#btn-save").removeAttr('disabled');
        }, 1000);
        var formData = {
          strStepDesc: $('#strStepDesc').parsley('data-parsley-whitespace', 'squish').getValue(),
          intStepDeadline: $('#intStepDeadline').val(),
          intStepOrder: $('#intStepOrder').val()
        }
                //used to determine the http verb to use [add=POST], [update=PUT]
                var state = $('#btn-save').val();
            var type = "POST"; //for creating new resource
            var my_url = url;
            if (state == "update") {
                type = "PUT"; //for updating existing resource
                my_url += '/' + id;
              }
              $.ajax({
                type: type,
                url: my_url,
                data: formData,
                dataType: 'json',
                success: function(data) {
                  $('#add_steps').modal('hide');
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
    //create new task / update existing task
    $("#btn-submit").click(function() {
      $("#btn-submit").attr('disabled', 'disabled');
      setTimeout(function() {
        $("#btn-submit").removeAttr('disabled');
      }, 1000);
      var formData = $('#frmOrder').serialize();
      var type = "POST";
      var my_url = url + '/order';
      $.ajax({
        type: type,
        url: my_url,
        data: formData,
        dataType: 'json',
        success: function(data) {
          $('#order_steps').modal('hide');
          table.draw();
          swal({
            title: "Success!",
            text: "<center>" + data + "</center>",
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
    });
    $(".todo-list").sortable({
      placeholder: "sort-highlight",
      handle: ".handle",
      forcePlaceholderSize: true,
      zIndex: 999999
    });
  });
