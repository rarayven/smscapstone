$(document).ready(function(){
    var url = '/coordinator/scholar/list';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    })
    var table = $('#student-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            type: 'POST',
            url: dataurl,
            data: function (d) {
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
        {data: 'strStudName', name: 'strStudName'},
        {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
        {data: 'forfeit', name: 'forfeit', orderable: false, searchable: false},
        {data: 'graduated', name: 'graduated', orderable: false, searchable: false},
        {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
    $('#btn-advSearch').on('click', function(e) {
        table.draw();
        e.preventDefault();
        $('#frmAdv').trigger("reset");
        $('#advanced_search').modal('hide')
    });
    $('#advanced_search').on('hide.bs.modal', function(){
        $('#frmAdv').trigger("reset");
    });
    $('#student-list').on('click', '.open-modal',function(){ 
        var link_id = $(this).val();
        $('#view_details').modal('show');
    });
    $('#advsearch').click(function(){
        $('#advanced_search').modal('show');
    });
});