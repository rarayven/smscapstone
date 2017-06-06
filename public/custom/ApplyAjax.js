$(document).ready(function() {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var selectedDistrict = 0;
  var DistrictName = '';
  var selectedCouncilor = 0;
  var CouncilorName = '';
  var url = "/apply";
  var ctr = 0;
  var dt = new Date();
  var counter = 1;
  var table = $('#grade-table').DataTable({
    "paging": false,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": false,
    "autoWidth": false,
    'rowId': 0,
    "columnDefs": [{
      "targets": [0],
      "visible": false
    }]
  });
  dt.setFullYear(new Date().getFullYear() - 18);
  $('#datepicker').datepicker({
    viewMode: "years",
    endDate: dt,
    autoclose: true,
    format: 'yyyy-mm-dd'
  });
  $('input[type="text"], textarea').on('blur', function(event) {
    var $this = $(this),
    val = $this.val();
    val = val.substr(0, 1).toUpperCase() + val.substr(1).toLowerCase();
    $this.val(val);
  });
  window.Parsley.on('field:error', function(fieldInstance) {
    if (fieldInstance.$element[0].type == 'file') {
      var instanceName;
      if (fieldInstance.$element[0].name == 'strApplPicture') {
        instanceName = $('.images');
      } else {
        instanceName = $('.pdf');
      }
      instanceName.popover({
        trigger: 'manual',
        container: 'body',
        placement: 'auto',
        content: function() {
          return fieldInstance.getErrorsMessages().join(';');
        }
      }).popover('show');
    } else if (fieldInstance.$element[0].type == 'textarea') {
      fieldInstance.$element.popover({
        trigger: 'manual',
        container: 'body',
        placement: 'auto',
        content: function() {
          return fieldInstance.getErrorsMessages().join(';');
        }
      }).popover('show');
    } else {
      fieldInstance.$element.val('');
      fieldInstance.$element.attr('placeholder', fieldInstance.getErrorsMessages().join(';'));
    }
  });
  window.Parsley.on('field:success', function(fieldInstance) {
    if (fieldInstance.$element[0].type == 'file') {
      var instanceName;
      if (fieldInstance.$element[0].name == 'strApplPicture') {
        instanceName = $('.images');
      } else {
        instanceName = $('.pdf');
      }
      instanceName.popover('destroy');
    } else if (fieldInstance.$element[0].type == 'textarea') {
      fieldInstance.$element.popover('destroy');
    }
    fieldInstance.$element.removeAttr('placeholder');
  });

  function scroll_to_class(element_class, removed_height) {
    var scroll_to = $(element_class).offset().top - removed_height;
    if ($(window).scrollTop() != scroll_to) {
      $('html, body').stop().animate({ scrollTop: scroll_to }, 0);
    }
  }

  function bar_progress(progress_line_object, direction) {
    var number_of_steps = progress_line_object.data('number-of-steps');
    var now_value = progress_line_object.data('now-value');
    var new_value = 0;
    if (direction == 'right') {
      new_value = now_value + (100 / number_of_steps);
    } else if (direction == 'left') {
      new_value = now_value - (100 / number_of_steps);
    }
    progress_line_object.attr('style', 'width: ' + new_value + '%;').data('now-value', new_value);
  }
  var $sections = $('.form-section');
  $.backstretch("../../img/backgrounds/1apply.jpg");
  $('.f1 .form-section:first').fadeIn('slow');
  scroll_to_class($('.f1'), 20);

  function navigateTo(index) {
    $sections
    .removeClass('current')
    .eq(index)
    .addClass('current');
    $('.form-navigation .previous').toggle(index > 0);
    var atTheEnd = index >= $sections.length - 1;
    if (!atTheEnd) {
      $('.form-navigation .next').toggle(index > 1);
    } else {
      $('.form-navigation .next').toggle(!atTheEnd);
    }
  }

  function curIndex() {
    return $sections.index($sections.filter('.current'));
  }
  $('.form-navigation .previous').click(function() {
    $('#frmApply').parsley().destroy();
    $('input[type="text"], textarea').removeAttr('placeholder');
    navigateTo(curIndex() - 1);
    var current_active_step = $(this).parents('.f1').find('.f1-step.active');
    var progress_line = $(this).parents('.f1').find('.f1-progress-line');
    current_active_step.removeClass('active').prev().removeClass('activated').addClass('active');
    bar_progress(progress_line, 'left');
    $(this).prev().fadeIn();
    scroll_to_class($('.f1'), 20);
    ctr--;
  });
  $('.form-navigation .next').click(function() {
    var pass = true;
    if ($('.f1').parsley().validate({ group: 'block-' + curIndex() })) {
      if (ctr == 3) {
        if (checker == 'yes') {
          if ($('#strSiblDateFrom').val() >= $('#strSiblDateTo').val()) {
            pass = false;
            alert('Date To Must Not be equal or less than Date From')
          }
        }
      }
      if (ctr == 4) {
        var concat1 = $('#school1').val() + "" + $('#course1').val();
        var concat2 = $('#school2').val() + "" + $('#course2').val();
        var concat3 = $('#school3').val() + "" + $('#course3').val();
        if ($('#elemenrolled').val() >= $('#elemgrad').val()) {
          pass = false;
          alert('Elem Enrolled Must Not be equal or less than Graduate')
        } else if ($('#hsenrolled').val() >= $('#hsgrad').val()) {
          pass = false;
          alert('HS Enrolled Must Not be equal or less than Date Graduate')
        } else if (concat1 == concat2) {
          pass = false;
          alert('The value of First and Second School and Course Must Not be the Same ');
        } else if (concat2 == concat3) {
          pass = false;
          alert('The value of Second and Third School and Course Must Not be the Same ');
        } else if (concat3 == concat1) {
          pass = false;
          alert('The value of First and Third School and Course Must Not be the Same ');
        }
      }
      if (pass) {
        navigateTo(curIndex() + 1);
        var current_active_step = $(this).parents('.f1').find('.f1-step.active');
        var progress_line = $(this).parents('.f1').find('.f1-progress-line');
        current_active_step.removeClass('active').addClass('activated').next().addClass('active');
        bar_progress(progress_line, 'right');
        $(this).next().fadeIn();
        scroll_to_class($('.f1'), 20);
        ctr++;
      }
    }
    if (ctr == 6) {
      var div = "<div class='form-group container'>" +
      "<label>Councilor:</label> " +
      "<h4>" + CouncilorName + "</h4>" +
      "</div>" +
      "<hr>" +
      "<label class='container'>Personal Info</label>" +
      "<div class='form-group container'>" +
      "<label>Applicant's Name:</label> <h4>" + $('#fname').val() + " " + $('#mname').val() + " " + $('#lname').val() + "</h4><br>" +
      "<label>Gender:</label> <h4>" + $("select[name='PersGender'] option:selected").text() + "</h4><br>" +
      "<label>Birth Date:</label> <h4>" + $('#datepicker').val() + "</h4><br>" +
      "<label>Place of Birth:</label> <h4>" + $('#pob').val() + "</h4><br>" +
      "<label>Religion:</label> <h4>" + $('#strPersReligion').val() + "</h4><br>" +
      "<label>Address:</label> <h4>" + $('#strApplHouseNo').val() + " " +
      $('#stname').val() + " " +
      $("select[name='intBaraID'] option:selected").text() + " " + DistrictName +
      "</h4><br>" +
      "<label>Mobile Number:</label> <h4>" + $('#strUserCell').val() + "</h4><br>" +
      "<label>Email Address:</label> <h4>" + $('#email').val() + "</h4><br>" +
      "</div>" +
      "<hr>" +
      "<label class='container'>Family Background</label>" +
      "<div class='form-group col-md-6'>" +
      "<label>Mother's Name:</label> <h4>" + $('#motherfname').val() + " " + $('#motherlname').val() + "</h4><br>" +
      "<label>Citizenship:</label> <h4>" + $('#mothercitizen').val() + "</h4><br>" +
      "<label>Highest Attainment:</label> <h4>" + $('#motherhea').val() + "</h4><br>" +
      "<label>Occupation:</label> <h4>" + $('#motheroccupation').val() + "</h4><br>" +
      "<label>Monthly Income:</label> <h4>" +
      $("select[name='motherincome'] option:selected").text() +
      "</h4><br>" +
      "<label>Number of Brother/s:</label> <h4>" + $('#brono').val() + "</h4><br>" +
      "<label>Number of Sister/s:</label> <h4>" + $('#sisno').val() + "</h4><br>" +
      "</div>" +
      "<div class='form-group col-md-6'>" +
      "<label>Father's Name:</label> <h4>" + $('#fatherfname').val() + " " + $('#fatherlname').val() + "</h4><br>" +
      "<label>Citizenship:</label> <h4>" + $('#fathercitizen').val() + "</h4><br>" +
      "<label>Highest Attainment:</label> <h4>" + $('#fatherhea').val() + "</h4><br>" +
      "<label>Occupation:</label> <h4>" + $('#fatheroccupation').val() + "</h4><br>" +
      "<label>Monthly Income:</label> <h4>" +
      $("select[name='fatherincome'] option:selected").text() +
      "</h4><br>" +
      "<label>Sibling's Name:</label> <h4>" + $('#strSiblFirstName').val() + " " + $('#strSiblLastName').val() + "</h4><br>" +
      "<label>Date Joined:</label> <h4>From: " + $('#strSiblDateFrom').val() + " To: " + $('#strSiblDateTo').val() + "</h4><br>" +
      "</div>" +
      "<div class='container'></div>" +
      "<hr>" +
      "<label class='container'>Educational Background</label>" +
      "<div class='form-group col-md-6'>" +
      "<label>Elementary</label><br>" +
      "<label>School Name:</label> " +
      "<h4>" + $('#elemschool').val() + "</h4><br>" +
      "<label>Year Enrolled:</label> " +
      "<h4>" + $('#elemenrolled').val() + "</h4><br>" +
      "<label>Year Graduated:</label> " +
      "<h4>" + $('#elemgrad').val() + "</h4><br>" +
      "<label>Achievements/Honors:</label> " +
      "<h4>" + $('#elemhonors').val() + "</h4><br>" +
      "</div>" +
      "<div class='form-group col-md-6'>" +
      "<label>High School</label><br>" +
      "<label>School Name:</label> " +
      "<h4>" + $('#hschool').val() + "</h4><br>" +
      "<label>Year Enrolled:</label> " +
      "<h4>" + $('#hsenrolled').val() + "</h4><br>" +
      "<label>Year Graduated:</label> " +
      "<h4>" + $('#hsgrad').val() + "</h4><br>" +
      "<label>Achievements/Honors:</label> " +
      "<h4>" + $('#hshonor').val() + "</h4><br>" +
      "</div>" +
      "<div class='container'></div>" +
      "<hr>" +
      "<label class='container'>College</label>" +
      "<div class='form-group container'>" +
      "<label>School/University Currently Enrolled In:</label> " +
      "<h4>" + $("select[name='intPersCurrentSchool'] option:selected").text() + "</h4><br>" +
      "<label>Current Course:</label> " +
      "<h4>" + $("select[name='intPersCurrentCourse'] option:selected").text() + "</h4><br>" +
      "<label>GWA:</label> " +
      "<h4>" + $('#strPersGwa').val() + "</h4><br>" +
      "</div>" +
      "<hr>" +
      "<label class='container'>Name three(3) courses you wish to enroll in and the respective school (in order of your preference):</label>" +
      "<div class='form-group col-md-4'>" +
      "<label>School 1:</label> " +
      "<h4>" + $("select[name='school1'] option:selected").text() + "</h4><br>" +
      "<label>Course 1:</label> " +
      "<h4>" + $("select[name='course1'] option:selected").text() + "</h4><br>" +
      "</div>" +
      "<div class='form-group col-md-4'>" +
      "<label>School 2:</label> " +
      "<h4>" + $("select[name='school2'] option:selected").text() + "</h4><br>" +
      "<label>Course 2:</label> " +
      "<h4>" + $("select[name='course2'] option:selected").text() + "</h4><br>" +
      "</div>" +
      "<div class='form-group col-md-4'>" +
      "<label>School 3:</label> " +
      "<h4>" + $("select[name='school3'] option:selected").text() + "</h4><br>" +
      "<label>Course 3:</label> " +
      "<h4>" + $("select[name='course3'] option:selected").text() + "</h4><br>" +
      "</div>" +
      "<div class='container'></div>" +
      "<hr>" +
      "<div class='form-group container'>" +
      "<label>Community Involvement/Affiliation</label><br>" +
      "<label>Organization:</label> " +
      "<h4>" + $('#organization').val() + "</h4><br>" +
      "<label>Position:</label> " +
      "<h4>" + $('#position').val() + "</h4><br>" +
      "<label>Year of Participation:</label> " +
      "<h4>" + $('#dateofparticipation').val() + "</h4><br>" +
      "<label>First Answer in Essay:</label> " +
      "<h4>" + $('#strPersEssay').val() + "</h4><br>" +
      "<label>Second Answer in Essay:</label> " +
      "<h4>" + $('#strPersEssay2').val() + "</h4><br>" +
      "</div>";
      $('#summary').replaceWith(div);
    }
  });
$sections.each(function(index, section) {
  $(section).find(':input').attr('data-parsley-group', 'block-' + index);
});
navigateTo(0);
var checker = 'no';
$('input[name="rad"]').on('ifClicked', function(event) {
  if (this.value == "yes") {
    checker = 'yes';
    $("#questionappear").show("slide", { direction: "up" }, 1000);
  } else {
    checker = 'no';
    $("#questionappear").hide();
  }
});
$('input[name="col"]').on('ifClicked', function(event) {
  if (this.value == "no") {
    $("#college").show("slide", { direction: "up" }, 1000);
  } else {
    $("#college").hide();
  }
});
$('input').iCheck({
  radioClass: 'iradio_flat-red'
});
$('#councilor').on('click', '.councilor', function() {
  selectedCouncilor = $(this).attr('value');
  $('#intCounID').val(selectedCouncilor);
  CouncilorName = $('#countxt' + selectedCouncilor).text();
  $('.form-navigation .next').click();
});
$('.district').on('click', function() {
  selectedDistrict = $(this).attr('value');
  $('#intDistID').val(selectedDistrict);
  DistrictName = $('#txt' + selectedDistrict).text();
  $.get(url + '/' + selectedDistrict + '/edit', function(data) {
    $('#councilor').empty();
    $.each(data, function(index, value) {
      var show = "<div class='col-md-4'>" +
      "<div class='box box-widget councilor widget-user-2 text-center' style='cursor: pointer; background-color: #FF9376; border-style: solid;' value=" + value.id + ">" +
      "<div class='widget-user-header'>" +
      "<h1 id=countxt" + value.id + ">" + value.last_name + ", " + value.first_name + " " + value.middle_name + "</h1>" +
      "</div></div></div>";
      $('#councilor').append(show);
    });
  })
  $.get(url + '/' + selectedDistrict, function(data) {
    $('#intBaraID').empty();
    $.each(data, function(index, value) {
      $('#intBaraID').append("<option value=" + value.id + ">" + value.description + "</option>");
    });
  })
  $('.form-navigation .next').click();
});
$("#datemask2").inputmask("mm/dd/yyyy", { "placeholder": "mm/dd/yyyy" });
$("#frmApply").bind("keypress", function(e) {
  if (e.keyCode == 13) {
    $('#btn-next').click();
    return false;
  }
});
$('#intPersCurrentSchool').on('change', function() {
  var link_id = $(this).val();
  $.ajax({
    url: url + '/' + link_id,
    type: "DELETE",
    success: function(data) {
      $('#strSystDesc').val(data.strSystDesc);
      $('#view').val(data.intSystID);
    },
    error: function(data) {
      console.log('Error:', data);
    }
  });
});
$('#view').on('click', function() {
  var link_id = $(this).val();
  if (link_id == 0) {
    alert('No School Selected');
  } else {
    $.ajax({
      url: url + '/' + link_id,
      type: "PUT",
      success: function(data) {
        var details = "<label>Grade Description</label>" +
        "<p>" + data.strSystDesc + "</p>" +
        "<label>Highest Grade</label>" +
        "<p>" + data.strSystHighGrade + "</p>" +
        "<label>Lowest Grade</label>" +
        "<p>" + data.strSystLowGrade + "</p>" +
        "<label>Failing Grade</label>" +
        "<p>" + data.strSystFailGrade + "</p>";
        $('#details_system').replaceWith(details);
        $('#details_grade').modal('show');
      },
      error: function(data) {
        console.log('Error:', data);
      }
    });
  }
});
$('#btn-add').on('click', function() {
  $('#grade_input').modal('show');
});
$('#grade_input').on('hide.bs.modal', function() {
  $('#frmGrade').trigger("reset");
  $('#frmGrade').parsley().destroy();
});
$('#details_grade').on('hide.bs.modal', function() {});
$('#btn-grade').on('click', function(e) {
  if ($('#frmGrade').parsley().isValid()) {
    $('#frmGrade').parsley().destroy()
    $.notify({
      message: 'Success!'
    }, {
      type: 'success',
      z_index: 2000,
      delay: 1000,
    });
    e.preventDefault();
    table.row.add([
      counter,
      $('#strStudSubjCode').val(),
      $('#strStudSubjDesc').val(),
      $('#intStudSubjUnit').val(),
      $('#strStudGrade').val(),
      "<button type='button' class='btn btn-warning btn-xs btn-detail open-modal'" +
      "value=" + counter + "><i class='fa fa-edit'></i> Edit</button> " +
      "<button type='button' class='btn btn-danger btn-xs btn-delete' value=" + counter + ">" +
      "<i class='fa fa-trash-o'></i> Delete</button>"
      ]).draw();
    counter++;
    $('#frmGrade').trigger('reset');
    $('#strStudSubjCode').focus();
  }
});
$('#grade-list').on('click', '.btn-delete', function() {
  table.row('#' + $(this).val()).remove().draw();
});
});
