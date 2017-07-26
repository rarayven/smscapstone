$(document).ready(function() {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var table = $('#budget-table').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    ajax: dataurl,
    "order": [3, 'desc'],
    "columnDefs": [
    { "width": "180px", "targets": 4 }
    ],
    "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
      $('td:eq(0),td:eq(1)', nRow).addClass( "text-right" );
    },
    columns: [
    { data: 'amount', name: 'amount' },
    { data: 'budget_per_student', name: 'budget_per_student' },
    { data: 'slot_count', name: 'slot_count' },
    { data: 'budget_date', name: 'budget_date'},
    { data: 'action', name: 'action', orderable: false, searchable: false }
    ]
  });
  var url = "/coordinator/budget";
  var id = '';
  $('#add_budget').on('hide.bs.modal', function() {
    $('#frmBudget').trigger("reset");
    $('.form-control').val();
  });
  $('#btn-add').click(function() {
    $('#add_budget').modal('show');
    $('h4').text('Add Budget');
    $('#btn-save').val("add");
  });
  $('#budget-list').on('click', '.btn-view', function() {
    var link_id = $(this).val();
    $.get(url + '/' + link_id, function(data) {
      var date = new Date(data[0].budget_date);
      var modalbody = "<div class='col-xs-12 row'><div class='col-xs-6'><div class='form-group'><label>Budget Amount:</label><br>" + data[0].amount +
      "</div><div class='form-group'><label>Scholar Budget:</label><br>" + data[0].budget_per_student +"</div></div>"+
      "<div class='col-xs-6'>"+
      "<div class='form-group'><label>Date Inputted:</label><br>"
      + date.toLocaleString('en-us', { year: 'numeric', month: 'short', day: '2-digit', hour: '2-digit', minute: '2-digit' }) +
      "</div><div class='form-group'><label>Slot:</label><br>" + data[0].slot_count +
      "</div></div>";
      $.each(data, function(index, value) {
        modalbody += "<div class='col-xs-6'><div class='form-group'><label>"+value.description+" Amount:</label><br>" + value.allocation_amount + "</div></div>"
      });
      modalbody += "</div>";
      bootbox.alert({
        title: 'View Budget',
        message: modalbody,
        backdrop: true,
        buttons: {
          ok: {
            label: 'Ok',
            className: 'btn-success btn-md'
          }
        }
      });
    })
  });
  $('#budget-list').on('click', '.open-modal', function() {
    var link_id = $(this).val();
    id = link_id;
    $.get(url + '/' + link_id + '/edit', function(data) {
      $('#budget_amount').val(data[0].amount);
      $('#budget_per_student').val(data[0].budget_per_student);
      $('#slot_count').val(data[0].slot_count);
      $.each(data, function(index, value){
        $('#id'+value.allocation_id).val(value.allocation_amount);
        $('.allocate').append("<input type='hidden' name='allocation_id[]' value='"+value.allocate_id+"'>");
      });
      $('h4').text('Edit Budget');
      $('#btn-save').val("update");
      $('#add_budget').modal('show');
    });
  });
  $('#budget-list').on('click', '.btn-delete', function() {
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
              getBudget();
              swal({
                title: "Deleted!",
                text: "<center>Data Deleted</center>",
                type: "success",
                timer: 1000,
                showConfirmButton: false,
                html: true
              });
            },
            error: function(data) {
            }
          });
        }
      }, 500);
    });
  });
  $('#budget_amount').blur(function(){
    sum_values();
  });
  var elements = document.getElementsByName("amount[]");
  var element_array = Array.prototype.slice.call(elements);
  for(var i=0; i < element_array.length; i++){
    element_array[i].addEventListener("blur", sum_values);
  }
  function sum_values(){
    var sum = 0;
    for(var i=0; i < element_array.length; i++){
      sum += parseFloat(element_array[i].value, 10);
    }
    $('#budget_per_student').val(sum);
    var txt = $("#budget_per_student");
    if (txt.val().length > 0) {
      var textone;
      var texttwo;
      textone = parseFloat($('#budget_amount').val());
      texttwo = parseFloat($('#budget_per_student').val());
      var result = textone / texttwo;
      $('#slot_count').val(Math.floor(result));
    }
  }
    //create new task / update existing task
    $("#btn-save").click(function() {
      $('#frmBudget').parsley().destroy();
      if ($('#frmBudget').parsley().isValid()) {
        $("#btn-save").attr('disabled', 'disabled');
        setTimeout(function() {
          $("#btn-save").removeAttr('disabled');
        }, 1000);
        var formData = $('#frmBudget').serialize();
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
            $('#add_budget').modal('hide');
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
      }
    });
    function getBudget() {
      $.get(url + '/getlatest', function(data){
        $('.slot').text(data.slot_count);
        $('.budget').text(data.amount);
      });
    }
  });
