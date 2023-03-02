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
 * Save in history of Team generator.
 */

require_once(__DIR__.'/../../../../config.php');
require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot.'/lib/formslib.php');
require_login();

$idcourse = optional_param('idc', null, PARAM_INT);
$idgroup = optional_param('idg', null, PARAM_INT);
$toggle = optional_param('t', null, PARAM_INT);
$togglevalue = optional_param('tV', null, PARAM_INT);
$history = optional_param('h', null, PARAM_INT);
$filter = optional_param('filter', null, PARAM_TEXT);
$threshold = optional_param('threshold', null, PARAM_INT);
$idarrayusers = optional_param('idA', null, PARAM_TEXT);
$homogenic = optional_param('homogenic', null, PARAM_INT);
$tandem = optional_param('tandem', null, PARAM_INT);
$valuenametitle = optional_param('vNT', null, PARAM_TEXT);
$keys = optional_param('k', null, PARAM_TEXT);
$arraysplitgroups = optional_param('SplitG', null, PARAM_TEXT);

$arraysplitgroups = json_decode($arraysplitgroups);
$keys = json_decode($keys);
$count = count($arraysplitgroups);
($history === null) ? $history = 0 : $history;
($filter === null) ? $filter = 0 : $filter;

    global $DB;
for ($i = 0; $i < $count; $i++) {

    $record = new stdClass();
    $record->id_user = $idarrayusers;
    $record->id_course = $idcourse;
    $record->id_group = $idgroup;
    $record->toggle  = $toggle;
    $record->toggle_value  = $togglevalue;
    $record->title  = $valuenametitle;
    $record->titleteam  = $keys[$i];
    $record->split_group = implode(",", $arraysplitgroups[$i]);
    $record->history = $history;
    $record->filter = $filter;
    $record->homogenic = $homogenic;
    $record->threshold = $threshold;
    $record->tandem = $tandem;
    $record->timecreated = time();

    $DB->insert_record('local_group_generator', $record);
}

\core\notification::add(get_string('success', 'local_group_generator'), \core\output\notification::NOTIFY_INFO);

    echo 'Success';

