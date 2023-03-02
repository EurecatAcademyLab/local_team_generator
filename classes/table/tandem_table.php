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
function tandem_table() {
    global $DB;
    $messages = $DB->get_records_sql("SELECT *  FROM {local_gg_tandem}");
    $users = getUsers();

    $table = new html_table();

    if (empty($messages)) {
        echo '';
    } else {

        $table->id = 'tandemtable';
        $table->class = 'table table-striped table-bordered table-sm ';
        $table->width = '100%';
        $table->align = ['justify'];

        $table->cellspacing = 50;
        $table->colclasses = array(null, 'grade');

        $table->head = array(
            get_string('id_course', 'local_group_generator'),
            get_string('tandem', 'local_group_generator'),
            get_string('timecreated', 'local_group_generator'),
        );

        foreach ($messages as $e) {
            $course = $DB->get_record('course', array('id' => $e->course_id));
            $time = date ("j.m.Y G:i:s", $e->timecreated);
            $ratio = $e->student_tandem;
            $ratio = trim(trim($ratio, ']'), '[');
            $ratio = str_replace('"', '', $ratio);
            $ratio = str_replace('],[', '/', $ratio);
            $ratio = explode('/', $ratio);
            foreach ($ratio as $r) {
                $username = '';
                $r = explode(',', $r);
                for ($i = 0; $i < count($r); $i++) {
                    $username .= $users[intval($r[$i])] . ', ';
                }

                $table->data[] = array(
                    $course->fullname,
                    $username,
                    $time
                );

            }
        }
    }

        return html_writer::table($table);
}



