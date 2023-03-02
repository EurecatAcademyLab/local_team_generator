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
 * Edit the tandem on DB
 */

require_once(__DIR__.'/../../../../config.php');
require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot.'/lib/formslib.php');
require_login();

$id = optional_param('idtandem', null, PARAM_INT);
$studenttandem = optional_param('student_tandem', null, PARAM_TEXT);
$idcourse = optional_param('idcourse', null, PARAM_INT);

global $DB;

    $record = new stdClass();
    $record->id = $id;
    $record->student_tandem = $studenttandem;
    $record->course_id = $idcourse;

if ($DB->record_exists('local_gg_tandem', array('id' => $id))) {
    $DB->update_record('local_gg_tandem', $record);

    echo 'Task Edited Succesfully' . $record->id;
}

