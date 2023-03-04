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
 * @author      2022 Aina Palacios
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @copyright   2022 Aina Palacios & Eurecat.dev
 */


require_once(__DIR__.'/../../../../config.php');
require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot.'/lib/formslib.php');
require_login();

$idarrayusers = optional_param_array('idarray', null, PARAM_TEXT);
$idcourse = optional_param('idcourse', null, PARAM_INT);

$result = var_dump( getgradesmean($idarrayusers, $idcourse));

/**
 * To get the completition by user.
 * @param Array $arrayuserid users in a course.
 * @param Mixed $courseid to get the course.
 * @return Object get an averag .
 */
function getgradesmean($arrayuserid, $courseid) {
    $grade = [];
    foreach ($arrayuserid as &$userid) {
        $grades = getgradesuser($userid, $courseid);
        $meangrades = mean_array($grades);
        $grade[$userid] = $meangrades;
    }
    $response = new \stdClass();
    $response->grades = $grade;
    $response->mean_course = mean_array($grade);

    return $response;
}

/**
 * To get the completition by user.
 * @param Array $userid users in a course.
 * @param Mixed $courseid to get the course.
 * @return Array get an averag .
 */
function getgradesuser($userid, $courseid) {

    global $DB;

    $sql = 'SELECT
    g.id AS activityid,
    u.id AS userid,
    u.username AS studentid,
    gi.id AS itemid,
    c.shortname AS courseshortname,
    gi.itemname AS itemname,
    gi.grademax AS itemgrademax,
    gi.aggregationcoef AS itemaggregation,
    g.finalgrade AS finalgrade
    FROM mdl_user u
    JOIN mdl_grade_grades g ON g.userid = u.id
    JOIN mdl_grade_items gi ON g.itemid =  gi.id
    JOIN mdl_course c ON c.id = gi.courseid
    WHERE gi.courseid  = '.$courseid.' AND u.id ='.$userid.' AND
    gi.itemtype != "course"
    AND finalgrade IS NOT NULL';

    $records = $DB->get_records_sql($sql);

    if (is_null($records)) {
        $grades = [0];
    } else {

        $grades = [];

        foreach ($records as $key => $record) {
            $grade10 = ($record->finalgrade / $record->itemgrademax) * 10;
            array_push($grades, $grade10);
        }
    }
    return $grades;
}

/**
 * To get the average.
 * @param Array $a .
 * @return Int get an averag .
 */
function mean_array($a) {
    if (array_sum($a) == 0) {
        return 0;
    }
    return array_sum($a) / count($a);
}


