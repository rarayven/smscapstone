$(document).ready(function() {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var url = "/admin/requirements";
  var table = $('#steps-table').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    ajax: dataurl,
    "columnDefs": [
    { "width": "70px", "targets": 3 }
    ],
    columns: [
    { data: 'strCounName', name: 'strCounName' },
    { data: 'application', name: 'application', orderable: false, searchable: false },
    { data: 'renewal', name: 'renewal', orderable: false, searchable: false },
    { data: 'action', name: 'action', orderable: false, searchable: false }
    ]
  });
  $('#add_steps').on('hide.bs.modal', function() {
    $('#frmSteps').parsley().destroy();
    $('#frmSteps').trigger("reset");
  });
  $('#btn-add').click(function() {
    $('#btn-save').val("add");
    $('h4').text('Add Requirements');
    $('#add_steps').modal('show');
  });
  $("#btn-save").click(function() {
    $('#frmSteps').parsley().destroy();
    if ($('#frmSteps').parsley().isValid()) {
      $("#btn-save").attr('disabled', 'disabled');
      setTimeout(function() {
        $("#btn-save").removeAttr('disabled');
      }, 1000);
      var formData = {
        councilor_id: $('#councilor_id').val(),
        strStepDesc: $('#strStepDesc').parsley('data-parsley-whitespace', 'squish').getValue(),
        type: $('#type').val()
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
          $('#add_steps').modal('hide');
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
