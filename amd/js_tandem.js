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
//
// * Javascript
// *

require(['core/first', 'jquery', 'jqueryui', 'core/ajax'], function(_core, $) {

  // -----------------------------
  $(document).ready(function() {

/**
 * Variables.
 */
let tandem_value = '';
let no_tand = {};
let no_tand_student = [],
student_tandem = [];
let edit = false;
let notandemhere = false;

/**
 * To get a course.
 * @returns {String} .
 */
function id_course3() {
  let id_course3 = $("#menucurso_tandem").val();
  return id_course3;
}

/**
 * To choose a user one.
 * @returns {String}.
 */
function studentone_value() {
  let studentone = $('#menustudent_one').val();
  return studentone;
}
/**
 * To choose a user two.
 * @returns {String} .
 */
function studenttwo_value() {
  let studenttwo = $('#menustudent_two').val();
  return studenttwo;
}
/**
 * Conected with ajax.
 * @param {Function} callback .
 */
function get_id_tandem(callback) {
  $.ajax({
    data: {idcourse: id_course3()},
    url: 'classes/tandem/get_id_tandem.php',
    success:  function(response) {
      let idtandem = JSON.parse(response);
      let id;
      for (var property in idtandem) {
        id = parseInt(property);
      }
      callback(student_tandem, id);
    }
  });
}
/**
 * To create or update a tandem.
 * @param {*} student_tandem .
 * @param {*} id .
 */
function to_update(student_tandem, id) {
  let url = (edit == true) ? 'classes/tandem/edit_tandem.php' : 'classes/tandem/save_tandem.php';
  if (student_tandem.length === 2) {
    url = 'classes/tandem/delete_tandem.php';
  } 
  $.ajax({
    data: {idcourse: id_course3(), student_tandem, idtandem: id},
    url,
    success:  function() {
      // reset_tandem();
      window.location.reload();
    }
  });
}
/**
 * To edit Tandem.
 * @param {*} no_tand .
 */
function to_edit(no_tand) {
  $.ajax({
    data: {idcourse: id_course3()},
    url: 'classes/tandem/get_tandem.php',
    success:  function(response) {
    let tandem = [];
    if (response.length == 2) {
      edit = false;
      $('#result_in_tandem').html('');
      $('#result_in_tandem').append('No tandem here');
      notandemhere = true;
    } else {
      notandemhere = false;
      $('#result_in_tandem').html('');
      $('#save_no_tandem').show();

      tandem = JSON.parse(response);
      edit = true;
      for (let key in tandem) {
        key = JSON.stringify(key);
        var regex = /(\d+)/g;
        tandem_value = key.match(regex);

        for (let i = 0; i < tandem_value.length; i = i + 2) {

        if (no_tand[tandem_value[i + 1]] != undefined) {
          // eslint-disable-next-line no-console
          console.log(no_tand[tandem_value[i + 1]]);
        }

        $('#result_in_tandem').append(
          `<div id = "div_` + tandem_value[i] + `_` + tandem_value[i + 1] + `">
          <p>`
          + no_tand[tandem_value[i]] + `
          &nbsp;&nbsp;&nbsp;
          <img id="frame" style="width: 18px; height: 18px;" class="no_es_igual" src="img/no-es-igual.png" alt="bin" >
          &nbsp;&nbsp;&nbsp;
          ` + no_tand[tandem_value[i + 1]] + `
          &nbsp;&nbsp;&nbsp;
          <img class="trash" src="img/trash.png" alt="bin" 
          id = "` + tandem_value[i] + `_` + tandem_value[i + 1] + `" >
          </p> 
          </div>`
        );

        no_tand_student[tandem_value[i] + "_" + tandem_value[i + 1]] = tandem_value[i] + "_" + tandem_value[i + 1];

        $("#" + tandem_value[i] + "_" + tandem_value[i + 1] + "").click(function() {
          $(this).parent().parent().remove();
          let to_delete = $(this).attr('id');
          delete no_tand_student[to_delete];
        });
      }

        $('#result_in_tandem').show();

        tandem_value = [];
      }
    }
    tandem = [];
  }
  });
}

/**
 * To reset original value.
 */
function reset_tandem() {
  $('#save_no_tandem').hide();
  no_tand_student = [];
  no_tand = {};
  student_tandem = [];
  $('#result_in_tandem').html(' ');
  $('#menustudent_one').prop('selectedIndex', 0);
  $('#menustudent_two').prop('selectedIndex', 0);
}

/** *********Actions */
reset_tandem();

$('#menucurso_tandem').change(function() {

  reset_tandem();
  let idcourse = id_course3();
    $.ajax({
      data: {idcourse},
      url: 'classes/course/get_students_no_group.php',
      success: function(response) {
        const element = $.parseJSON(response);
          $('#menustudent_one').html('');
          $('<option/>').val(-4).html('Choose...').appendTo('#menustudent_one');
          $('#menustudent_two').html('');
          $('<option/>').val(-4).html('Choose...').appendTo('#menustudent_two');
          get_data(element, to_edit);
        }
    });
});
/**
 * To know if this course have previous tandem and display it.
 * @param {*} element 
 * @param {*} callback function. 
 */
function get_data(element, callback) {
  $.each(element, function(_item, data) {
    $('#menustudent_one').append(
      `<option id="` + data.id + `" class="student_` + data.id + `" value = "` + data.id + `">`
      + data.name +
      `</option>`);
    $('#menustudent_two').append(
      `<option id="` + data.id + `" class="student_` + data.id + `" value = "` + data.id + `">`
      + data.name +
      `</option>`);
    no_tand[data.id] = data.name;
  });
  callback(no_tand);
}

$('#add_btn_tandem').on('click', function() {

  let one = document.getElementById("menustudent_one").value;
  let two = document.getElementById("menustudent_two").value;

  if (one != two) {
    if(notandemhere == true){
      $('#result_in_tandem').html('');
    }
    $('#result_in_tandem').append(
      `<div id = "div_` + studentone_value() + `_` + studenttwo_value() + `">
      <p>`
      + no_tand[studentone_value()] + `
      &nbsp;&nbsp;&nbsp;
      <img id="frame" style="width: 18px; height: 18px;" class="no_es_igual" src="img/no-es-igual.png" alt="bin" >
      &nbsp;&nbsp;&nbsp;
      ` + no_tand[studenttwo_value()] + `
      &nbsp;&nbsp;&nbsp;
      <img class="trash" src="img/trash.png" alt="bin" id = "` + studentone_value() + `_` + studenttwo_value() + `" >
      </p> 
      </div>
      `);

      $('#result_in_tandem').show();
      $('#save_no_tandem').show();

      no_tand_student[studentone_value() + "_" + studenttwo_value()] = studentone_value() + "_" + studenttwo_value();

      $("#" + studentone_value() + "_" + studenttwo_value() + "").click(function() {
        $(this).parent().parent().remove();
        let to_delete = $(this).attr('id');
        delete no_tand_student[to_delete];
      });

  }
});

$('#save_no_tandem').on('click', function() {

  for (var key1 in no_tand_student) {
    key1 = JSON.stringify(key1);
    key1 = key1.substring(1);
    key1 = key1.substring(0, key1.length - 1);
    key1 = key1.split('_');

    student_tandem.push(key1);
  }
  student_tandem = JSON.stringify(student_tandem);

  let id;
  if (edit == true) {
    get_id_tandem(to_update);
  } else {
    id = 0;
    to_update(student_tandem, id);
  }
});

});
});

