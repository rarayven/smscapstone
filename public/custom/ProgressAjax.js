$(document).ready(function() {
    var url = '/coordinator/progress';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var table = $('#student-table').DataTable({
        processing: true,
        serverSide: true,
        "columnDefs": [
        { "width": "200px", "targets": 2 },
        { "width": "200px", "targets": 1 }
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
        { data: 'strStudName', name: 'strStudName' },
        { data: 'intStepOrder', name: 'steps.order', searchable: false },
        { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
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
    $('#advsearch').click(function() {
        $('#advanced_search').modal('show');
    });
    $('#student-list').on('click', '.btn-progress', function() {
        var link_id = $(this).val();
        var id = $(this).attr('id');
        if (confirm("Are you sure you want to proceed?")) {
            $.ajax({
                url: url + '/' + link_id,
                type: "PUT",
                success: function(data) {
                    console.log(data);
                    var div = "<div id='stat" + data.user_id + "'>Todo: " + data.description + " <div class='pull-right'>" + data.order + "/" + id + "</div></div>";
                    $("#stat" + data.user_id).replaceWith(div);
                    var value = ((data.order / id) * 100);
                    $('#prog' + link_id).css('width', value + '%').attr('aria-valuenow', value);
                    var btn = "<button style='margin-top: 10px;' id" + id + " class='btn btn-warning btn-sm back' value=" +
                    data.user_id + "><i class='fa fa-undo'></i> Undo</button>";
                    if (data.is_steps_done) {
                        $('#dp' + data.user_id).replaceWith(btn);
                        $('#detail' + data.user_id).replaceWith("<td>This student meets the requirements for scholarship. This record will now be remove the progess list</td>");
                        console.log(data.user_id);
                    }
                    console.log(value + "/" + link_id);
                },
                error: function(data) {
                    console.log(url + '/' + link_id);
                    console.log('Error:', data);
                }
            });
        }
    });
    $('#student-list').on('click', '.open-modal', function() {
        var link_id = $(this).val();
        $('#view_details').modal('show');
    });
    $('#student-list').on('click', '.btn-undo', function() {
        var link_id = $(this).val();
        var id = $(this).attr('id');
        if (confirm("Are you sure you want to proceed?")) {
            $.get(url + '/' + link_id, function(data) {
                console.log(data);
                var div = "<div id='stat" + data.user_id + "'>Todo: " + data.description + " <div class='pull-right'>" + data.order + "/" + id + "</div></div>";
                $("#stat" + data.user_id).replaceWith(div);
                var value = ((data.order / id) * 100);
                $('#prog' + link_id).css('width', value + '%').attr('aria-valuenow', value);
            })
        }
    });
    $('#student-list').on('click', '.back', function() {
        var link_id = $(this).val();
        var id = $(this).attr('id');
        if (confirm("Are you sure you want to proceed?")) {
            $.get(url + '/' + link_id + "/edit", function(data) {
                table.draw();
            })
        }
    });
});
