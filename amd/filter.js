// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Display information about all the local_group_generator modules in the requested course.
 *
 * @package    local_group_generator
 * @author      2022 JuanCarlo Castillo <juancarlo.castillo20@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @copyright   2022 JuanCa Castillo & Eurecat.dev
 */
//
// * Javascript
// *


require(['core/first', 'jquery', 'jqueryui', 'core/ajax'], function(_core, $, _bootstrap, _ajax) {
  // -----------------------------
  $(document).ready(function() {

let studentToSave = [];
let valueFilter, valueNameFilter;
let filtertitleblock, valueArray, title, nametowrite;
let yourArray = [],
nameArray = [],
studentarray = [],
idArray = [],
valuestosave = [];
let grupoArray = {};
let $checkonly = '* Check ONLY one value at the time for your filter.';
let $insertfiltername = '* Insert a filter name.';
let $selectcourse = '* Select a Course.';
let $insertat = '* Insert at least one value.';
let $checkone = '* Check one value for your filter.';
let $checkonl = '* Check ONLY one value at the time for your filter.';
let $selectsome = '* Select some students to recive this value .';

// Diferent function to get Values
/**
 * Get a course.
 * @returns {String} idcourse2.
 */
function idcourse2() {
  let idcourse2 = $("#menucursofilter").val();
  return idcourse2;
}

/**
 * Get the value of a name and print on filter name.
 * @param {*} valueNameFilter 
 */
function blocfiltername(valueNameFilter) {
  title = "";
  title = valueNameFilter;
  filtertitleblock = `<label value= "` + valueNameFilter + `" class="fitem_value "> ` + valueNameFilter + `</label>`;
  $('#bloc_filtername_conte').html(`
      <div id="filter_title">`
      + filtertitleblock + `
      <img id="frame_` + valueNameFilter + `" class="trash" src="img/trash.png" alt="bin" >
      </div>
      `);
}

/**
 * Get the values of a values filter and print on filter value.
 * @param {*} valueFilter 
 */
function blocvalueConte(valueFilter) {
  $('#bloc_valueConte').append(`
  <div>
  <input type="checkbox" class="checkboxgroupAdd" 
  name ="name_filter[]" id="box_` + valueFilter + `" value="` + valueFilter + `"/>
  <label value= "` + valueFilter + `" class="fitem_value "> ` + valueFilter + `</label>
  <img id="frame_` + valueFilter + `" class="trash" src="img/trash.png" alt="bin" >
  <br></div>
  `);
}

/**
 * To check student and put it in the end container.
 */
function checkboxadd() {
  yourArray = [];
  if ($('input:checkbox[class = checkboxgroupAdd]:checked').length > 1) {
    $('#result_personal_filter_title').append('<p class="text-danger"><small>'+$checkonly+'</small></p>');
  } else {
    $('input:checkbox[class = checkboxgroupAdd]:checked').each(function() {
      if (!this.disabled) {
        yourArray.push(`<input type="checkbox" class="checkboxgroupremove" name ="valueFilter[]" 
        id="box_` + $(this).val() + `" value="` + $(this).val() + `"/>
          <label value= "` + $(this).val() + `" class="fitem_value "> ` + $(this).val() + `</label>`);
          valueArray = $(this).val();
      }
      $(this).prop("disabled", true);
      $(this).prop("checked", false);
    });
  }
}
/**
 * To check student and put it in the end container.
 */
function checkbox_student_add() {
  nameArray = [];
  nametowrite = [];
  let count = 0;
  $('input:checkbox[class = checkbox_student_add]:checked').each(function() {
    if (!this.disabled) {
      studentarray.push($(this).attr('id'));
      nameArray.push(`<li value= "` + $(this).val() + `" class="fitem_value " 
      id="` + $(this).attr('id') + `"> ` + $(this).val() + ` </li>`);
      nametowrite[count] = $(this).val();
      count++;
    }
    $(this).prop("disabled", true);
    $(this).prop("checked", false);
  });
}

$('#save_personal_filter').hide();
$('#refresh_personal_filter').hide();

$('#type_name_filter').on('keypress', function(e) {
  valueNameFilter = $('#type_name_filter').val();
  title = valueNameFilter;
  if (e.which == 13) {
    blocfiltername(valueNameFilter);
    this.value = '';
    $('#frame_' + valueNameFilter).click(function() {
      let daddy = $('#frame_' + valueNameFilter).parent();
      daddy.remove();
    });
  } else if (e.which == 9) {
    blocfiltername(valueNameFilter);
    this.value = '';
    $('#frame_' + valueNameFilter).click(function() {
      let daddy = $('#frame_' + valueNameFilter).parent();
      daddy.remove();
    });
  }
});

$('#type_value_filter').on('keypress', function(e) {

    if (e.which == 13) {

      valueFilter = $('#type_value_filter').val();

      blocvalueConte(valueFilter);
      this.value = '';
      $('#frame_' + valueFilter).on('click', function() {
        $(this).parent();
        let daddy = $(this).parent();
        daddy.remove();
      });
    }
});

$('#menucursofilter').change(function() {
  let idcourse = idcourse2();

  if ($("#menucursofilter").val() == '' || $("#menucursofilter").val() == undefined) {
    $('#table_personalFilter').hide();
  } else {
    $('#table_personalFilter').show();
  }

  $.ajax({
    data: {idcourse},
    url: 'classes/course/getstudentsnogroup.php',
    success: function(response) {
      $('.fitem3').remove();
      const element = $.parseJSON(response);
      $.each(element, function(item, value) {

      $('#bloc_studentConte').append(`
            <div id="fitem_id_` + value.id + `" class="fitem3">
                  <input type="checkbox" class="checkbox_student_add" id="` + value.id + `" value="` + value.name + `"/> 
                  <label for="` + value.id + `">` + value.name + `</label> 
            </div>
      `);

      });
    }
  });
});


$('#add_button').click(function() {

  $('#result_personal_filter_title').html('');
  if (validationpersonalfilter() == true) {

    checkboxadd();
    checkbox_student_add();

    $('#result_personal_filter_title').html(`<p style="color : grey;">` + filtertitleblock + `</p>`);
    if (yourArray != []) {
      $('#result_personal_filter_list').append(`
      <ul>
        <li><strong>` + yourArray + `</strong>
          <ul>`
          + nameArray.join('') +
          `</ul>
        </li>
      </ul>`);
    }

    yourArray = [];
    grupoArray[valueArray] = studentarray;
    studentarray = [];
    valueArray = '';
    $('#result_personal_filter').show();
    $('#save_personal_filter').show();
    $('#refresh_personal_filter').show();
  }

});

$('#remove_button').click(function() {
  $('input:checkbox[class = checkboxgroupremove]:checked').each(function() {
    idArray.push($(this).attr('id'));

    let box = $(this).attr('id');
    box = box.substr(4);
    let uncheckarray = grupoArray[box];

    uncheckarray.forEach(function(element) {
      $("#" + element + "").attr("disabled", false);
      $("#" + element + "").prop("checked", true);
    });

    idArray.forEach(function(element) {
      $("#" + element + "").attr("disabled", false);
      $("#" + element + "").prop("checked", true);
    });

    let daddy = $(this).parent().parent().parent();
    daddy.remove();
  });
});


$('#refresh_personal_filter').click(function() {
  resetform2();
});


$('#save_personal_filter').click(function() {
    for (var key1 in grupoArray) {
      valuestosave.push([key1]);
    }
    for (const property in grupoArray) {
      studentToSave.push([`${grupoArray[property]}`]);
    }

    studentToSave = JSON.stringify(studentToSave);
    valuestosave = JSON.stringify(valuestosave);
    grupoArray = JSON.stringify(grupoArray);
    console.log(valuestosave)
    $.ajax({
      data: {title, idcourse2: idcourse2(), values: valuestosave, students: studentToSave},
      url: 'classes/filter/savefilter.php',
      success:  function() {
        window.location.reload();
      }
    });
});

/**
 * Validation fields.
 * @returns {Boolean}
 */
function validationpersonalfilter() {
  $('.valifilterclass').html('');

  valueNameFilter = $('#type_name_filter').val();

  if (filtertitleblock == '' || filtertitleblock === null || filtertitleblock == undefined) {
    $('#valinamefilterContainer').append('<p class="text-danger"><small>'+$insertfiltername+'</small></p>');
    return false;
  }
  if (idcourse2() == '' || idcourse2() === null || idcourse2() == undefined) {
    $('#valiseleccourseContainer').append('<p class="text-danger"><small>'+$selectcourse+'</small></p>');
    return false;
  }
  if ($('#bloc_valueConte').children().length < 1) {
    $('#valivaluefilterContainer').append('<p class="text-danger"><small>'+$insertat+'</small></p>');
    return false;
  }
  if ($('input:checkbox[class = checkboxgroupAdd]:checked').length == 0) {
    $('#result_personal_filter_title').append('<p class="text-danger"><small>'+$checkone+'</small></p>');
    return false;
  }
  if ($('input:checkbox[class = checkboxgroupAdd]:checked').length > 1) {
    $('#result_personal_filter_title').append('<p class="text-danger"><small>'+$checkonl+'</small></p>');
    return false;
  }
  if (yourArray.length > 1) {
    $('#result_personal_filter_title').append('<p class="text-danger"><small>'+$checkonl+'</small></p>');
    return false;
  }
  if ($('input:checkbox[class = checkbox_student_add]:checked').length == 0) {
    $('#result_personal_filter_title').append('<p class="text-danger"><small>'+$selectsome+'</small></p>');
    return false;
  }
  return true;
}

/**
 * Reset values.
 */
function resetform2() {
  $('#filter_title').html('');
  $('#bloc_valueConte').html('');
  $('#bloc_studentConte').html('');
  $('#result_personal_filter_title').html('');
  $('#result_personal_filter_list').html('');
  $('#menucursofilter').prop('selectedIndex', 0);
  $('#result_personal_filter').hide();
  grupoArray = {};
  $('#save_personal_filter').hide();
  $('#refresh_personal_filter').hide();
  studentToSave = [];
  filtertitleblock = '';
}

  });
});

