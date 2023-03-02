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
require_login();

/**
 * Class form to create incompatible tandem.
 */
class incompatible_form extends moodleform {

    /**
     * Define the form.
     */
    public function definition () {
        global $OUTPUT;

        // Find the courses.
        $allcourses3 = array();
        $getcourse3 = get_courses();

        foreach ($getcourse3 as $courses) {
            $allcourses3[$courses->id] = $courses->fullname;
        }
        // End.
        $studentone = array (
            get_string('nostudent', 'local_group_generator'),
        );
        $studenttwo = array (
            get_string('nostudent', 'local_group_generator'),
        );

        $output = '';
        // Start with the object form.
        $output .= $OUTPUT->container_start('', 'contenedor');

        $output .= html_writer::tag('h4', get_string('tandem', 'local_group_generator'), array('class' => 'titol mt-6 ml-6'));
        $output .= html_writer::tag('p', get_string('indications4', 'local_group_generator'), [
            'class' => 'indications3 indications mt-2 ml-6 mb-6'
        ]);

        // Start the form.
        $output .= html_writer::start_tag('form3', [
            'id' => 'form3',
            'class' => 'form3',
            'action' => '',
            'method' => 'post',
            'target' => '_blank'
        ]);

            $output .= html_writer::start_tag('div', [
                'name' => 'custom_formatContainer',
                'id' => 'custom_formatContainer',
                'class' => 'custom_formatContainer d-flex justify-content-start align-items-start'
            ]);

                // Select the course.
                $output .= html_writer::tag('label', get_string('select_course', 'local_group_generator'), [
                    'id' => 'selectCurso3',
                    'class' => 'ml-6 mr-4'
                ]);
                $output .= html_writer::select($allcourses3, 'curso_tandem' , array('id' => 'menu_coursetandem'));

                $output .= html_writer::start_tag('div', [
                    'name' => 'team_Container',
                    'id' => 'team_Container',
                    'class' => 'ml-4 team_Container'
                ]);
                $output .= html_writer::end_tag('div');
            $output .= html_writer::end_tag('div');

        // Start Container.
        $output .= html_writer::start_tag('div', [
            'name' => 'bloc_valueContainer',
            'id' => 'bloc_valueContainer',
            'class' => 'bloc_valueContainer mt-6'
        ]);

            // Student_one.
            $output .= html_writer::start_tag('div', [
                'name' => 'bloc_filter',
                'id' => 'bloc_filter',
                'class' => 'bloc_filter ml-6 mr-3'
            ]);

                $output .= html_writer::tag('h5', get_string('student_one', 'local_group_generator'), array('class' => 'titol'));

                $output .= html_writer::select($studentone, 'student_one', array('id' => 'student_one' , 'class' => 'student_one'));

            $output .= html_writer::end_tag('div');

            // Student_two.
            $output .= html_writer::start_tag('div', [
                'name' => 'bloc_value',
                'id' => 'bloc_value',
                'class' => 'bloc_value ml-6 mr-3'
            ]);

                $output .= html_writer::tag('h5', get_string('student_two', 'local_group_generator'), array('class' => 'titol'));

                $output .= html_writer::select($studenttwo, 'student_two', array('id' => 'student_two' , 'class' => 'student_two'));
            $output .= html_writer::end_tag('div');

            $output .= html_writer::start_tag('div', array('name' => 'buttons',
            'class' => 'buttons_add_rem d-flex justify-content-center align-items-center'));

            // Add button.
                $output .= html_writer::empty_tag('input', [
                    'type' => 'button',
                    'class' => 'btn btn-primary add_btn_tandem rounded px-2 h-1 border-0',
                    'id' => 'add_btn_tandem',
                    'name' => 'add',
                    'value' => get_string("add_button", 'local_group_generator')
                ]);

            $output .= html_writer::end_tag('div');

            // Result container.
            $output .= html_writer::start_tag('div', [
                'name' => 'contenedor_result_tandem',
                'id' => 'contenedor_result_tandem',
                'class' => 'contenedor_result_tandem ml-6 mr-6 pr-3'
            ]);

                $output .= html_writer::tag('h5', get_string('tandem', 'local_group_generator'), array('class' => 'titol'));
                $output .= $OUTPUT->container_start('', 'result_in_tandem', [
                    'class' => 'result_in_tandem bg-light p-2 rounded',
                    'id' => 'result_in_tandem'
                ]);
                $output .= $OUTPUT->container_end();

            $output .= html_writer::end_tag('div');

        $output .= html_writer::end_tag('div');

        // Save & refresh button.
        $output .= html_writer::start_tag('div',
        array('name' => 'save_tandem', 'id' => 'save_tandem', 'class' => 'mt-4 save_tandem d-flex justify-content-center'));
            $output .= html_writer::empty_tag('input', [
                'type' => 'submit',
                'class' => 'rounded save_no_tandem btn btn-primary mr-3 ml-4 border-0',
                'id' => 'save_no_tandem',
                'value' => get_string("save", 'local_group_generator')
            ]);
        $output .= html_writer::end_tag('div');

        $output .= html_writer::end_tag('form');

        $output .= $OUTPUT->container_end();
        $output .= tandem_table();

        return $output;
    }

    /**
     * Extend the form definition after data has been parsed.
     */
    public function definition_after_data() {
        global $USER, $CFG, $DB, $OUTPUT;
        $mform = $this->_form;
    }

    /**
     * to redirect to forum_review
     * @return Void .
     */
    public function reset() {
        redirect(new moodle_url('index.php#incompatible'));
    }

    /**
     * Validate the form data.
     * @param array $usernew
     * @param array $files
     * @return array|bool
     */
    public function validation($usernew, $files) {
        global $CFG, $DB;

        return true;
    }
}

