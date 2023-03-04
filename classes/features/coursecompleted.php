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


$result = getcompletition($idarrayusers, $idcourse);
echo json_encode($result);

/**
 * To get the completition.
 * @param Array $idarrayusers users in a course.
 * @param Mixed $idcourse int value.
 * @return Object to create the result.
 */
function getcompletition($idarrayusers, $idcourse) {

    $completition = [];
    var_dump($idarrayusers);
    foreach ($idarrayusers as &$userid) {
        $completition[$userid] = getusercompletition($userid, $idcourse);
    }
    var_dump($completition);
    $response = new \stdClass();
    $response->completition = $completition;
    $response->mean_course = mean_array($completition);
    return $response;
}

/**
 * To get the completition by user.
 * @param Int $iduser users in a course.
 * @param Mixed $idcourse to get the course.
 * @return Int get an averag .
 */
function getusercompletition($iduser, $idcourse) {
    global $DB;

    $sql = 'SELECT
    g.id AS activityid,
    gi.id AS itemid,
    sum(case when g.finalgrade is null then 1 else 0 end) count_nulls
    , count(g.finalgrade) count_not_nulls
    FROM mdl_user u
    JOIN mdl_grade_grades g ON g.userid = u.id
    JOIN mdl_grade_items gi ON g.itemid =  gi.id
    JOIN mdl_course c ON c.id = gi.courseid
    WHERE gi.courseid  = '.$idcourse.' AND u.id ='.$iduser.'
    AND gi.itemtype != "course"';

    $record = $DB->get_record_sql($sql);

    $completed = 0;
    $numofactivities = $record->count_nulls + $record->count_not_nulls;
    if ($numofactivities == 0) {
        return $completed;
    }

    $completed = ($record->count_not_nulls / ($numofactivities)) * 100;

    return $completed;
}

/**
 * To get average.
 * @param Array $a completition.
 * @return (Int | Float).
 */
function mean_array($a) {
    if (array_sum($a) == 0) {
        return 0;
    }
    return array_sum($a) / count($a);
}

