$(document).ready(function() {
    var url = '/coordinator/scholar/list';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var table = $('#student-table').DataTable({
        processing: true,
        serverSide: true,
        "columnDefs": [
        { "width": "130px", "targets": 3 },
        { "width": "70px", "targets": 2 },
        { "width": "100px", "targets": 1 }
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
                d.strPersReligion = $('#strPersReligion').val()
            }
        },
        columns: [
        { data: 'strStudName', name: 'strStudName' },
        { data: 'student_status', name: 'student_details.student_status', searchable: false },
        { data: 'checkbox', name: 'users.is_active', searchable: false },
        { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
    var url2 = "/coordinator/list/checkbox";
    $('#student-list').on('change', '#isActive', function() {
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
                console.log(url + '/' + link_id);
                console.log('Error:', data);
            }
        });
    });
    $('#student-list').on('change', '#student_status', function() {
        var link_id =  $(this).attr('selectedbox');
        var thisbox = $(this);
        var formData = {
            student_status : $(this).val()
        }
        $.ajax({
            url: dataurl + '/' + link_id,
            type: "PUT",
            data: formData,
            dataType: 'json',
            success: function(data) {
                Pace.restart();
                if (data.student_status == 'Continuing')
                    thisbox.attr('class', 'btn-xs btn-warning');
                else if (data.student_status == 'Graduated')
                    thisbox.attr('class', 'btn-xs btn-success');
                else
                    thisbox.attr('class', 'btn-xs btn-danger');
            },
            error: function(data) {
                console.log(url + '/' + link_id);
                console.log('Error:', data);
            }
        });
    });
    $('#btn-advSearch').on('click', function(e) {
        table.draw();
        e.preventDefault();
        $('#frmAdv').trigger("reset");
        $('#advanced_search').modal('hide')
    });
    $('#advanced_search').on('hide.bs.modal', function() {
        $('#frmAdv').trigger("reset");
    });
    $('#student-list').on('click', '.open-modal', function() {
        var link_id = $(this).val();
        $('#view_details').modal('show');
    });
    $('#advsearch').click(function() {
        $('#advanced_search').modal('show');
    });
});
