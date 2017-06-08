$(document).ready(function() {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var url = "/admin/barangay";
  var id = '';
  var url2 = "/admin/barangay/checkbox";
  var table = $('#barangay-table').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    ajax: dataurl,
    "columnDefs": [
    { "width": "130px", "targets": 3 },
    { "width": "70px", "targets": 2 }
    ],
    columns: [
    { data: 'districts_description', name: 'districts.description' },
    { data: 'description', name: 'barangay.description' },
    { data: 'is_active', name: 'barangay.is_active', searchable: false },
    { data: 'action', name: 'action', orderable: false, searchable: false }
    ]
  });
  $('#add_barangay').on('hide.bs.modal', function() {
    $('#frmBarangay').parsley().destroy();
    $('#frmBarangay').trigger("reset");
  });
  $('#barangay-list').on('change', '#isActive', function() {
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
    $('#barangay-list').on('click', '.open-modal', function() {
      $('#strBaraDesc').parsley().removeError('ferror', { updateClass: false });
      var link_id = $(this).val();
      id = link_id;
      $.get(url + '/' + link_id + '/edit', function(data) {
        if (data == "Deleted") {
          refresh();
        } else {
          var textToFind = data.districts_description;
          var dd = document.getElementById('intDistID');
          for (var i = 0; i < dd.options.length; i++) {
            if (dd.options[i].text === textToFind) {
              dd.selectedIndex = i;
              break;
            }
          }
          $('h4').text('Edit Barangay');
          $('#strBaraDesc').val(data.description);
          $('#btn-save').val("update");
          $('#add_barangay').modal('show');
        }
      })
    });
    //display modal form for creating new task
    $('#btn-add').click(function() {
      $('#strBaraDesc').parsley().removeError('ferror', { updateClass: false });
      $('h4').text('Add Barangay');
      $('#btn-save').val("add");
      $('#frmBarangay').trigger("reset");
      $('#add_barangay').modal('show');
    });
    //delete task and remove it from list
    $('#barangay-list').on('click', '.btn-delete', function() {
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
        closeOnCancel: true,
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
      $('#frmBarangay').parsley().destroy();
      if ($('#frmBarangay').parsley().isValid()) {
        $("#btn-save").attr('disabled', 'disabled');
        setTimeout(function() {
          $("#btn-save").removeAttr('disabled');
        }, 1000);
        var formData = {
          intDistID: $('#intDistID').val(),
          strBaraDesc: $('#strBaraDesc').parsley('data-parsley-whitespace', 'squish').getValue()
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
            $('#add_barangay').modal('hide');
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
  });
