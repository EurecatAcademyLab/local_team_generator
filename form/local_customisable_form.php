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

$idcourse = optional_param('idcourse', null, PARAM_INT);

/**
 * Class form to create a customisable filter or personal filter.
 */
class customisable_form extends moodleform {

    /**
     * Define the form.
     */
    public function definition() {
        global $OUTPUT;

        /*Find the courses*/
        $allcourses2 = array();
        $getcourse2 = get_courses();

        foreach ($getcourse2 as $courses) {
            $allcourses2[$courses->id] = $courses->fullname;
        }
        // End.

        $output = '';
        // Start with the object form.
        $output .= $OUTPUT->container_start('', 'contenedor');

        $output .= html_writer::tag('h4', get_string('customisable', 'local_group_generator'), array('class' => 'titol mt-6 ml-6'));
        $output .= html_writer::tag('p', get_string('indications3', 'local_group_generator'), [
            'class' => 'indications3 indications mt-2 ml-6 mb-6'
        ]);

        // Start the form.
        $output .= html_writer::start_tag('form2', [
            'id' => 'form2',
            'class' => 'form2',
            'action' => '',
            'method' => 'post',
            'target' => '_blank'
        ]);

         // Select the course.
        $output .= html_writer::start_tag('div' , array('class' => 'd-flex mb-4 mt-2'));
            $output .= html_writer::tag('label', get_string('select_course', 'local_group_generator'), [
                'id' => 'selectCurso2',
                'class' => 'ml-6 mr-4'
            ]);

            $output .= html_writer::select($allcourses2, 'cursofilter' , array('id' => 'menu_coursefilter'));
        $output .= html_writer::end_tag('div');

            $output .= html_writer::start_tag('div', array('name' => 'custom_formatContainer', 'id' => 'custom_formatContainer'));
                $output .= html_writer::start_tag('div', array('id' => 'custom_container',
                'class' => 'custom_container d-flex justify-content-start ml-3'));

                    // Name of the filter.
                    $output .= html_writer::start_tag('div', array('id' => 'div_dad_name' , 'class' => 'div_dad_name'));
                        $output .= html_writer::start_tag('div');
                            $output .= html_writer::tag('label', get_string('name_filter', 'local_group_generator'), [
                                'id' => 'name_filter',
                                'class' => 'ml-6 mr-0'
                            ]);
                            // Valdation.
                            $output .= html_writer::start_tag('div', [
                            'class' => 'valinamefilterContainer ml-6 valifilterclass',
                            'id' => 'valinamefilterContainer'
                            ]);
                            $output .= html_writer::end_tag('div');
                        $output .= html_writer::end_tag('div');

                        $output .= html_writer::start_tag('div', array('id' => 'div_son_name' ,
                        'class' => 'div_son_name ml-3 d-flex flex-column align-items-center'));
                            $output .= html_writer::empty_tag('input', [
                                'type' => 'text',
                                'placeholder' => get_string('typename', 'local_group_generator'),
                                'class' => 'rounded type_name_filter pl-3 d-flex flex-column align-items-center',
                                'size' => "30",
                                'id' => 'type_name_filter'
                            ]);
                            $output .= html_writer::tag('small', get_string('indications1', 'local_group_generator'), [
                                'id' => 'indications',
                                'class' => 'indications'
                            ]);
                        $output .= html_writer::end_tag('div');
                    $output .= html_writer::end_tag('div');

                    // Name of the values from that filter.
                    $output .= html_writer::start_tag('div', array('id' => 'div_dad_value' , 'class' => 'div_dad_value ml-3'));

                        $output .= html_writer::start_tag('div');
                            $output .= html_writer::tag('label', get_string('value_filter', 'local_group_generator'), [
                                'id' => 'value_filter',
                                'class' => 'ml-6 mr-0 '
                            ]);
                            // Valdation.
                            $output .= html_writer::start_tag('div', [
                            'class' => 'valivaluefilterContainer ml-6 valifilterclass',
                            'id' => 'valivaluefilterContainer'
                            ]);
                            $output .= html_writer::end_tag('div');
                        $output .= html_writer::end_tag('div');

                        $output .= html_writer::start_tag('div', array('id' => 'div_son_value' ,
                        'class' => 'div_son_value d-flex flex-column align-items-center'));
                            $output .= html_writer::empty_tag('input', [
                                'type' => 'text',
                                'placeholder' => get_string('typeeach', 'local_group_generator'),
                                'class' => 'ml-3 rounded type_value_filter pl-3',
                                'size' => "30",
                                'id' => 'type_value_filter'
                            ]);
                            $output .= html_writer::tag('small', get_string('indications2', 'local_group_generator'), [
                                'id' => 'indications',
                                'class' => 'indications'
                            ]);
                        $output .= html_writer::end_tag('div');
                    $output .= html_writer::end_tag('div');

                    $output .= html_writer::end_tag('div');
                    $output .= html_writer::end_tag('div');

        // Start Container.
        $output .= html_writer::start_tag('div', [
            'name' => 'bloc_valueContainer',
            'id' => 'bloc_valueContainer',
            'class' => 'bloc_valueContainer mt-6 d-flex justify-content-between'
        ]);

            // Filter name.
            $output .= html_writer::start_tag('div', [
                'name' => 'bloc_filter',
                'id' => 'bloc_filter',
                'class' => 'bloc_filter ml-6 mr-3'
            ]);

                $output .= html_writer::tag('h5', get_string('filter_print', 'local_group_generator'), array('class' => 'titol'));

                $output .= $OUTPUT->container_start('', 'bloc_filtername_conte', [
                    'class' => 'bloc_filtername_conte',
                    'id' => 'bloc_filtername_conte'
                ]);
                $output .= $OUTPUT->container_end();

            $output .= html_writer::end_tag('div');

            // Filter values.
            $output .= html_writer::start_tag('div', [
                'name' => 'bloc_value',
                'id' => 'bloc_value',
                'class' => 'bloc_value ml-6 mr-3'
            ]);

                $output .= html_writer::tag('h5', get_string('values_print', 'local_group_generator'), array('class' => 'titol'));

                $output .= $OUTPUT->container_start('', 'bloc_valueConte' , [
                    'class' => 'bloc_valueConte',
                    'id' => 'bloc_valueConte'
                ]);
                $output .= $OUTPUT->container_end();

            $output .= html_writer::end_tag('div');

            // Students.
            $output .= html_writer::start_tag('div', [
                'name' => 'bloc_student',
                'id' => 'bloc_student',
                'class' => 'bloc_student ml-6 mr-3'
            ]);

                $output .= html_writer::tag('h5', get_string('pupils', 'local_group_generator'), array('class' => 'titol'));

                $output .= $OUTPUT->container_start('', 'bloc_studentConte' , [
                    'class' => 'bloc_studentConte',
                    'id' => 'bloc_studentConte'
                ]);
                $output .= $OUTPUT->container_end();

            $output .= html_writer::end_tag('div');

            // Add button.
            $output .= html_writer::start_tag('div', array('name' => 'buttons' , 'class' => 'buttons_add_rem d-flex flex-column'));
                $output .= html_writer::empty_tag('input', [
                    'type' => 'button',
                    'class' => 'add_button btn btn-primary rounded px-2 h-1 mr-3 ml-4 border-0',
                    'id' => 'add_button',
                    'name' => 'add',
                    'value' => get_string("add_button", 'local_group_generator')
                ]);
                // Remove button.
                $output .= html_writer::empty_tag('input', [
                    'type' => 'button',
                    'class' => 'btn btn-secondary remove_button rounded px-2 h-1 mr-3 ml-4 mt-2 border-0',
                    'id' => 'remove_button',
                    'name' => 'remove',
                    'value' => get_string("remove_button", 'local_group_generator')
                ]);
            $output .= html_writer::end_tag('div');

            // Result container.
            $output .= html_writer::start_tag('div', [
                'name' => 'result_container',
                'id' => 'result_container',
                'class' => 'result_container ml-6 mr-3'
            ]);

                $output .= html_writer::tag('h5', get_string('result', 'local_group_generator'), array('class' => 'titol'));

                $output .= $OUTPUT->container_start('', 'result_personal_filter' , [
                    'class' => 'result_personal_filter p-2 rounded',
                    'id' => 'result_personal_filter'
                ]);

                    // Valdation.
                    $output .= html_writer::start_tag('div', [
                        'class' => 'valiblockfilterContainer ml-6 valifilterclass',
                        'id' => 'valiblockfilterContainer'
                        ]);
                    $output .= html_writer::end_tag('div');
                    $output .= $OUTPUT->container_start('', 'result_personal_filter_title', [
                        'class' => 'result_personal_filter_title d-flex justify-content-center text-dark rounded mb-2',
                        'id' => 'result_personal_filter_title'
                    ]);
                    $output .= $OUTPUT->container_end();

                    $output .= $OUTPUT->container_start('', 'result_personal_filter_list', [
                        'class' => 'result_personal_filter_list',
                        'id' => 'result_personal_filter_list'
                    ]);
                    $output .= $OUTPUT->container_end();

                $output .= $OUTPUT->container_end();

            $output .= html_writer::end_tag('div');

        $output .= html_writer::end_tag('div');

         // Save & refresh button.
        $output .= html_writer::start_tag('div',
        array('id' => 'save_personal',
        'class' => 'save_personal mb-5 d-flex justify-content-end'));
            $output .= html_writer::empty_tag('input', [
                'type' => 'button',
                'class' => 'rounded refresh_personal_filter btn btn-secondary mr-2 border-0',
                'id' => 'refresh_personal_filter',
                'value' => get_string("refresh", 'local_group_generator')
            ]);
            $output .= html_writer::empty_tag('input', [
                'type' => 'button',
                'class' => 'rounded save_personal_filter border-0 btn btn-primary',
                'id' => 'save_personal_filter',
                'value' => get_string("save", 'local_group_generator')
            ]);

        $output .= html_writer::end_tag('div');

        $output .= html_writer::end_tag('form');

        $output .= $OUTPUT->container_end();

        $output .= table_personalFilter();
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


