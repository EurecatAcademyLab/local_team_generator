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


// Help button.

window.onclick = function(event) {
    var explaintitlecontainer = document.getElementById('explain_title_container');
    if (event.target == explaintitlecontainer) {
      explaintitlecontainer.style.display = "none";
      $('#explain_title_container').hide();
    }
    var explainCourse = document.getElementById('explain_course');
    if (event.target == explainCourse) {
      explainCourse.style.display = "none";
      $('#explain_course').hide();
    }
    var explainGroupcourse = document.getElementById('explain_groupcourse');
    if (event.target == explainGroupcourse) {
      explainGroupcourse.style.display = "none";
      $('#explain_groupcourse').hide();
    }
    var explainformatsplit = document.getElementById('explain_formatsplit');
    if (event.target == explainformatsplit) {
      explainformatsplit.style.display = "none";
      $('#explain_formatsplit').hide();
    }
    var explainbystudent = document.getElementById('explain_bystudent');
    if (event.target == explainbystudent) {
      explainbystudent.style.display = "none";
      $('#explain_bystudent').hide();
    }
    var explaibygroup = document.getElementById('explain_bygroup');
    if (event.target == explaibygroup) {
      explaibygroup.style.display = "none";
      $('#explain_bygroup').hide();
    }
    var explainhistory = document.getElementById('explain_history');
    if (event.target == explainhistory) {
      explainhistory.style.display = "none";
      $('#explain_history').hide();
    }
    var explaintandem = document.getElementById('explain_tandem');
    if (event.target == explaintandem) {
      explaintandem.style.display = "none";
      $('#explain_tandem').hide();
    }
    var explainpersonalfilter = document.getElementById('explain_personalfilter');
    if (event.target == explainpersonalfilter) {
      explainpersonalfilter.style.display = "none";
      $('#explain_personalfilter').hide();
    }
    var explainhomogenic = document.getElementById('explain_homogenic');
    if (event.target == explainhomogenic) {
      explainhomogenic.style.display = "none";
      $('#explain_homogenic').hide();
    }
    var explainheterogenic = document.getElementById('explain_heterogenic');
    if (event.target == explainheterogenic) {
      explainheterogenic.style.display = "none";
      $('#explain_heterogenic').hide();
    }
    var explainthreshold = document.getElementById('explain_threshold');
    if (event.target == explainthreshold) {
      explainthreshold.style.display = "none";
      $('#explain_threshold').hide();
    }
  };

   // Help button select title.
  $('#text_selectTitle').on('click', function() {

    $('#explain_title_container').css({
      "border-radius": "10px",
      "z-index": "5",
      "padding": "8px 10px",
      "position": "absolute",
      "border": "1px solid rgb(219, 219, 219)",
      "margin-left": "10px",
      "background-color": "white",
      "width": "130px",
      "overflow": "auto",
      "font-size": "12px"});
    $('#explain_title_container').toggle();
  });

  // Help button Menu course.
  $('#text_selectCurso').on('click', function() {

    $('#explain_course').css({
      "border-radius": "10px",
      "z-index": "5",
      "padding": "8px 10px",
      "position": "absolute",
      "border": "1px solid rgb(219, 219, 219)",
      "margin-left": "10px",
      "background-color": "white",
      "width": "100px",
      "overflow": "auto",
      "font-size": "12px"});
    $('#explain_course').toggle();
  });

  // Help button Menu course group.
  $('#text_groupcourse').on('click', function() {
    $('#explain_groupcourse').css({
      "border-radius": "10px",
      "z-index": "5",
      "padding": "8px 10px",
      "position": "absolute",
      "border": "1px solid rgb(219, 219, 219)",
      "margin-left": "10px",
      "background-color": "white",
      "width": "100px",
      "overflow": "auto",
      "font-size": "12px"});
    $('#explain_groupcourse').toggle();
  });

  // Help button Menu format split.
  $('#text_formatsplit').on('click', function() {
    $('#explain_formatsplit').css({
      "border-radius": "10px",
      "z-index": "5",
      "padding": "8px 10px",
      "position": "absolute",
      "border": "1px solid rgb(219, 219, 219)",
      "margin-left": "10px",
      "background-color": "white",
      "width": "100px",
      "overflow": "auto",
      "font-size": "12px"});
    $('#explain_formatsplit').toggle();
  });

  // Help button by student.
  $('#text_bystudent').on('click', function() {
    $('#explain_bystudent').css({
      "border-radius": "10px",
      "z-index": "5",
      "padding": "8px 10px",
      "position": "absolute",
      "border": "1px solid rgb(219, 219, 219)",
      "margin-left": "10px",
      "background-color": "white",
      "width": "100px",
      "overflow": "auto",
      "font-size": "12px"});
    $('#explain_bystudent').toggle();
  });

  // Help button by group.
  $('#text_bygroup').on('click', function() {
    $('#explain_bygroup').css({
      "border-radius": "10px",
      "z-index": "5",
      "padding": "8px 10px",
      "position": "absolute",
      "border": "1px solid rgb(219, 219, 219)",
      "margin-left": "10px",
      "background-color": "white",
      "width": "100px",
      "overflow": "auto",
      "font-size": "12px"});
    $('#explain_bygroup').toggle();
  });

  // Help button history.
  $('#text_history').on('click', function() {
    $('#explain_history').css({
      "border-radius": "10px",
      "z-index": "5",
      "padding": "8px 10px",
      "position": "absolute",
      "border": "1px solid rgb(219, 219, 219)",
      "margin-left": "10px",
      "background-color": "white",
      "width": "100px",
      "overflow": "auto",
      "font-size": "12px"});
    $('#explain_history').toggle();
  });

  // Help button tandem.
  $('#text_tandem').on('click', function() {
    $('#explain_tandem').css({
      "border-radius": "10px",
      "z-index": "5",
      "padding": "8px 10px",
      "position": "absolute",
      "border": "1px solid rgb(219, 219, 219)",
      "margin-left": "10px",
      "background-color": "white",
      "width": "100px",
      "overflow": "auto",
      "font-size": "12px"});
    $('#explain_tandem').toggle();
  });

  // Help button Personal filter.
  $('#text_personalfilter').on('click', function() {
    $('#explain_personalfilter').css({
      "border-radius": "10px",
      "z-index": "5",
      "padding": "8px 10px",
      "position": "absolute",
      "border": "1px solid rgb(219, 219, 219)",
      "margin-left": "10px",
      "background-color": "white",
      "width": "100px",
      "overflow": "auto",
      "font-size": "12px"});
    $('#explain_personalfilter').toggle();
  });

  // Help button homogenic.
  $('#text_homogenic').on('click', function() {
    $('#explain_homogenic').css({
      "border-radius": "10px",
      "z-index": "5",
      "padding": "8px 10px",
      "position": "absolute",
      "border": "1px solid rgb(219, 219, 219)",
      "margin-left": "10px",
      "background-color": "white",
      "width": "100px",
      "overflow": "auto",
      "font-size": "12px"});
    $('#explain_homogenic').toggle();
  });

  // Help button heterogenic.
  $('#text_heterogenic').on('click', function() {
    $('#explain_heterogenic').css({
      "border-radius": "10px",
      "z-index": "5",
      "padding": "8px 10px",
      "position": "absolute",
      "border": "1px solid rgb(219, 219, 219)",
      "margin-left": "10px",
      "background-color": "white",
      "width": "100px",
      "overflow": "auto",
      "font-size": "12px"});
    $('#explain_heterogenic').toggle();
  });

  // Help button threshold
  $('#text_threshold').on('click', function() {
    $('#explain_threshold').css({
      "border-radius": "10px",
      "z-index": "5",
      "padding": "8px 10px",
      "position": "absolute",
      "border": "1px solid rgb(219, 219, 219)",
      "margin-left": "10px",
      "background-color": "white",
      "width": "100px",
      "overflow": "auto",
      "font-size": "12px"});
    $('#explain_threshold').toggle();
  });

});
});

