$(document).ready(function() {
  var url = "/coordinator/services/budget";
  $("#btn-save").click(function(e) {
    if ($('#frmBudget').parsley().isValid()) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      e.preventDefault();
      var formData = {
        intAlloCoorID: $('#intAlloCoorID').val(),
        dblAlloBudgetAmount: $('#dblAlloBudgetAmount').val(),
        intAlloSlotsNumber: $('#result').val(),
        dblAlloStudAllowance: $('#dblAlloStudAllowance').val(),
        dblAlloStudTuition: $('#dblAlloStudTuition').val()
      }
      var type = "POST";
      var my_url = url;
      $.ajax({
        type: type,
        url: my_url,
        data: formData,
        dataType: 'json',
        success: function(data) {
          var row = "<tr id='id" + data.intAlloID + "'>" +
          "<td>" + data.intAlloID + "</td>" +
          "<td>" + data.dblAlloBudgetAmount + "</td>" +
          "<td>" + data.intAlloSlotsNumber + "</td>" +
          "<td>" + data.dblAlloStudTuition + "</td>" +
          "<td>" + data.dblAlloStudAllowance + "</td>" +
          "<td>" + data.dtmAlloBudgDate.date + "</td>" +
          "</tr>";
          $('#budget-list').append(row);
          $('#frmBudget').trigger("reset");
          $('#add_budget').modal('hide')
        },
        error: function(data) {
        }
      });
    }
  });
  $('#add_budget').on('hide.bs.modal', function() {
    $('#frmBudget').trigger("reset");
  });
  $('#btn-add').click(function() {
    $('#add_budget').modal('show');
  });
  $('#txtPerStudent').keyup(function() {
    var txt = $("#txtPerStudent");
    if (txt.val().length > 0) {
      var textone;
      var texttwo;
      textone = parseFloat($('#dblAlloBudgetAmount').val());
      texttwo = parseFloat($('#txtPerStudent').val());
      var result = textone / texttwo;
      $('#result').val(Math.floor(result));
    }
  });
  $('#dblAlloStudAllowance').keyup(function() {
    var txt = $("#dblAlloStudAllowance");
    if (txt.val().length > 0) {
      var textone;
      var texttwo;
      textone = parseFloat($('#dblAlloStudAllowance').val());
      texttwo = parseFloat($('#txtPerStudent').val());
      var result = texttwo - textone;
      if (result >= 0) {
        $('#dblAlloStudTuition').val(Math.floor(result));
      } else {
        $('#dblAlloStudTuition').val(0);
      }
    }
  });
});
