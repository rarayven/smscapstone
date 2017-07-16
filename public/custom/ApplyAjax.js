$(document).ready(function() {
  var selectedBarangay = 0;
  var DistrictName = '';
  var selectedCouncilor = 0;
  var CouncilorName = '';
  var url = "/apply";
  var ctr = 0;
  var checker = 'no';
  var dt = new Date();
  var grade = 1;
  var counter = 1;
  dt.setFullYear(new Date().getFullYear() - 18);
  $('#datepicker').datepicker({
    viewMode: "years",
    endDate: dt,
    autoclose: true,
    format: 'yyyy-mm-dd'
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
    if (ctr != 2) {
      $('.form-navigation .previous').toggle(index > 0);
      var atTheEnd = index >= $sections.length - 1;
      $('.form-navigation .next').toggle(!atTheEnd);
    } else {
      $('.form-navigation .next').toggle();
    }
  }
  function curIndex() {
    return $sections.index($sections.filter('.current'));
  }
  $('.form-navigation .previous').click(function() {
    $('#frmApply').parsley().destroy();
    $('input[type="text"], textarea').removeAttr('placeholder');
    ctr--;
    navigateTo(curIndex() - 1);
    var current_active_step = $(this).parents('.f1').find('.f1-step.active');
    var progress_line = $(this).parents('.f1').find('.f1-progress-line');
    current_active_step.removeClass('active').prev().removeClass('activated').addClass('active');
    bar_progress(progress_line, 'left');
    $(this).prev().fadeIn();
    scroll_to_class($('.f1'), 20);
  });
  $('.form-navigation .next').click(function() {
    var pass = true;
    if ($('.f1').parsley().validate({ group: 'block-' + curIndex() })) {
      if (ctr == 1) {
        if (checker == 'yes') {
          if ($('#strSiblDateFrom').val() >= $('#strSiblDateTo').val()) {
            pass = false;
            alert('Date To Must Not be equal or less than Date From')
          }
        }
      }
      if (ctr == 2) {
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
    if (ctr == 5) {
      var ctr_grade = $('input[name="subject_grade[]"]').length;
      var ctr_organization = $('input[name="strPersOrganization[]"]').length;
      var div = "<div class='form-group'>" +
      "<label>Councilor:</label> " +
      "<h4>" + CouncilorName + "</h4>" +
      "</div>" +
      "<hr>" +
      "<label>Personal Info</label>" +
      "<div class='form-group'>" +
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
      "<div class='container'></div>" +
      "<hr>" +
      "<label class='col-xs-12 row'>Family Background</label>" +
      "<div class='form-group col-md-6 row'>" +
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
      "<div class='form-group col-md-6 row'>" +
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
      "<label class='col-xs-12 row'>Educational Background</label>" +
      "<div class='form-group col-md-6 row'>" +
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
      "<div class='form-group col-md-6 row'>" +
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
      "<label>College</label>" +
      "<div class='form-group'>" +
      "<label>School/University Currently Enrolled In:</label> " +
      "<h4>" + $("select[name='intPersCurrentSchool'] option:selected").text() + "</h4><br>" +
      "<label>Current Course:</label> " +
      "<h4>" + $("select[name='intPersCurrentCourse'] option:selected").text() + "</h4><br>" +
      "</div>" +
      "<div class='form-group'>" +
      "<div class='row'>"
      "<label class='col-md-12'>Grades</label><br>";
      for (var i = 0; i < ctr_grade; i++) {
        if (grade) {
          div += "<div class='col-md-6'><label>Description:</label> " +
          "<h4>" + $('.subject_description')[i].value + "</h4><br></div>" +
          "<div class='col-md-6'><label>Grade:</label> " +
          "<h4>" + $('.subject_grade')[i].value + "</h4><br></div>";
        } else {
          div += "<div class='col-md-4'><label>Description:</label> " +
          "<h4>" + $('.subject_description')[i].value + "</h4><br></div>" +
          "<div class='col-md-4'><label>Units:</label> " +
          "<h4>" + $('.units')[i].value + "</h4><br></div>" +
          "<div class='col-md-4'><label>Grade:</label> " +
          "<h4>" + $('.subject_grade')[i].value + "</h4><br></div>";
        }
      }
      "</div></div>" +
      "<hr>" +
      "<label class='col-xs-12 row'>Name three(3) courses you wish to enroll in and the respective school (in order of your preference):</label>" +
      "<div class='form-group col-md-4 row'>" +
      "<label>School 1:</label> " +
      "<h4>" + $("select[id='school1'] option:selected").text() + "</h4><br>" +
      "<label>Course 1:</label> " +
      "<h4>" + $("select[id='course1'] option:selected").text() + "</h4><br>" +
      "</div>" +
      "<div class='form-group col-md-4 row'>" +
      "<label>School 2:</label> " +
      "<h4>" + $("select[id='school2'] option:selected").text() + "</h4><br>" +
      "<label>Course 2:</label> " +
      "<h4>" + $("select[id='course2'] option:selected").text() + "</h4><br>" +
      "</div>" +
      "<div class='form-group col-md-4 row'>" +
      "<label>School 3:</label> " +
      "<h4>" + $("select[id='school3'] option:selected").text() + "</h4><br>" +
      "<label>Course 3:</label> " +
      "<h4>" + $("select[id='course3'] option:selected").text() + "</h4><br>" +
      "</div>" +
      "<hr>" +
      "<div class='form-group col-md-12'>" +
      "<label>Community Involvement/Affiliation</label><br>";
      for (var i = 0; i < ctr_organization; i++) {
        div += "<label>Organization:</label> " +
        "<h4>" + $('.organization')[i].value + "</h4><br>" +
        "<label>Position:</label> " +
        "<h4>" + $('.position')[i].value + "</h4><br>" +
        "<label>Year of Participation:</label> " +
        "<h4>" + $('.year')[i].value + "</h4><br>";
      }
      div += "<label>Essay:</label> " +
      "<h4><dd>" + $('#essay').val() + "</dd></h4><br>" +
      "</div>";
      $('#summary').empty().append(div);
    }
    if (ctr == 3) {
      selectedBarangay = $('#intBaraID').val();
      $.get(url + '/' + selectedBarangay, function(data) {
        $('#councilor').empty();
        $.each(data, function(index, value) {
          var show = "<div class='col-md-6'>" +
          "<div class='box box-widget councilor widget-user-2 text-center' style='cursor: pointer; background-color: #4A5459; border-style: solid;' value=" + value.id + ">" +
          "<div class='widget-user-header'>" +
          "<div class='widget-user-image'>" +
          "<img class='profile-user-img img-responsive img-square' src='" + asset + "/" + value.picture + "' alt='User Avatar'></div>" +
          "<h3 class='widget-user-username text-widget' id=countxt" + value.id + ">" + value.strCounName + "</h3>" +
          "<h5 class='widget-user-desc slot text-widget'>Slot: 100/100</h5></div></div></div>";
          $('#councilor').append(show);
        });
        $('#intDistID').val(data[0].district_id);
      });
    }
  });
$sections.each(function(index, section) {
  $(section).find(':input').attr('data-parsley-group', 'block-' + index);
});
navigateTo(0);
$('#councilor').on('click', '.councilor', function() {
  selectedCouncilor = $(this).attr('value');
  $('#intCounID').val(selectedCouncilor);
  CouncilorName = $('#countxt' + selectedCouncilor).text();
  $('.form-navigation .next').click();
});
$('input[name="rad"]').on('ifClicked', function(event) {
  if (this.value == "yes") {
    checker = 'yes';
    $("#questionappear").show("slide", { direction: "up" }, 1000);
  } else {
    checker = 'no';
    $("#questionappear").hide();
  }
});
$.each($('input[name="rad"]'), function(index, value) {
  if ($(this).attr('checked'))
    if ($(this).attr('id') == 'yes') {
      checker = 'yes';
      $("#questionappear").show("slide", { direction: "up" }, 1000);
    }
  });
$('input[name="col"]').on('ifClicked', function(event) {
  if (this.value == "no") {
    $("#college").show("slide", { direction: "up" }, 1000);
    grade = 0;
  } else {
    $("#college").hide();
    grade = 1;
  }
  inputGrade();
});
$.each($('input[name="col"]'), function(index, value) {
  if ($(this).attr('checked'))
    if ($(this).attr('id') == 'no') {
      grade = 0;
      $("#college").show("slide", { direction: "up" }, 1000);
    } else {
      $('.academic').toggle();
    }
  });
$('input').iCheck({
  radioClass: 'iradio_flat-red'
});
$("#frmApply").bind("keypress", function(e) {
  if (e.keyCode == 13) {
    $('#btn-next').click();
    return false;
  }
});
$('.btn-submit').on('click', function(e) {
  e.preventDefault();
  swal({
    title: "Are you sure?",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-success",
    confirmButtonText: "Apply",
    cancelButtonText: "Cancel",
    closeOnConfirm: false,
    allowOutsideClick: true,
    showLoaderOnConfirm: true,
    closeOnCancel: true
  },
  function(isConfirm) {
    setTimeout(function() {
      if (isConfirm) {
        $('#frmApply').submit();
      }
    }, 500);
  });
});
$('.affiliation').click(function() {
  var show = "<div class='form-group col-md-6'>" +
  $('.organization')[0].outerHTML + "</div>" +
  "<div class='form-group col-md-3'>" +
  $('.position')[0].outerHTML + "</div>" +
  "<div class='form-group col-md-3'>" +
  "<div class='input-group'>" +
  "<div class='input-group-addon'>" +
  "<i class='fa fa-calendar'></i></div>" + $('.year')[0].outerHTML + "</div></div>";
  $('#affiliation').append(show);
});
$('.grade').click(function() {
  var show = ''
  if (grade) {
    show = "<div class='form-group col-md-6'>" +
    $('.subject_description')[0].outerHTML + "</div>" +
    "<div class='form-group col-md-6'>" +
    $('.subject_grade')[0].outerHTML + "</div>";
  } else {
    show = "<div class='form-group col-md-6'>" +
    $('.subject_description')[0].outerHTML + "</div>" +
    "<div class='form-group col-md-2'>" +
    $('.units')[0].outerHTML + "</div>" +
    "<div class='form-group col-md-4'>" +
    $('.subject_grade')[0].outerHTML + "</div>";
  }
  $('#grade').append(show);
});
$('.barangay').select2();
$('.dropdown').select2();
inputGrade();
function inputGrade() {
  var show = '';
  if (grade) {
    $('.academic').toggle();
    show = "<div class='form-group col-md-6'>" +
    "<label class='control-label'>Description</label>" +
    "<input id='subject_description' class='form-control subject_description' maxlength='45' autocomplete='off' data-parsley-pattern='^[a-zA-Z0-9 ]+$' name='subject_description[]' type='text'></div>" +
    "<div class='form-group col-md-6'>" +
    "<label class='control-label'>Grade</label>" +
    "<input id='subject_grade' class='form-control subject_grade' maxlength='4' autocomplete='off' data-parsley-pattern='^[a-zA-Z0-9. ]+$' name='subject_grade[]' type='text'></div>";
  } else {
    $('.academic').toggle(false);
    show = "<div class='form-group col-md-6'>" +
    "<label class='control-label'>Description</label>" +
    "<input id='subject_description' class='form-control subject_description' maxlength='45' autocomplete='off' data-parsley-pattern='^[a-zA-Z0-9 ]+$' name='subject_description[]' type='text'></div>" +
    "<div class='form-group col-md-2'>" +
    "<label class='control-label'>Units</label>" +
    "<input id='units' class='form-control units' maxlength='1' autocomplete='off' data-parsley-pattern='^[0-9 ]+$' name='units[]' type='text'></div>"+
    "<div class='form-group col-md-4'>" +
    "<label class='control-label'>Grade</label>" +
    "<input id='subject_grade' class='form-control subject_grade' maxlength='4' autocomplete='off' data-parsley-pattern='^[a-zA-Z0-9. ]+$' name='subject_grade[]' type='text'></div>";
  }
  $('#grade').empty().append(show);
}
});