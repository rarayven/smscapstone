$(document).ready(function() {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var url = "/admin/grade";
  var id = '';
  var url2 = "/admin/grade/checkbox";
  var table = $('#grade-table').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    ajax: dataurl,
    "columnDefs": [
    { "width": "130px", "targets": 5 },
    { "width": "70px", "targets": 4 }
    ],
    columns: [
    { data: 'description', name: 'description' },
    { data: 'highest_grade', name: 'highest_grade' },
    { data: 'lowest_grade', name: 'lowest_grade' },
    { data: 'failing_grade', name: 'failing_grade' },
    { data: 'is_active', name: 'is_active', searchable: false },
    { data: 'action', name: 'action', orderable: false, searchable: false }
    ]
  });
  $('#add_grade').on('hide.bs.modal', function() {
    $('#frmGrade').parsley().destroy();
    $('#frmGrade').trigger("reset");
  });
  $('#grade-list').on('change', '#isActive', function() {
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
    $('#grade-list').on('click', '.open-modal', function() {
      var link_id = $(this).val();
      id = link_id;
      $.get(url + '/' + link_id + '/edit', function(data) {
        if (data == "Deleted") {
          refresh();
        } else {
          $('h4').text('Edit Academic Grading');
          $('#strSystDesc').val(data.description);
          $('#dblSystHighGrade').val(data.highest_grade);
          $('#dblSystLowGrade').val(data.lowest_grade);
          $('#strSystFailGrade').val(data.failing_grade);
          $('#btn-save').val("update");
          $('#add_grade').modal('show');
        }
      })
    });
    //display modal form for creating new task
    $('#btn-add').click(function() {
      $('h4').text('Add Academic Grading');
      $('#btn-save').val("add");
      $('#frmGrade').trigger("reset");
      $('#add_grade').modal('show');
    });
    //delete task and remove it from list
    $('#grade-list').on('click', '.btn-delete', function() {
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
    //create new task / update existing task 
    $("#btn-save").click(function() {
      $('#frmGrade').parsley().destroy();
      if ($('#frmGrade').parsley().isValid()) {
        $("#btn-save").attr('disabled', 'disabled');
        setTimeout(function() {
          $("#btn-save").removeAttr('disabled');
        }, 1000);
        var formData = {
          strSystDesc: $('#strSystDesc').parsley('data-parsley-whitespace', 'squish').getValue(),
          dblSystLowGrade: $('#dblSystLowGrade').parsley('data-parsley-whitespace', 'squish').getValue(),
          strSystFailGrade: $('#strSystFailGrade').parsley('data-parsley-whitespace', 'squish').getValue(),
          dblSystHighGrade: $('#dblSystHighGrade').parsley('data-parsley-whitespace', 'squish').getValue()
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
                  $('#add_grade').modal('hide');
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
  });
