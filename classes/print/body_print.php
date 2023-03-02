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

require_once($CFG->dirroot.'/lib/formslib.php');
require_once("$CFG->dirroot/enrol/locallib.php");
require_once("$CFG->dirroot/local/group_generator/classes/table/table.php");
require_once("$CFG->dirroot/local/group_generator/classes/table/tandem_table.php");
require_once("$CFG->dirroot/local/group_generator/classes/table/personal_table.php");

/**
 * To display the html tag body, with form and table instances.
 * @return String to print.
 */
function print_body() {
    $selectform = new group_form();
    $incompatibleform = new incompatible_form();
    $customisableform = new customisable_form();

    $output = "";
        $output .= html_writer::start_tag('div', ['class' => 'tab-content']);
            $output .= html_writer::start_tag('div', ['class' => 'tab-pane fade show active', 'id' => 'group_generator']);
                $output .= html_writer::start_tag('div', ['class' => 'p-1']);
                $output .= $selectform->definition();
                $output .= html_writer::end_tag('div');
            $output .= html_writer::end_tag('div');

            $output .= html_writer::start_tag('div', ['class' => 'tab-pane fade', 'id' => 'customisable']);
                $output .= $customisableform->definition();
            $output .= html_writer::end_tag('div');

            $output .= html_writer::start_tag('div', ['class' => 'tab-pane fade', 'id' => 'incompatible']);
                $output .= $incompatibleform->definition();
            $output .= html_writer::end_tag('div');

            $output .= html_writer::start_tag('div', ['class' => 'tab-pane fade', 'id' => 'history']);
                $output .= tablegroup();
            $output .= html_writer::end_tag('div');

        $output .= html_writer::end_tag('div');
    echo $output;
}

