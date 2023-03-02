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

/**
 * To display the navbar inside the plugin.
 * @return String to print.
 */
function print_navbar() {

    $output = "";

    $output .= html_writer::start_tag('div' , ['class' => 'nav_tabs_group ml-4 mb-4']);
    $output .= html_writer::start_tag('ul', ["class" => 'nav nav-tabs ', 'role' => "tablist"]);

        $output .= html_writer::start_tag('li', ['class' => 'nav-item waves-effect waves-light']);
            $output .= html_writer::tag('a', get_string('pluginname', 'local_group_generator'),
            ['class' => 'nav-link text-primary nav_group',
            'data-toggle' => "tab",
            'href' => "#group_generator"]);
        $output .= html_writer::end_tag('li');
        $output .= html_writer::start_tag('li', ['class' => 'nav-item waves-effect waves-light']);
            $output .= html_writer::tag('a', get_string('customisable', 'local_group_generator'),
            ['class' => 'nav-link text-primary nav_group',
            'data-toggle' => "tab",
            'href' => "#customisable"]);
        $output .= html_writer::end_tag('li');
        $output .= html_writer::start_tag('li', ['class' => 'nav-item waves-effect waves-light']);
            $output .= html_writer::tag('a', get_string('incompatible', 'local_group_generator'),
            ['class' => 'nav-link text-primary nav_group',
            'data-toggle' => "tab",
            'href' => "#incompatible"]);
        $output .= html_writer::end_tag('li');
        $output .= html_writer::start_tag('li', ['class' => 'nav-item waves-effect waves-light']);
            $output .= html_writer::tag('a', get_string('history', 'local_group_generator'),
            ['class' => 'nav-link text-primary nav_group',
            'data-toggle' => "tab",
            'href' => "#history",
            "id" => "to_history"]);
        $output .= html_writer::end_tag('li');

    $output .= html_writer::end_tag('ul');
    $output .= html_writer::end_tag('div');
    echo $output;
}

