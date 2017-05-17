$(document).ready(function(){
   $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
})
   var url = "/admin/maintenance/councilor";
   var id='';
   var url2 = "/admin/maintenance/councilor/checkbox";
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
    {data: 'strCounName', name: 'strCounName'},
    {data: 'district_description', name: 'tblDistrict.strDistDesc'},
    {data: 'isActive', name: 'isActive', searchable: false},
    {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
});
   $('#add_councilor').on('hide.bs.modal', function(){
    $('#frmCouncilor').parsley().destroy();
    $('#frmCouncilor').trigger("reset");
});
   $('#councilor-list').on('change', '#isActive',function(){ 
       var link_id = $(this).val();
       $.ajax({
        url: url2 + '/' + link_id,
        type: "PUT",
        success: function (data) {
            console.log(data);
            if(data=="Deleted"){
                refresh();
            }
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
   });
   function refresh(){
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
    $('#councilor-list').on('click', '.open-modal',function(){ 
        var link_id = $(this).val();
        id = link_id;
        $.get(url + '/' + link_id + '/edit', function (data) {
            console.log(data);
            if(data=="Deleted"){
                refresh();
            }else{
                var textToFind = data.strDistDesc;
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
    $('#councilor-list').on('click', '.btn-view',function(){ 
        var link_id = $(this).val();
        $.get(url + '/' + link_id, function (data) {
            if(data=="Deleted"){
                refresh();
            }else{
                console.log(data);
                $('#details').empty();
                var modalbody = 
                "<label>ID</label><br>"+ data.id +
                "<br><label>District</label><br>"+ data.district_description +
                "<br><label>Name</label><br>"+ data.last_name + ", " + data.first_name + " " +data.middle_name+
                "<br><label>Email</label><br>"+ data.email +
                "<br><label>Contact Number</label><br>"+ data.cell_no;
                $('h4').text('View Councilor');
                $('#details').append(modalbody);
                $('#details_councilor').modal('show');
            }
        })
    });
    //display modal form for creating new task
    $('#btn-add').click(function(){
        $('h4').text('Add Councilor');
        $('#btn-save').val("add");
        $('#frmCouncilor').trigger("reset");
        $('#add_councilor').modal('show');
    });
    //delete task and remove it from list
    $('#councilor-list').on('click', '.btn-delete',function(){ 
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
    setTimeout(function () {
      if (isConfirm) {
        $.ajax({
          url: url + '/' + link_id,
          type: "DELETE",
          success: function (data) {
            console.log(data);
            if(data=="Deleted"){
                refresh();
            }else{
                if(data[0]=="true"){
                  swal({
                    title: "Failed!",
                    text: "<center>"+data[1].last_name+" is in use</center>",
                    type: "error",
                    showConfirmButton: false,
                    allowOutsideClick: true,
                    html: true
                });
              }else{
                  table.draw();
                  swal({
                    title: "Deleted!",
                    text: "<center>"+data.last_name+", "+data.first_name+" "+data.middle_name+" is Deleted</center>",
                    type: "success",
                    timer: 1000,
                    showConfirmButton: false,
                    html: true
                });
              }
          }
      },
      error: function (data) {
        console.log(data);
    }
});
    }
}, 500);
});
 });
    //create new task / update existing task
    xhrPool = [];
    $("#btn-save").click(function () {
      $('#frmCouncilor').parsley().destroy();
      if($('#frmCouncilor').parsley().isValid())
      {
        $("#btn-save").attr('disabled','disabled');
        setTimeout(function(){
            $("#btn-save").removeAttr('disabled');
        }, 1000);
        var formData = {
            strCounFirstName: $('#strCounFirstName').parsley('data-parsley-whitespace','squish').getValue(),
            strCounMiddleName: $('#strCounMiddleName').parsley('data-parsley-whitespace','squish').getValue(),
            strCounLastName: $('#strCounLastName').parsley('data-parsley-whitespace','squish').getValue(),
            intCounDistID: $('#intCounDistID').val(),
            strCounEmail: $('#strCounEmail').parsley('data-parsley-whitespace','squish').getValue(),
            strCounCell: $('#strCounCell').parsley('data-parsley-whitespace','squish').getValue(),
            strUserEmail: $('#strUserEmail').parsley('data-parsley-whitespace','squish').getValue()
        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save').val();
        var type = "POST"; //for creating new resource
        var my_url = url;
        if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url += '/' + id;
        }
        $.ajax({
            beforeSend: function (jqXHR, settings) {
                xhrPool.push(jqXHR);
            },
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                if(data==1){
                    $('#strCounFirstName').parsley().removeError('ferror', {updateClass: false});
                    $('#strCounFirstName').parsley().addError('ferror', {message: "The Combination of Name Exists", updateClass: false});
                    $('#strCounMiddleName').parsley().removeError('ferror', {updateClass: false});
                    $('#strCounMiddleName').parsley().addError('ferror', {message: "The Combination of Name Exists", updateClass: false});
                    $('#strCounLastName').parsley().removeError('ferror', {updateClass: false});
                    $('#strCounLastName').parsley().addError('ferror', {message: "The Combination of Name Exists", updateClass: false});
                }else if(data==2){
                    $('#strCounEmail').parsley().removeError('ferror', {updateClass: false});
                    $('#strCounEmail').parsley().addError('ferror', {message: "This Data Already Exists", updateClass: false});
                }else if(data==3){
                    $('#strUserEmail').parsley().removeError('ferror', {updateClass: false});
                    $('#strUserEmail').parsley().addError('ferror', {message: "This Data Already Exists", updateClass: false});
                }
                else{
                    $('#add_councilor').modal('hide');
                    table.draw();
                    swal({
                        title: "Success!",
                        text: "<center>"+data.last_name+", "+data.first_name+" "+data.middle_name+" is Stored</center>",
                        type: "success",
                        timer: 1000,
                        showConfirmButton: false,
                        html: true
                    });
                }
            },
            error: function (data) {
                console.log('Error:', data.responseText);
                try{
                    $('#strCounLastName').parsley().removeError('ferror', {updateClass: false});
                    $('#strCounLastName').parsley().addError('ferror', {message: data.responseText, updateClass: false});
                }catch(err){}
                finally{
                    $.each(xhrPool, function(idx, jqXHR) {
                        jqXHR.abort();
                    });
                }
            }
        });
    }
});
});