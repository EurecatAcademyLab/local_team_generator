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


require_once('../../config.php');
require_once($CFG->dirroot. '/local/group_generator/form/local_group_form.php');
require_once($CFG->dirroot. '/local/group_generator/form/local_gg_form.php');
require_once($CFG->dirroot. '/local/group_generator/form/local_customisable_form.php');
require_once($CFG->dirroot. '/local/group_generator/form/local_incompatible.php');
require_once($CFG->dirroot. '/local/group_generator/classes/print/nav_bar.php');
require_once($CFG->dirroot. '/local/group_generator/classes/print/body_print.php');

$context = context_system::instance();

$PAGE->set_context($context);
$PAGE->set_url(new moodle_url('/local/group_generator/index.php'));
$PAGE->set_pagelayout('admin');
$PAGE->set_title($SITE->fullname);
$title = get_string('pluginname', 'local_group_generator');
$PAGE->set_heading($title);

$PAGE->requires->js('/local/group_generator/amd/js_creategroup.js');
$PAGE->requires->js('/local/group_generator/amd/js_tandem.js');
$PAGE->requires->js('/local/group_generator/amd/js_filter.js');
$PAGE->requires->js('/local/group_generator/amd/module.js');
$PAGE->requires->js('/local/group_generator/amd/js_helpButton.js');
$PAGE->requires->jquery();

$PAGE->requires->css( new moodle_url($CFG->wwwroot . '/local/group_generator/css/style_group.css') );

$PAGE->requires->css(new \moodle_url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css'));
$PAGE->requires->js(new \moodle_url("https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"), true);
$PAGE->requires->js(new \moodle_url("https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"), true);

// $urlcss = "https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.2/af-2.5.2/b-2.3.4/b-colvis-2.3.4/b-html5-2.3.4/b-print-2.3.4/";
// $urlcss2 = "cr-1.6.1/date-1.3.0/fc-4.2.1/fh-3.3.1/kt-2.8.1/r-2.4.0/rg-1.3.0/rr-1.3.2/sc-2.1.0/sb-1.4.0/sp-2.1.1/sl-1.6.0";
// $urlcss3 = "/sr-1.2.1/datatables.min.css";
// $PAGE->requires->css(new \moodle_url($urlcss + $urlcss2 + $urlcss3));
$PAGE->requires->css(new \moodle_url("https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.2/af-2.5.2/b-2.3.4/b-colvis-2.3.4/b-html5-2.3.4/b-print-2.3.4/cr-1.6.1/date-1.3.0/fc-4.2.1/fh-3.3.1/kt-2.8.1/r-2.4.0/rg-1.3.0/rr-1.3.2/sc-2.1.0/sb-1.4.0/sp-2.1.1/sl-1.6.0/sr-1.2.1/datatables.min.css"));



// $urljs = "https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.2/af-2.5.2/b-2.3.4/b-colvis-2.3.4/b-html5-2.3.4/b-print-2.3.4";
// $urljs2 = "/cr-1.6.1/date-1.3.0/fc-4.2.1/fh-3.3.1/kt-2.8.1/r-2.4.0/rg-1.3.0/rr-1.3.2/sc-2.1.0/sb-1.4.0/sp-2.1.1/sl-1.6.0/";
// $urljs3 = "sr-1.2.1/datatables.min.js";
// $PAGE->requires->js(new \moodle_url($urljs + $urljs2 + $urljs3), true);
$PAGE->requires->js(new \moodle_url("https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.2/af-2.5.2/b-2.3.4/b-colvis-2.3.4/b-html5-2.3.4/b-print-2.3.4/cr-1.6.1/date-1.3.0/fc-4.2.1/fh-3.3.1/kt-2.8.1/r-2.4.0/rg-1.3.0/rr-1.3.2/sc-2.1.0/sb-1.4.0/sp-2.1.1/sl-1.6.0/sr-1.2.1/datatables.min.js"), true);



require_login();

if (isguestuser()) {
    throw new moodle_exception('noguest');
}

echo $OUTPUT->header();
print_navbar();
print_body();

echo $OUTPUT->footer();

