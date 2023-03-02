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


defined('MOODLE_INTERNAL') || die();

require_once('../../config.php');
require_once($CFG->dirroot.'/local/group_generator/lib.php');
require_login();


/**
 * To display and configurate table "table personal filter" / TODO.
 * @return Object of the table to print.
 */
function table_personalfilter() {
    global $DB;
    $messages = $DB->get_records_sql("SELECT *  FROM {local_gg_filter_name} ");
    $users = getUsers();
    $table = new html_table();

    if (empty($messages)) {
        echo '';
    } else {

        $table->id = 'table_personalFilter';
        $table->class = 'table table-striped table-bordered table-sm ';
        $table->width = '100%';
        $table->align = ['justify'];

        $table->cellspacing = 50;
        $table->colclasses = array(null, 'grade');

        $table->head = array(
            get_string('id_course', 'local_group_generator'),
            get_string('filter_name', 'local_group_generator'),
            get_string('filter_value', 'local_group_generator'),
            get_string('filter_studentOn', 'local_group_generator'),
            get_string('timecreated', 'local_group_generator'),
        );

        foreach ($messages as $e) {
            $course = $DB->get_record('course', array('id' => $e->course_id));
            $time = date ("j.m.Y G:i:s", $e->timecreated);

            $filter = $e->filter_value;
            $filter = trim(trim($filter, ']]'), '[[');
            $filter = str_replace('],[', '/', $filter);
            $filter = str_replace('"', '', $filter);
            $filter = explode('/', $filter);
            $fv = '';

            $user = $e->student_on_filter;
            $user = trim(trim($user, ']'), '[');
            $user = explode('],[', $user);
            $user = trim(implode(' ', $user), '"');
            $user = explode('" "', $user);

            for ($i = 0; $i < count($filter); $i++) {

                $username = '';
                $r = explode(',', $user[$i]);
                for ($j = 0; $j < count($r); $j++) {
                    $username .= $users[intval($r[$j])] . ', ';
                }
                $table->data[] = array(
                    $course->fullname,
                    $e->filter_name,
                    $filter[$i],
                    $username,
                    strval($time),
                );
            }
        }
    }
        return html_writer::table($table);
}



