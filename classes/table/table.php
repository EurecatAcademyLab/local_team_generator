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
 * To display and configurate table "tablegroup".
 * @return Object of the table to print.
 */
function tablegroup() {
    global $DB;
    $sql = "SELECT gg.* , c.fullname FROM {local_group_generator} gg JOIN {course} c ON c.id = gg.id_course";
    $messages = $DB->get_records_sql($sql);

    $users = getusers();

    $table = new html_table();

    if (empty($messages)) {
        echo '';
    } else {
        $table->id = 'mytablegroup';
        $table->class = 'table table-striped table-bordered table-sm ';
        $table->width = '100%';
        $table->align = ['left'];
        $table->caption = get_string('titletable', 'local_group_generator');
        $table->cellspacing = 50;
        $table->colclasses = array(null, 'grade');

        $table->head = array(
            get_string('titleteam', 'local_group_generator'),
            get_string('id_course', 'local_group_generator'),
            get_string('id_group', 'local_group_generator'),
            get_string('toggle_value', 'local_group_generator'),
            get_string('split_group', 'local_group_generator'),
            get_string('history', 'local_group_generator'),
            get_string('filter', 'local_group_generator'),
            get_string('homogenic_table', 'local_group_generator'),
            get_string('tandem_value', 'local_group_generator'),
            get_string('timecreated', 'local_group_generator'),
        );

        foreach ($messages as $e) {

            $ratio = $e->split_group;
            $ratio = explode(',', $ratio);
            $username = '';
            foreach ($ratio as $r) {
                    $username .= $users[intval($r)] . ', ';
            }

            ($e->id_group == 0)
            ? $subgroup = get_string('no', 'local_group_generator')
            : (($e->id_group == -1)
                ? $subgroup = 'All students'
                : $subgroup = groups_get_group_name($e->id_group));

            if ($e->toggle == 0) {
                $togglevalue = 'In '. $e->toggle_value . ' teams';
            } else {
                $togglevalue = 'Teams with '. $e->toggle_value . ' students';
            }
            $time = date ("j.m.Y G:i:s", $e->timecreated);
            ($e->history == 0)
                ? $history = get_string('no', 'local_group_generator')
                : $history = get_string('right', 'local_group_generator');

            ($e->homogenic == -1 )
                ? $homogenic = get_string('no', 'local_group_generator')
                : (($e->homogenic == 0)
                    ? $homogenic = 'Heterogenic'
                    : $homogenic = 'Homogenic');

            ($e->tandem == 0)
                ? $tandem = get_string('no', 'local_group_generator')
                : $tandem = get_string('right', 'local_group_generator');

            ($e->filter == 0)
                ? $filter = get_string('no', 'local_group_generator')
                : $filter = $e->filter;

            $table->data[] = array(
                strval($e->titleteam),
                strval($e->fullname),
                strval($subgroup),
                strval($togglevalue),
                $username,
                $history,
                $filter,
                $homogenic,
                $tandem,
                strval($time),
            );
        }
        return html_writer::table($table);
    }
}

