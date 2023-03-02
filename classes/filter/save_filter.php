<?php
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
 * Display information about all the local_group_generator in the requested course.
 *
 * @package     local_group_generator
 * @author      2022 JuanCarlo Castillo <juancarlo.castillo20@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @copyright   2022 JuanCa Castillo & Eurecat.dev
 * @since       3.11
 */


/**
 * Create a filter.
 */
require_once(__DIR__.'/../../../../config.php');
require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot.'/lib/formslib.php');
require_login();

$title = optional_param('title', null, PARAM_TEXT);
$idcourse = optional_param('idcourse2', null, PARAM_INT);
$values = optional_param('values', null, PARAM_TEXT);
$studentonfilter = optional_param('students', null, PARAM_TEXT);

    global $DB;

    $record = new stdClass();
    $record->filter_name = $title;
    $record->course_id = $idcourse;
    $record->filter_value = $values;
    $record->student_on_filter = $studentonfilter;
    $record->timecreated = time();

    $DB->insert_record('local_gg_filter_name', $record);

    echo 'Task Added Succesfully';
