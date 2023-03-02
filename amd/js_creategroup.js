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
 * @package     local_group_generator
 * @author      2022 JuanCarlo Castillo <juancarlo.castillo20@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @copyright   2022 JuanCa Castillo & Eurecat.dev
 * @since       3.11
 */


require(['core/first', 'jquery', 'jqueryui', 'core/ajax'], function(_core, $) {
$(document).ready(function() {

// ****** String variable - To make a diferent this will start with $ caracter

let $processing = 'Processing, please hold...';
let $choose = 'Choose...';
let $allstudents = 'All students';
let $nostudent = 'No students here';
let $nofilter = 'No personal filter ';
let $nbsp = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
let $coursecompleted = $nbsp + 'Course completed';
let $meangrade = $nbsp + 'Mean grade';
let $cFilter = 'Course Filter';
let $pFilter = 'Personal Filter';
let $cCompleted = 'Course Completed';
let $mGrade = 'Mean grade';
let filter = '';
// eslint-disable-next-line no-unused-vars
let personalfilter = [];

$('#save_button').hide();
$('#managedelcontainer').hide();

let idarray = [];
let idarrayuser = [],
  history = {};
let historySt = '',
  tandemvalue = '',
  personalfiltervalue = '',
  personalfilterstudent = '';
let homogenic = -1,
  threshold = 0;
let togglevalue,
name,
arraysplitgroups,
groupcourse,
tandem,
extraida,
extraida2;
let valueFilterId,
valueFilterName,
historySave;
let valuenametitle;


/**
 * To choose a course and get the value.
 * @returns {Int} idgroup.
 */
function idgroup() {
  let idgroup = $('#menuformato').val();
  if ((idgroup === null) || (!idgroup) || (idgroup == 0) || (idgroup == undefined)) {
    idgroup = 0;
  }
  return idgroup;
}

/**
 * To choose a filter and get the value.
 * @returns {int} idfilter.
 */
function idfilter() {
  let idfilter = $('#menupersonal_filter').val();
  if ((idfilter === null) || (!idfilter) || (idfilter == 0) || (idfilter == undefined)) {
    idfilter = 0;
  }
  return idfilter;
}

/** ******************************** Select title of the project *************** */

$('#typeNameFilter').keyup(function() {
  valuenametitle = $('#typeNameFilter').val();
});


// Function re-start values from number of students & groups

/**
 * To get values to initial.
 */
// function emptyvalueby(){
//   document.getElementById("numberByStudent").value = "";
//   document.getElementById("numberbygroup").value = "";
// }
/**
 * To get values to initial.
 */
// function emptyvaluethreshold(){
//   document.getElementById("thresholdtype").value = "";
// }
/**
 * To get values to initial.
 */
function emptyvaluetitle() {
  document.getElementById('typeNameFilter').value = "";
}


/**  *+++++++++++++++++++++++++++++++++++++++++++++++ ACTION EVENT */

/**  *+++++++++++++++++++++++++++++++++++++++++++++++ Select a course */
// Select a course.
$('#menucurso').change(function() {
  restar();
  let idcourse = idCourse();
  $.ajax({
    data: {idcourse},
    url: 'classes/course/get_course_have_group.php',
    beforeSend: function() {
        $("#contenedor_ajax").html($processing);
    },
    success:  function(response) {
        if (response != '1') {
            $('#group_course').show();
            getfilter();
            insertgroupcourseoption();
          } else {
            $('#group_course').hide();
            getfilter();
            getstudentsnogroup();
        }
    }
  });
});

/**
 * To get the id course.
 * @returns {Int} .
 */
function idCourse() {
  let idCourse = $("#menucurso").val();
  return idCourse;
}

/**
 * Function to get student with NO group
 */
function getstudentsnogroup() {
  let idcourse = idCourse();
  $.ajax({
        data: {idcourse},
        url: 'classes/course/get_students_no_group.php',
        success: function(response) {
              $('.fitem').remove();
              const element = $.parseJSON(response);
              insertintoblocassignconte(element);
        }
  });
}

/**
 * Function to get groups from course.
 */
function insertgroupcourseoption() {
  $.ajax({
        data: {value: idCourse()},
        url: 'classes/course/get_group_course.php',
        beforeSend: function() {
            $("#contenedor_ajax").html($processing);
        },
        success:  function(response) {
          let data = JSON.parse(response);
          $('#menuformato').html('');
          $('<option/>').val(-2).html($choose).appendTo('#menuformato');
          $('<option/>').val(-1).html($allstudents).appendTo('#menuformato');
          $.each(data, (_index, value) =>{
            $('<option/>').val(value.id).html(value.name).appendTo('#menuformato');
          });
        }
  });
}

/**
 * Select if a course has groups.
 */
$('#menuformato').change(function() {
  if (gruposformato() == -1) {
    getstudentsnogroup();
  } else if (gruposformato() == 0 || gruposformato() == 1) {
    getstudentswithgroup();
  } else {
    getstudentswithgroup();
  }
});

/**
 * Subgroups.
 * @returns {Int} gruposformato .
 */
function gruposformato() {
  let gruposformato = $('#menuformato').val();
  return gruposformato;
}

/**
 * Function to get student with group
 */
function getstudentswithgroup() {
  $.ajax({
        data: {value: idgroup()},
        url: 'classes/course/get_student_with_group.php',
        success: function(response) {
              $('.fitem').remove();
              const element = $.parseJSON(response);
              insertintoblocassignconte(element);
        }
  });
}

/**
 * Function insert values (students) in first place
 * @param {Object} element .
 */
function insertintoblocassignconte(element) {
  idarray = [];
  let idname = {};
  idarrayuser = [];

  $.each(element, function(_item, value) {
    if (value.id != -1) {
      idarray.push(value.id);
        name = value.name;
        idname[value.id] = name;
      idarrayuser.push(idname);

      $('#blocAssignConte').append(`<p value= "` + value.id + `" class="fitem ">` + value.name + `</p>`);
      $("#contenedor_ajax").hide();
    } else if (value.id == 0) {
        $('.fitem').remove();
        $("#contenedor_ajax").show();
        $('#blocAssignConte').html($nostudent);
    } else {
        $('.fitem').remove();
        $("#contenedor_ajax").show();
        $('#blocAssignConte').html($nostudent);
    }
  });
  idarrayuser = idarrayuser.shift();
}

/**  *+++++++++++++++++++++++++++++++++++++++++++++++ Select a way to split */
// Select how to split the course (by groups o by students)
$('#menuformatoToSplit').change(function() {
  // Emptyvalueby();

  if (formatoToSplit() == 0) {
    $('#byGroup').show();
    $('#byStudent').hide();
  } else if (formatoToSplit() == 1) {
    $('#byStudent').show();
    $('#byGroup').hide();
  } else if (formatoToSplit() == undefined) {
    $('#byStudent').hide();
    $('#byGroup').hide();
  }
});

/**
 * To know is by student or by group.
 * @returns {Int} formato to split.
 */
function formatoToSplit() {
  let formatoToSplit = $('#menuformatoToSplit').val();
  return formatoToSplit;
}

/**
 * To get the value how many student.
 * @returns {Int} by student.
 */
function numberByStudent() {
  let numberByStudent = $('#numberByStudent').val();
  return numberByStudent;
}
/**
 * To get the value how many groups.
 * @returns {Int} by student.
 */
function numberbygroup() {
  let numberbygroup = $('#number_by_group').val();
  return numberbygroup;
}

/**  *+++++++++++++++++++++++++++++++++++++++++++++++ More / Less filter*/
// More filter.
$('#moreFilter').on('click', function() {
  $('#history_container').slideDown(250);
  $('#personal_filter_container').slideDown(250);
  $('#moreFilter').hide();
  $('#lessFilter').show();
  $('#incompatible_container').show();
});

$('#lessFilter').on('click', function() {
lessFilter();
});

/**
 * To hide some fields from form-
 */
function lessFilter() {
  $('#history_container').slideUp(250);
  $('#personal_filter_container').slideUp(250);
  $('#moreFilter').show();
  $('#lessFilter').hide();
  $('#incompatible_container').hide();
}

/**  *+++++++++++++++++++++++++++++++++++++++++++++++ History****/
// Checkbox with reference.
$('#with_history').click(function() {
  if ($(this).is(':checked')) {
    $.ajax({
      data: {idcourse: idCourse()},
      url: 'classes/history/get_history.php',
      success:  function(response) {
        history = JSON.parse(response);
        history = Object.keys(history);
        historySt = JSON.stringify(history);
        historySave = 1;
      }
    });
  } else {
    historySt = -1;
    historySave = 0;
  }
});

  // Checkbox to get incompatible tandem
if (!($('input[name = "incompatible_tandem"]').is(':checked'))) {
tandemvalue = -1;
}

$('#incompatible_tandem').click(function() {
  if ($(this).is(':checked')) {
    $.ajax({
      data: {idcourse: idCourse()},
      url: 'classes/tandem/get_tandem.php',
      success:  function(response) {
        tandem = response;
        tandem = JSON.parse(tandem);
        if (Object.keys(tandem).length === 0) {
            tandemvalue = -1;
            return tandemvalue;
        } else {
          tandemvalue = '';
          for (var key in tandem) {
            tandemvalue += key;
          }
          tandem = '';
          tandemvalue = tandemvalue.replace(/"/g, "");
          return tandemvalue;
        }
      }
    });
  }
});

/** ******************************** Get a personal filter *************** */
/**
 * function to get filter from course completed
 */
function getCourseCompleted() {
  $.ajax({
    data: {idcourse: idCourse(), idarray},
    url: 'classes/features/course_completed.php',
    success: function(response) {
      console.log(response);
      $('#meancourse').html('');
      $('#meancourse').append(extractmean(response));
      extract(response);
    }
  });
}
/**
 * Extract the mean course.
 * @param {String} response .
 * @return {String} .
 */
function extractmean(response) {
  let indice = response.indexOf('"mean_course":');
  let extraida = response.substring(indice);
  indice = extraida.indexOf(':');
  extraida = extraida.substring((indice + 1), extraida.length - 1);
  return extraida;
}
/**
 * To manipulate an Object to get values.
 * @param {Object} response .
 */
function extract(response) {
  let indice = response.indexOf("tion");
  extraida = response.substring(indice, response.length);
  extraida = extraida.substring(6);
  indice = extraida.indexOf("mea");
  extraida = extraida.substring(0, indice);
  extraida = extraida.substring(0, extraida.length - 2);
  extraida = JSON.parse(extraida);
  let pf = "";
  $.each(extraida, function(_item, value) {
    pf += value;
  });
  extraida = pf.split("");
}

// ******************************* Mean course.
/**
 * Extract the mean course.
 * @param {String} response .
 * @return {String} .
 */
function extractmean2(response) {
  let indice = response.indexOf('["mean_course"]=>');
  let extraida = response.substring(indice);
  indice = extraida.indexOf('=>');
  if (extraida.indexOf('int') != -1) {
    extraida = extraida.substring((indice + 9), extraida.length - 4);
  }
  if (extraida.indexOf('float') != -1) {
    extraida = extraida.substring((indice + 11), extraida.length - 4);
    extraida = parseFloat(extraida).toFixed(1);
  }
  return extraida;
}
/**
 * Function to get filter from mean grade.
 */
function getMeanGrade() {
  $.ajax({
    data: {idcourse: idCourse(), idarray},
    url: 'classes/features/mean_grade.php',
    success: function(response) {
      console.log(response);
      $('#meancourse').html('');
      $('#meancourse').append(extractmean2(response));
      extract2(response);
    }
  });
}

/**
 * To manipulate an Object to get values.
 * @param {Object} response .
 */
function extract2(response) {
  let indice = response.indexOf("array(");
  extraida2 = response.substring(indice, response.length);
  extraida2 = extraida2.substring(10);
  indice = extraida2.indexOf("mea");
  extraida2 = extraida2.substring(0, indice);
  extraida2 = extraida2.substring(0, extraida2.length - 2);
  indice = extraida2.indexOf("}");
  extraida2 = extraida2.substring(0, indice);
  extraida2 = extraida2.replace(/int/g, "");
  extraida2 = extraida2.replace(/\s/g, '');
  extraida2 = extraida2.replace(/>/g, "");
  extraida2 = extraida2.replace(/[{()}]/g, "");
  extraida2 = extraida2.split("[");
  extraida2 = extraida2.join();
  extraida2 = extraida2.substring(1);
  extraida2 = extraida2.replace(/]=/g, ":");
  extraida2 = extraida2.replace(/:/g, "=");
  extraida2 = extraida2.split(",");
  let pf = "";
  $.each(extraida2, function(_item, value) {
    indice = value.indexOf("=");
    pf += value.substring(indice, value.length);
    pf = pf.replace(/[=]/g, "");
  });
  extraida2 = pf.split("");
}


/**
 * Function to get personal filter.
 */
function getPersonalFilter() {
  personalfiltervalue = '';
  personalfilterstudent = '';
  $.ajax({
    data: {idcourse: idCourse(), idfilter: idfilter()},
    url: 'classes/filter/get_personal_filter.php',
    success: function(response) {
      let pf = JSON.parse(response);
      pfvalues = Object.values(pf);
      for (var key in pfvalues) {
        sofia = pfvalues[key]
        sofia = Object.values(sofia);
        personalfiltervalue += sofia[3];
        personalfilterstudent += sofia[4];
      }
      personalfiltervalue = personalfiltervalue.replace(/"/g, "");
      personalfiltervalue = personalfiltervalue.replace(/\[/g, "");
      personalfiltervalue = personalfiltervalue.replace(/\]/g, "");

      personalfilterstudent = personalfilterstudent.replace(/"/g, "");
      while (personalfilterstudent.indexOf("],[") != -1) {
        personalfilterstudent = personalfilterstudent.replace("],[", "/");
      }
      personalfilterstudent = personalfilterstudent.replace(/\[/g, "");
      personalfilterstudent = personalfilterstudent.replace(/\]/g, "");
      personalfilterstudent = personalfilterstudent.split('/');
      for (var key in personalfilterstudent) {
        if (personalfilterstudent[key].indexOf(",") != -1) {
          personalfilterstudent[key] = personalfilterstudent[key].split(",")
        }
        console.log(personalfilterstudent);
      }
      count = 0;
      let personalfilterstudentval = [];
      for (var key in personalfilterstudent) { 
        if (typeof(personalfilterstudent[key]) == 'string') {
          personalfilterstudentval[key].push(count);
        } else {
          d = personalfilterstudent[key];
          console.log(typeof(d))
        }
        count++;
      }
      console.log(personalfilterstudentval);

    }
  });
}


/**
 * Function to get if a course has filters.
 */
function getfilter() {
  $.ajax({
    data: {value: idCourse()},
    url: 'classes/filter/get_filter_course.php',
    success:  function(response) {
      $('#menupersonal_filter').html('');
      $('<option/>').val(-6).attr("checked", true).html($choose).appendTo('#menupersonal_filter');
      $('<option/>').val(-5).html($cFilter).attr("disabled", 'disabled').css('opacity', '0.25').appendTo('#menupersonal_filter');
      $('<option/>').val(-2).html($coursecompleted).appendTo('#menupersonal_filter');
      $('<option/>').val(-1).html($meangrade).appendTo('#menupersonal_filter');
      $('<option/>').val(-4).html($pFilter).attr("disabled", 'disabled').css('opacity', '0.25').appendTo('#menupersonal_filter');

      let data = response;
      if (data === null || data == "") {
        $('<option/>').val(-3).html($nofilter).attr("disabled", 'disabled').appendTo('#menupersonal_filter');
      } else {
        data = JSON.parse(response);
        $.each(data, (_index, value) =>{
          valueFilterId = value.filter_id;
          valueFilterName = value.filter_name;
          $('<option/>').val(valueFilterId).html($nbsp + valueFilterName).appendTo('#menupersonal_filter');
        });
      }
    }
  });
}

/**
 * To get the threshold value.
 * @returns {String}
 */
function thresholdtype() {
  threshold = $('#threshold_type').val();
  return threshold;
}

// Select if a personal filter is selected
$('#menupersonal_filter').change(function() {
  let m = $('#menupersonal_filter').val();
  if (m != -6 || m != -5 || m != -4 || m != -3 || m != 0) {
    $('#custom_filter_cooperative').show();
  } else {
    $('#custom_filter_cooperative').hide();
  }

  $('#heterogenic_checkbox').prop("checked", false);
  $('#homogenic_checkbox').prop("checked", false);
  $('#custom_filter_homogenic').show();

  if (idfilter() == -2) {
    $('#threshold_container').show();
    getCourseCompleted();
  } else if (idfilter() == -1) {
    $('#threshold_container').show();
    getMeanGrade();
  } else {
    $('#threshold_container').hide();
    getPersonalFilter();
  }

  if (idfilter() == undefined || idfilter() == -4 || idfilter() == -3 || idfilter() == 0) {
    $('#custom_filter_homogenic').hide();
  }
});


// Checkbox homogenic group.
$('#homogenic_checkbox').click(function() {
  if ($(this).is(':checked')) {
    homogenic = 1;
  }
});
$('#heterogenic_checkbox').click(function() {
  if ($(this).is(':checked')) {
    homogenic = 0;
  }
});

/** ******************************** Create button *************** */
// Buttons.
$('#create_button').click(function() {

    $('#save_button').show();
    $('#managedelcontainer').show();
    $('#output_print_conte').hide();

  if (validationformcreate() == true && validationformcreate2() == true) {
    $('#modal_button').show();
    $('#export_button').show();
    $('#output_print_conte').show();
    $('#csvexport').show();

    if (historySt.length < 1) {
    historySt = -1;
    }

    createthegroup();
  }
});

/**
 * To call model.php and return the teams.
 * @param {Object} data .
 */
function createthegroup() {

  if (formatoToSplit() == 0) {
    togglevalue = numberbygroup();
  } else if (formatoToSplit() == 1) {
  togglevalue = numberByStudent();
  }

  let personalfilter = [];
  if (idfilter() == -2) {
  personalfilter = extraida;
  filter = $cCompleted;
  threshold = thresholdtype();
  } else if (idfilter() == -1) {
  personalfilter = extraida2;
  filter = $mGrade;
  threshold = thresholdtype();
  } else if ($('#menupersonal_filter').val() == -6) {
  personalfilter = -1;
  filter = 0;
  } else {
    personalfilter = [personalfiltervalue, personalfilterstudent]; threshold = 0;
    filter = valueFilterName;
  }
  personalfilter = JSON.stringify(personalfilter);

  if (!($('input[name = "incompatible_tandem"]').is(':checked'))) {
    tandemvalue = -1;
  }

  data = {
    idarray, toogle: formatoToSplit(), togglevalue, historySt, personalfilter, threshold, homogenic, tandemvalue
  };
  console.log(data);
  // Ajax conection.
  $.ajax({
    data: {
      idarray, toogle: formatoToSplit(), togglevalue, historySt, personalfilter, threshold, homogenic, tandemvalue
    },
    url: 'classes/save/model.php',
    beforeSend: function() {
      $("#output_print_conte").html($processing);
    },
    success:  function(response) {

      let element = JSON.parse(response);
      if (element.error) {
        $('#output_print_conte').html(' ');
        $('#output_print_conte').append(`<p class ="text-danger">Not Enough Users</p>`);
      } else if (element.warning) {
        $('#output_print_conte').html(' ');
        $('#output_print_conte').append(`<p class ="text-warning">${element.warning_messages}</p>`);
      } else {
        arraysplitgroups = [];
        let arrayI = [];
        let arrayJ = [];
        $.each(element, function(item, value) {
          for (let i = 0; i < [value.length]; i++) {
            if (item[i] != 't') {
              arrayJ = [];
              for (let j = 0; j < [value[i].length]; j++) {
                    arrayJ.push(value[i][j]);
              }
            }
            arrayI.push(arrayJ);
          }
        });
        arrayI.pop();
        arraysplitgroups = arrayI;
        arrayI = [];
        insertIntoOutputPrintConte(arraysplitgroups);
      }
    }
  });
}

// Function insert values (students) with groups in second place.
// Create button action.
let csv = {};
let csvexport = [];
let csvpush = {};

/**
 * To print user at the final table.
 * @param {Array} arraysplitgroups .
 */
function insertIntoOutputPrintConte(arraysplitgroups) {
  $('.fitem2').remove();
  $('#output_print_conte').html(' ');
  let count = 1;
  let csvGroupkey;
  let user = [];
  csv = {};
  csvexport = [];
  $('#modal_Container').html('');
  $('#output_print_conte').append(`
    <div><h4> ${valuenametitle} </h4><div>`);
  $('#modal_Container').append(`
    <div><h4> ${valuenametitle} </h4><div>`);

  $.each(arraysplitgroups, function(_item, value) {
      csvpush = {};
      csvGroupkey = valuenametitle + count;
      $('#output_print_conte').append(`
      <div class="fitem2">
        <p class="fitem2 m_bot"> 
          <input type="text" style="border: none" id="` + csvGroupkey + `" value="` + csvGroupkey + `" readonly>
        </p>  
      <div>`);

      $('#modal_Container').append(`
        <div class="fitem2">
          <p class="fitem2 m_bot">
          <h5 style="border: none" placeholder="` + csvGroupkey + `" id="` + csvGroupkey + `"> ${csvGroupkey} </h5>
          </p>  
        <div>`);
      user = [];
      let key;
      for (let j = 0; j < [value.length]; j++) {
        for (key in idarrayuser) {
          if (key == value[j]) {
            name = idarrayuser[key];
            user.push(idarrayuser[key]);
          }
        }

        $('#output_print_conte').append(`
          <ul class="fitem2">
            <li class="fitem2">` + name + `</li>
          </ul>
        `);
        $('#modal_Container').append(`
          <ul class="fitem2">
            <li class="fitem2">` + name + `</li>
          </ul>
        `);
      }
      csvpush[csvGroupkey] = user;
      csv[csvGroupkey] = user;
      count++;
      csvexport.push(csvpush);
    });
}


// Save Button.
$('#saveGroups').click(function() {
  saveinhistory();
});

/**
 * Save in history
 */
function saveinhistory(){

  $('#with_history').prop("checked", false);

  if ($('#incompatible_tandem').is(':checked')) {
    tandem = 1;
  } else {
    tandem = 0;
  }
  let aSplitG = arraysplitgroups;
  let h = historySave;
  let tV = togglevalue;
  let k = Object.keys(csv);
  k = JSON.stringify(k);
  let vNT = valuenametitle;
  let idA = JSON.stringify(idarray);
  let SplitG = JSON.stringify(aSplitG);
  let idc = idCourse();
  let idg = idgroup();
  let t = formatoToSplit();

  $.ajax({
    data: {
      idc, idg, t, tV, h, filter, threshold, homogenic, tandem, vNT, k, idA, SplitG},
    url: 'classes/save/save_groups_db.php',
    success:  function(response) {
      console.log(response);
      // newurl = window.location.href;
      // if (newurl.indexOf('#') == -1) {
      //   newurl = window.location.href + "#history";
      // } else {
      //   tosplit = newurl.indexOf('#');
      //   newurl = newurl.substring(tosplit);
      // }
      // window.location.assign(newurl);
      window.location.reload();
    }
  });
}

// Save On moodle.
$('#saveinmoodle').click(function() {
  $('.validationclass').html('');

  let aSplitG = arraysplitgroups;
  let k = Object.keys(csv);
  k = JSON.stringify(k);
  let SplitG = JSON.stringify(aSplitG);

  $.ajax({
    data: {idC: idCourse(), k, SplitG},
    url: 'classes/save/save_teams_moodle.php',
    success:  function(response) {
        console.log(response);
    }
  });

  saveinhistory();

});


$('#f_screen').on('click', function() {
  $('#modal_Cont').show();
});


$('#x').on('click', function() {
  $('#modal_Cont').hide();
});

$('#refresh').on('click', function() {
  $('#form1')[0].reset();
  $('.fitem').remove();
  $('.fitem2').remove();
  $('#output_print_conte').hide();
  $('#modal_button').hide();
  restar();
  $('#with_history').prop("checked", false);
  $('#save_button').hide();
  $('#managedelcontainer').hide();
  emptyvaluetitle();
});


/**
 * Validation function.
 * @returns {Bolean}
 */
function validationformcreate() {
  $('.validationclass').html('');

  if ($('#typeNameFilter').val() == 0 || $('#typeNameFilter').val() == '' || $('#typeNameFilter').val() === null) {
    $('#valiTitleContainer').append('<p class="text-danger"><small>* This field cannot be empty </small></p>');
    return false;
  }

  if (idCourse() == '' || idCourse() === null || idCourse() == undefined) {
    $('#valiCourseContainer').append('<p class="text-danger"><small>* Please, select a course</small></p>');
    return false;
  }
  if ((idgroup() != 1) && (idgroup() == -2)) {
    $('#valiCourseGroupContainer').append('<small class="text-danger">* Please, select a group for this course</small>');
    return false;
  }
  if (formatoToSplit() == '' || formatoToSplit() === null || formatoToSplit() == undefined) {
    $('#valiFormatContainer').append('<small class="text-danger">* Please, select a format to split the new group</small>');
    return false;
  }
  if (formatoToSplit() == 1) {
    if (numberByStudent() == " ") {
      $('#valiStudentsContainer').append('<small class="text-danger">* Please insert the number of students</small>');
      return false;
    }
    if (numberByStudent() == 0) {
      $('#valiStudentsContainer').append('<small class="text-danger">* Students field cannot be zero</small>');
      return false;
    }
    if ((parseFloat(numberByStudent()) === isNaN) || (isFinite(numberByStudent()) !== true)) {
      $('#valiStudentsContainer').append('<small class="text-danger">* Please insert the number of students</small>');
      return false;
    }
  }
  if (formatoToSplit() == 0) {
    if (numberbygroup() == " ") {
      $('#valiGroupContainer').append('<small class="text-danger">* Insert the number of groups</small>');
      return false;
    }
    if (numberbygroup() == 0) {
      $('#valiGroupContainer').append('<small class="text-danger">* Groups field cannot be zero</small>');
      return false;
    }
    if ((parseFloat(numberbygroup()) === isNaN) || (isFinite(numberbygroup()) !== true)) {
      $('#valiGroupContainer').append('<small class="text-danger">* Insert the number of groups</small>');
      return false;
    }
  }

  return true;
}

/**
 * Validation function.
 * @returns {Bolean}
 */
function validationformcreate2() {
  if ((idfilter() == -1) || (idfilter() == -2)) {
    if (thresholdtype() == ' ') {
      $('#valifilterContainer').append('<small class="text-danger">* Threshold field cannot be left empty</small>');
      return false;
    }
    if (thresholdtype() == 0) {
      $('#valifilterContainer').append('<small class="text-danger">* Threshold field cannot be zero or empty </small>');
      return false;
    }
    if ((parseFloat(thresholdtype()) === isNaN) || (isFinite(thresholdtype()) !== true)) {
      $('#valifilterContainer').append('<small class="text-danger">* Insert a number for the threshold</small>');
    return false;
    }
  }
  if ((idfilter() == -2) || (idfilter() == -1)) {

    if (!($('input[name = "cooperative_group_checkbox"]').is(':checked'))) {
      $('#valifilterContainer').append('<small class="text-danger">* Select Homogenic or Heterogenic group</small>');
      return false;
    }
  }
  return true;
}

$('#csvexport').on('click', function() {

  let keyscsv = '';
  for (let i = 0; i < csvexport.length; i++) {
    keyscsv += [Object.keys(csvexport[i])] + ',' + [Object.values(csvexport[i]) ]+ '\n';
  }

  const headers = ' ,Name,Teams \n';
  const main = keyscsv;
  const csv = [headers, ...main].join();
  startcsvdownload(csv);

});

/**
 * To start the download.
 * @param {*} input .
 */
function startcsvdownload(input) {
  const blob = new Blob([input], {type: 'team/csv '});
  const url = URL.createObjectURL(blob);
  const a = document.createElement('a');
  var f = new Date();
  var d = f.getFullYear() + '.' + f.getMonth() + '.' + f.getDate() + '.' + f.getHours() + ':' + f.getMinutes();
  a.download = 'teamgenerator_' + d + '.csv';
  a.href = url;
  a.style.display = 'none';

  document.body.appendChild(a);

  a.click();
  a.remove();
  URL.revokeObjectURL(url);
}


/**
 * To hide or initialize fields.
 */
function restar() {
  $('#group_course').hide();
  $('#menuformatoToSplit').prop('selectedIndex', 0);
  $('#byStudent').hide();
  $('#byGroup').hide();
  lessFilter();
  $('#lessFilter').hide();
  $('#with_history').prop("checked", false);
  $('#history_container').hide();
  history = {};
  historySt = "";
  $('#custom_filter_cooperative').hide();
  $('#incompatible_tandem').prop("checked", false);
  tandem = [];
  $('#incompatible_container').hide();
  $('#personal_filter_container').hide();
  $('#menupersonal_filter').prop('selectedIndex', 0);
  personalfilter = [];
  personalfiltervalue = '';
  personalfilterstudent = '';
  $('#custom_filter_homogenic').hide();
  $('#heterogenic_checkbox').prop("checked", false);
  $('#homogenic_checkbox').prop("checked", false);
  $('#threshold_container').hide();
  $('#output_print_conte').hide();
  $('#result_personal_filter').hide();
  $('#modal_Cont').hide();
  $('#modal_button').hide();
  $('.fitem').remove();
  $('#export_button').hide();
  $('#explain_course').hide();
  $('#explain_groupcourse').hide();
  $('#explain_formatsplit').hide();
  $('#explain_bystudent').hide();
  $('#explain_bygroup').hide();
  $('#explain_history').hide();
  $('#explain_tandem').hide();
  $('#explain_personalfilter').hide();
  $('#explain_homogenic').hide();
  $('#explain_heterogenic').hide();
  $('#explain_threshold').hide();
  $('#explain_title_container').hide();
  $('#csvexport').hide();
  $('.validationclass').html('');
}
restar();
 
});
});

