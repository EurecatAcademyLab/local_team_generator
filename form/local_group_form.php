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
require_once($CFG->dirroot."/enrol/locallib.php");

/**
 * Class form to create teams. Mean form.
 */
class group_form extends moodleform {

    /**
     * Define the fields in the form.
     */
    public function definition() {

        global $OUTPUT;

        $output = '';

        $formattosplit = array(
            get_string('byGroups', 'local_group_generator'),
            get_string('byStudents', 'local_group_generator')
        );

        $personalfilter = array (
            get_string('none', 'local_group_generator'), 'attr' => "checked"
        );

        // Find the courses.
        $allcourses = array();
        $getcourse = get_courses();

        foreach ($getcourse as $courses) {
            $allcourses[$courses->id] = $courses->fullname;
        }
        // End.

        // Find a group on the courses.
        $formatgroup = array();

        // End.

        // Start with the object form.
        $output .= $OUTPUT->container_start('', 'contenedor');
        $tis = get_string('title_indications', 'local_group_generator');
        $output .= html_writer::tag('h4', $tis, array('class' => 'titol mt-3 ml-6 mb-4'));

        // Start the form.
        $output .= html_writer::start_tag('form', array('id' => 'form1', 'action' => '', 'method' => 'post', 'target' => '_blank'));

        // Select a title.
        $output .= html_writer::start_tag('div', [
            'name' => 'selecttitleContainer',
            'id' => 'selecttitleContainer',
            'class' => 'selecttitleContainer mb-2 d-flex align-items-start'
        ]);
        $output .= html_writer::start_tag('div', array('class' => 'C01', 'id' => 'C01'));
        $output .= html_writer::start_tag('div', array('class' => 'C02', 'id' => 'C02'));

        $output .= html_writer::tag('label', get_string('select_title', 'local_group_generator'), [
            'id' => 'selectTitle',
            'class' => 'ml-6 mr-0 mb-0'
        ]);

        // Help button.
        $output .= html_writer::tag('i', '' , [
            'class' => 'fa fa-question-circle textinfo text-info mt-1',
            'id' => 'text_selectTitle'
        ]);
        $output .= html_writer::start_tag('div', array('class' => 'explain_title_container', 'id' => 'explain_title_container'));
            $output .= html_writer::tag('label', get_string('explain_title', 'local_group_generator'), [
                'class' => 'explain_title explain',
                'id' => 'explain_title'
            ]);
        $output .= html_writer::end_tag('div');

        $output .= html_writer::end_tag('div');

        // Validation.
        $output .= html_writer::start_tag('div', [
            'class' => 'valiTitleContainer ml-6 validationclass',
            'id' => 'valiTitleContainer'
        ]);
        $output .= html_writer::end_tag('div');

        $output .= html_writer::end_tag('div');
        $output .= html_writer::empty_tag('input', [
            'type' => 'text',
            'placeholder' => get_string('sti', 'local_group_generator'),
            'class' => 'ml-3 py-1 px-2 rounded type_name_filter',
            'size' => "20",
            'id' => 'typeNameFilter'
        ]);
        $output .= html_writer::end_tag('div');

        // Select a course  and a group course.
        $output .= html_writer::start_tag('div', array('name' => 'blocCursoContainer', 'id' => 'blocCursoContainer'));
            $output .= html_writer::start_tag('div',
            ['id' => 'CursoContainer',
            'class' => 'mt-3 CursoContainer d-flex align-items-start']);

        // Select the course.
        $output .= html_writer::start_tag('div', [
            'name' => 'selectcourseContainer',
            'id' => 'selectcourseContainer',
            'class' => 'selectcourseContainer d-flex align-items-start'
        ]);
            $output .= html_writer::start_tag('div', array('class' => 'C1', 'id' => 'C1'));
                $output .= html_writer::start_tag('div', array('class' => 'C2', 'id' => 'C2'));

                $output .= html_writer::tag('label', get_string('select_course', 'local_group_generator'), [
                    'id' => 'selectCurso',
                    'class' => 'ml-6 mr-0 mb-0'
                ]);

                    // Help button.
                    $output .= html_writer::tag('i', '' , [
                        'class' => 'fa fa-question-circle textinfo text-info mt-1',
                        'id' => 'text_selectCurso'
                    ]);
                    $output .= html_writer::start_tag('div', [
                        'class' => 'explain_course_container explain',
                        'id' => 'explain_course_container',
                        'name' => 'explain_course_container'
                    ]);
                        $output .= html_writer::tag('label', get_string('explain_course', 'local_group_generator'), [
                            'class' => 'explain_course',
                            'id' => 'explain_course'
                        ]);
                    $output .= html_writer::end_tag('div');

                $output .= html_writer::end_tag('div');

                // Validation.
                $output .= html_writer::start_tag('div', [
                    'class' => 'valiCourseContainer ml-6 validationclass',
                    'id' => 'valiCourseContainer'
                ]);
                $output .= html_writer::end_tag('div');

            $output .= html_writer::end_tag('div');

            $output .= html_writer::select($allcourses, 'curso' , array('attr' => "required", 'class' => "required"));
        $output .= html_writer::end_tag('div');

        // Select the group of the course.
        $output .= html_writer::start_tag('div',
        ['id' => 'group_course',
        'class' => 'group_course']);
            $output .= html_writer::start_tag('div', array('id' => 'group_course_container', 'class' => 'group_course_container'));

                $output .= html_writer::start_tag('div', array('class' => 'C3 d-flex flex-column', 'id' => 'C3'));
                    $output .= html_writer::start_tag('div', array('class' => 'C4', 'id' => 'C4'));

                    $output .= html_writer::tag('label', get_string('select_group_cour', 'local_group_generator'), [
                        'id' => 'select_group',
                        'class' => 'ml-6 mr-2 mb-0'
                    ]);

                        // Help button.
                        $output .= html_writer::tag('i', '' , [
                            'class' => 'fa fa-question-circle textinfo text-info mt-1',
                            'id' => 'text_groupcourse'
                        ]);
                        $output .= html_writer::start_tag('div', [
                            'class' => 'explain_groupcourse_container explain',
                            'id' => 'explain_groupcourse_container'
                        ]);
                            $output .= html_writer::tag('label', get_string('explain_groupcour', 'local_group_generator'), [
                                'class' => 'explain_groupcourse explain',
                                'id' => 'explain_groupcourse'
                            ]);
                        $output .= html_writer::end_tag('div');

                    $output .= html_writer::end_tag('div');

                    // Validation.
                    $output .= html_writer::start_tag('div', [
                        'class' => 'valiCourseGroupContainer ml-6 validationclass',
                        'id' => 'valiCourseGroupContainer'
                    ]);
                    $output .= html_writer::end_tag('div');

                $output .= html_writer::end_tag('div');
            $output .= html_writer::end_tag('div');

            $output .= html_writer::select($formatgroup, 'formato');

        $output .= html_writer::end_tag('div');

        $output .= html_writer::end_tag('div');
        $output .= html_writer::end_tag('div');

        // Select a way to split.
        $output .= html_writer::start_tag('div', array('name' => 'blocFormatContainer', 'id' => 'blocFormatContainer'));
            $output .= html_writer::start_tag('div',
            ['id' => 'FormatoContainer',
            'class' => 'FormatoContainer mb-2 d-flex align-items-center']);

        // Select the way to split (by student or by group).
        $output .= html_writer::start_tag('div', [
            'id' => 'div_formato_split',
            "class" => 'div_formato_split d-flex justify-content-start mt-4 mb-4'
        ]);

            $output .= html_writer::start_tag('div', array('class' => 'C5 d-flex flex-column', 'id' => 'C5'));
                $output .= html_writer::start_tag('div', array('class' => 'C6', 'id' => 'C6'));
                $output .= html_writer::tag('label', get_string('groupsChoises', 'local_group_generator'), [
                    'class' => 'ml-6 mb-0',
                    'id' => 'groupsChoises',
                    'name' => 'groupsChoises'
                ]);

                    // Help button.
                    $output .= html_writer::tag('i', '' , [
                        'class' => 'fa fa-question-circle textinfo text-info mt-1',
                        'id' => 'text_formatsplit'
                    ]);
                    $output .= html_writer::start_tag('div',
                    [
                        'class' => 'explain_formatsplit_container explain d-inline-block',
                        'id' => 'explain_formatsplit_container'
                    ]);
                        $output .= html_writer::tag('label', get_string('explain_formatsplit', 'local_group_generator'), [
                            'class' => 'explain_formatsplit explain',
                            'id' => 'explain_formatsplit'
                        ]);
                    $output .= html_writer::end_tag('div');
                $output .= html_writer::end_tag('div');

                // Validation.
                $output .= html_writer::start_tag('div', [
                    'class' => 'valiFormatContainer ml-6 validationclass',
                    'id' => 'valiFormatContainer'
                ]);
                $output .= html_writer::end_tag('div');

            $output .= html_writer::end_tag('div');

            $output .= html_writer::select($formattosplit, 'formatoToSplit', [
                'class' => 'formatoToSplit mt-4',
                'required',
                'id' => 'formatoToSplit',
                'attr' => "required"
            ]);
        $output .= html_writer::end_tag('div');

        // By student.
        $output .= html_writer::start_tag('div',
        ['id' => 'byStudent',
        'class' => 'none byStudent']);
            $output .= html_writer::start_tag('div', array('class' => 'C7 d-flex flex-column', 'id' => 'C7'));
                $output .= html_writer::start_tag('div', array('class' => 'C8', 'id' => 'C8'));
                $output .= html_writer::tag('label', get_string('manyStudent', 'local_group_generator'), [
                    'id' => 'get_student_selector1',
                    'class' => 'ml-6 mb-0'
                ]);

                    // Help button.
                    $output .= html_writer::tag('i', '', [
                        'class' => 'fa fa-question-circle textinfo text-info mt-1',
                        'id' => 'text_bystudent'
                    ]);
                    $output .= html_writer::start_tag('div', [
                        'class' => 'explain_bystudent_container explain',
                        'id' => 'explain_bystudent_container'
                    ]);
                        $output .= html_writer::tag(
                            'label',
                            get_string('explain_bystudent', 'local_group_generator'),
                            array('class' => 'explain_bystudent explain', 'id' => 'explain_bystudent'));
                    $output .= html_writer::end_tag('div');
                $output .= html_writer::end_tag('div');

                // Validation.
                $output .= html_writer::start_tag('div', [
                    'class' => 'valiStudentsContainer validationclass ml-6',
                    'id' => 'valiStudentsContainer'
                ]);
                $output .= html_writer::end_tag('div');

            $output .= html_writer::end_tag('div');

            $output .= html_writer::empty_tag('input', [
                'type' => 'text',
                'id' => 'numberByStudent',
                'class' => 'rounded ml-2',
                'maxlength' => "3",
                'min' => '0',
                'size' => "3"
            ]);
        $output .= html_writer::end_tag('div');

        // By group.
        $output .= html_writer::start_tag('div', array('id' => 'byGroup', 'class' => ' none byGroup'));

            $output .= html_writer::start_tag('div', array('class' => 'C9 d-flex flex-column', 'id' => 'C9'));
                    $output .= html_writer::start_tag('div', array('class' => 'C10', 'id' => 'C10'));
                        $output .= html_writer::tag(
                            'label',
                            get_string('manyGroups', 'local_group_generator'),
                            array('class' => 'ml-6 mb-0')
                        );

                        // Help button.
                        $output .= html_writer::tag('i', '' , [
                            'class' => 'fa fa-question-circle textinfo text-info mb-1',
                            'id' => 'text_bygroup'
                        ]);
                        $output .= html_writer::start_tag('div', [
                            'class' => 'explain_bygroup_container explain',
                            'name' => 'explain_bygroup_container',
                            'id' => 'explain_bygroup_container'
                        ]);
                            $output .= html_writer::tag(
                                'label',
                                get_string('explain_bygroup', 'local_group_generator'),
                                array('class' => 'explain_bygroup explain', 'id' => 'explain_bygroup'));
                        $output .= html_writer::end_tag('div');

                    $output .= html_writer::end_tag('div');

                    // Validation.
                    $output .= html_writer::start_tag('div', [
                        'class' => 'valiGroupContainer validationclass ml-6',
                        'id' => 'valiGroupContainer'
                    ]);
                    $output .= html_writer::end_tag('div');

            $output .= html_writer::end_tag('div');

            $output .= html_writer::empty_tag('input', [
                'type' => 'text',
                'id' => 'number_by_group',
                'class' => 'rounded my-2 ml-2',
                'maxlength' => "3",
                'min' => '0',
                'size' => "3"
            ]);
        $output .= html_writer::end_tag('div');

        $output .= html_writer::end_tag('div');
        $output .= html_writer::end_tag('div');

        // More filter button.
        $output .= html_writer::start_tag('div',
        ['id' => 'more_container',
        'class' => 'more_container ml-4 d-flex justify-content-start',
        'required']);

        $output .= html_writer::tag('p', get_string('more_filter', 'local_group_generator'), [
            'class' => 'more_filter rounded px-2 h-1 ml-3 text-muted',
            'id' => 'moreFilter',
            'name' => 'more_filter'
        ]);
            $output .= html_writer::end_tag('p');

            $output .= html_writer::tag('p', get_string("less_filter", 'local_group_generator'), [
                'type' => 'button',
                'class' => 'less_filter rounded px-2 h-1 ml-3 text-muted',
                'id' => 'lessFilter'
            ]);
            $output .= html_writer::end_tag('p');

        $output .= html_writer::end_tag('div');

        // Select with or without history / create and refresh botton.
        $output .= html_writer::start_tag('div', [
            'name' => 'history_container',
            'id' => 'history_container',
            'class' => 'history_container mb-3 pt-1 pb-4',
            'required'
        ]);

        $output .= html_writer::start_tag('div', [
            'id' => 'FormatoContainer_history',
            'class' => 'FormatoContainer_history d-flex align-items-center'
        ]);

                // Checkbox with history.
                $output .= html_writer::start_tag('div', [
                    'id' => 'history_text_container',
                    'class' => 'history_text_container d-flex'
                ]);

                    $output .= html_writer::start_tag('div',
                    ['id' => 'history_santi',
                    'class' => 'history_santi d-flex flex-column']);

                    $output .= html_writer::tag('label', get_string("with_history", 'local_group_generator'), [
                        'class' => 'ml-6 mr-1',
                        'id' => 'with_history_label',
                        'name' => 'with_history mb-0'
                    ]);
                        $output .= html_writer::tag('small', get_string("santi", 'local_group_generator'), [
                            'class' => 'ml-6 mr-1 santi text-muted',
                            'id' => 'santi'
                        ]);

                    $output .= html_writer::end_tag('div');

                    // Help button.
                    $output .= html_writer::tag('i', '' , [
                        'class' => 'fa fa-question-circle textinfo text-info mt-1',
                        'id' => 'text_history'
                    ]);
                    $output .= html_writer::start_tag('div', [
                        'class' => 'explain_history_container explain',
                        'id' => 'explain_history_container'
                    ]);
                        $output .= html_writer::tag(
                            'label',
                            get_string('explainhisto', 'local_group_generator'),
                            array('class' => 'explain_history explain', 'id' => 'explain_history'));
                    $output .= html_writer::end_tag('div');

                $output .= html_writer::end_tag('div');

                // Checkbox.
                $output .= html_writer::empty_tag(
                    'input',
                    array(
                        'type' => 'checkbox',
                        'id' => 'with_history',
                        'class' => 'rounded with_history ml-4 mr-6'
                    )
                );

            $output .= html_writer::end_tag('div');
        $output .= html_writer::end_tag('div');

        // Incompatible tandem.
        $output .= html_writer::start_tag('div', [
            'name' => 'incompatible_container',
            'id' => 'incompatible_container',
            'class' => 'incompatible_container my-3 pb-3',
            'required'
        ]);
            $output .= html_writer::start_tag('div',
            ['id' => 'incompatible_checkbox',
            'class' => 'incompatible_checkbox d-flex']);
                $output .= html_writer::tag('label', get_string("tandem", 'local_group_generator'), [
                    'class' => 'ml-6 mr-1',
                    'id' => 'incompatible_label',
                    'name' => 'with_incompatible'
                ]);

                // Help button.
                $output .= html_writer::tag('i', '' , [
                    'class' => 'fa fa-question-circle textinfo text-info mt-1',
                    'id' => 'text_tandem'
                ]);
                $output .= html_writer::start_tag('div', [
                    'class' => 'explain_tandem_container explain',
                    'id' => 'explain_tandem_container'
                ]);
                    $output .= html_writer::tag('label', get_string('explain_tandem', 'local_group_generator'), [
                        'class' => 'explain_tandem explain',
                        'id' => 'explain_tandem'
                    ]);
                $output .= html_writer::end_tag('div');

                $output .= html_writer::empty_tag('input', [
                    'type' => 'checkbox',
                    'id' => 'incompatible_tandem',
                    'class' => 'rounded incompatible_tandem ml-4 mr-6',
                    'name' => 'incompatible_tandem'
                ]);
            $output .= html_writer::end_tag('div');
        $output .= html_writer::end_tag('div');

        // Select customisable filter.
        $output .= html_writer::start_tag('div', [
            'name' => 'personal_filter_container',
            'id' => 'personal_filter_container',
            'class' => 'personal_filter_container mb-2 mt-4 ml-6 mr-1',
            'required'
        ]);
            $output .= html_writer::start_tag('div', [
                'id' => 'filterContainer_cooperative',
                'class' => 'filterContainer_cooperative d-flex align-items-center justify-content-start'
            ]);
                 // Personal filter.
                $output .= html_writer::start_tag('div',
                ['id' => 'personal_filter',
                'class' => 'personal_filter d-flex pb-3']);
                    $output .= html_writer::tag('label', get_string('select_personal_filter', 'local_group_generator'), [
                        'id' => 'select_personal_filter',
                        'class' => 'select_personal_filter'
                    ]);

                    // Help button.
                    $output .= html_writer::tag('i', '' , [
                        'class' => 'fa fa-question-circle textinfo text-info mt-1',
                        'id' => 'text_personalfilter'
                    ]);
                    $output .= html_writer::start_tag('div', [
                        'class' => 'explain_personalfilter_container explain',
                        'id' => 'explain_personalfilter_container'
                    ]);
                        $output .= html_writer::tag('label', get_string('explain_personalfilter', 'local_group_generator'), [
                            'class' => 'explain_personalfilter explain',
                            'id' => 'explain_personalfilter'
                        ]);
                    $output .= html_writer::end_tag('div');

                    $output .= html_writer::select($personalfilter,
                    'personal_filter', [
                        'id' => 'option_personal_filter',
                        'class' => 'option_personal_filter w-auto'
                    ]);
                $output .= html_writer::end_tag('div');

                // Select heterogenic /homogenic group.
                $output .= html_writer::start_tag('div', [
                    'id' => 'custom_filter_cooperative',
                    'class' => 'custom_filter_cooperative ml-3 mr-3'
                ]);
                    // Homogenic group.
                    $output .= html_writer::start_tag('div',
                    ['id' => 'homogenic', 'class' => 'd-flex align-items-center mr-1' ]);
                        $output .= html_writer::tag('label', get_string("homogenic", 'local_group_generator'), [
                            'class' => 'ml-6 mr-1',
                            'id' => 'homogenic_label',
                            'name' => 'homogenic_group_checkbox'
                        ]);

                        // Help button.
                        $output .= html_writer::tag('i', '' , [
                            'class' => 'fa fa-question-circle textinfo text-info mb-2',
                            'id' => 'text_homogenic'
                        ]);
                        $output .= html_writer::start_tag('div', [
                            'class' => 'explain_homogenic_container explain',
                            'id' => 'explain_homogenic_container'
                        ]);
                            $output .= html_writer::tag('label', get_string('explain_homogenic', 'local_group_generator'), [
                                'class' => 'explain_homogenic',
                                'id' => 'explain_homogenic'
                            ]);
                        $output .= html_writer::end_tag('div');
                        $output .= html_writer::empty_tag('input', [
                            'type' => 'radio',
                            'id' => 'homogenic_checkbox',
                            'class' => 'rounded homogenic_checkbox ml-3',
                            'name' => 'cooperative_group_checkbox'
                        ]);
                    $output .= html_writer::end_tag('div');

                    // Heterogenic group.
                    $output .= html_writer::start_tag('div',
                    ['id' => 'heterogenic', 'class' => 'd-flex align-items-center mr-1']);
                        $output .= html_writer::tag('label', get_string("heterogenic", 'local_group_generator'), [
                            'class' => 'ml-6 mr-1',
                            'id' => 'heterogenic_label',
                            'name' => 'heterogenic_checkbox'
                        ]);

                        // Help button.
                        $output .= html_writer::tag('i', '' , [
                            'class' => 'fa fa-question-circle textinfo text-info mb-2',
                            'id' => 'text_heterogenic'
                        ]);
                        $output .= html_writer::start_tag('div', [
                            'class' => 'explain_heterogenic_container explain',
                            'id' => 'explain_heterogenic_container'
                        ]);
                            $output .= html_writer::tag('label', get_string('explain_heterogen', 'local_group_generator') , [
                                'class' => 'explain_heterogenic explain',
                                'id' => 'explain_heterogenic'
                            ]);
                        $output .= html_writer::end_tag('div');

                        $output .= html_writer::empty_tag('input', [
                            'type' => 'radio',
                            'id' => 'heterogenic_checkbox',
                            'name' => 'cooperative_group_checkbox',
                            'class' => 'rounded heterogenic_checkbox ml-3'
                        ]);
                    $output .= html_writer::end_tag('div');
                $output .= html_writer::end_tag('div');

                // By filter.
                $output .= html_writer::start_tag('div',
                ['id' => 'threshold_container',
                'class' => 'threshold_container ml-3']);
                $output .= html_writer::start_tag('div', array('class' => 'C11', 'id' => 'C01'));
                $output .= html_writer::start_tag('div', array('class' => 'C12', 'id' => 'C02'));
                    $output .= html_writer::tag('label', get_string('threshold',  'local_group_generator'), [
                        'id' => 'threshold_selector',
                        'class' => 'threshold_selector'
                    ]);

                    // Help button.
                    $output .= html_writer::tag('i', '' , [
                        'class' => 'fa fa-question-circle textinfo text-info mt-1',
                        'id' => 'text_threshold'
                    ]);
                    $output .= html_writer::start_tag('div', [
                        'class' => 'explain_threshold_container explain',
                        'id' => 'explain_threshold_container'
                    ]);
                        $output .= html_writer::tag('label', get_string('explain_threshold', 'local_group_generator'), [
                            'class' => 'explain_threshold explain',
                            'id' => 'explain_threshold'
                        ]);
                    $output .= html_writer::end_tag('div');
                       // Validation.
                        $output .= html_writer::start_tag('div', [
                        'class' => 'valifilterContainer ml-6 validationclass',
                        'id' => 'valifilterContainer'
                        ]);
                    $output .= html_writer::end_tag('div');

                    $output .= html_writer::end_tag('div');
                    $output .= html_writer::end_tag('div');

                    $output .= html_writer::empty_tag('input', [
                        'type' => 'text',
                        'id' => 'threshold_type',
                        'class' => 'rounded threshold_type ml-2',
                        'name' => 'add',
                        'maxlength' => "3",
                        'size' => '3'
                    ]);
                    $output .= html_writer::tag('p',
                    get_string("avgcourse", 'local_group_generator'),
                    array('class' => 'ml-2')
                );
                    $output .= html_writer::start_tag('div', array(
                        'id' => 'meancourse',
                        'class' => 'ml-2'
                    ));
                    $output .= html_writer::end_tag('div');
                $output .= html_writer::end_tag('div');

            $output .= html_writer::end_tag('div');
        $output .= html_writer::end_tag('div');

        // Create button.
        $output .= html_writer::start_tag('div',
        array('id' => 'create_refresh',
        'class' => 'create_refresh <mt-5></mt-5> d-flex justify-content-center align-items-center'));
            $output .= html_writer::start_tag('div',
            ['id' => 'create_refresh_div',
            'class' => 'create_refresh_div d-flex justify-content-center align-items-end']);
                $output .= html_writer::empty_tag('input', [
                    'type' => 'button',
                    'class' => 'create btn btn-primary rounded border-0 text-white p-2 h-1',
                    'id' => 'create_button',
                    'name' => 'create',
                    'value' => get_string("create", 'local_group_generator')
                ]);
            $output .= html_writer::end_tag('div');
        $output .= html_writer::end_tag('div');

        // Start Container.
        $output .= html_writer::start_tag('div', [
            'name' => 'blocAssignContainer',
            'id' => 'blocAssignContainer',
            'class' => 'blocAssignContainer mt-4 d-flex justify-content-between'
        ]);
            $output .= html_writer::start_tag('div', [
                'name' => 'blocAssign',
                'id' => 'blocAssign',
                'class' => 'blocAssign ml-6 mr-3'
            ]);

                $output .= html_writer::tag('h4',
                get_string('pupils', 'local_group_generator'),
                array('class' => 'titol text-dark'));

                $output .= $OUTPUT->container_start('', 'blocAssignConte',
                array('class' => 'blocAssignConte pr-2'));
                $output .= $OUTPUT->container_end();
                $output .= $OUTPUT->container_start('', 'contenedor_ajax');
                $output .= $OUTPUT->container_end();

            $output .= html_writer::end_tag('div');

            // Final container.
            $output .= html_writer::start_tag('div', array('id' => 'output_print', 'class' => 'output_print ml-6 mr-3'));

                $output .= html_writer::tag('h4', get_string('group_proposal', 'local_group_generator'), array('class' => 'titol'));

                // Modal.
                $output .= html_writer::start_tag('div', [
                    'name' => 'modal_button',
                    'id' => 'modal_button',
                    'class' => 'modal_button py-1 pr-2 pl-0 mb-3'
                ]);
                    $output .= html_writer::tag('p', get_string("f_screen", 'local_group_generator'), [
                        'type' => 'button',
                        'class' => 'rounded m-0',
                        'id' => 'f_screen',
                        'name' => 'f_screen'
                    ]);
                $output .= html_writer::end_tag('div');

                // Output container.
                $output .= $OUTPUT->container_start('', 'output_print_conte',
                ['class' => 'output_print_conte pt-0 px-3 pb-3',
                    'id' => 'output_print_conte'
                ]);
                $output .= $OUTPUT->container_end();
                $output .= $OUTPUT->container_start('', 'contenedor_ajax');
                $output .= $OUTPUT->container_end();

            $output .= html_writer::end_tag('div');

        $output .= html_writer::end_tag('div');

        // Modal window.
        $output .= html_writer::start_tag('div', array('name' => 'modal_Cont', 'id' => 'modal_Cont', 'class' => 'modal_Cont '));

            $output .= html_writer::start_tag('div', array('name' => 'modal_x', 'id' => 'modal_x', 'class' => 'modal_x '));
                $output .= html_writer::tag('label', get_string('x', 'local_group_generator'), array('id' => 'x', 'class' => 'x'));
            $output .= html_writer::end_tag('div');

            $output .= html_writer::start_tag('div',
            array('id' => 'modal_Container',
            'class' => 'modal_Container mt-4 text-dark p-3 h6 position-relative bg-light'));

            $output .= html_writer::end_tag('div');

        $output .= html_writer::end_tag('div');

         // Save button.
        $output .= html_writer::start_tag('div',
        array('name' => 'save_button',
        'id' => 'save_button',
        'class' => 'save_button m-auto mb-0 mt-5 px-2 py-1 border-0'));
            $output .= html_writer::empty_tag('input', [
                'type' => 'button',
                'class' => 'btn btn-primary rounded save border-0 text-white',
                'id' => 'saveGroups',
                'name' => 'saveGroups',
                'value' => get_string("saveGroups", 'local_group_generator')
            ]);
            $output .= html_writer::empty_tag('input', [
                'type' => 'button',
                'class' => 'btn btn-primary rounded save ml-2',
                'id' => 'saveinmoodle',
                'value' => get_string("saveinmoodle", 'local_group_generator')
            ]);
            $output .= html_writer::empty_tag('input', [
                'type' => 'button',
                'class' => 'rounded refresh btn btn-primary ml-2',
                'id' => 'refresh',
                'name' => 'refresh',
                'value' => get_string("refresh", 'local_group_generator')
            ]);
        $output .= html_writer::end_tag('div');
        $output .= html_writer::start_tag('div', 
        array('class' => 'mt-3', 'id' => 'managedelcontainer'));
        $output .= html_writer::tag('small',
        get_string('managedeletion', 'local_group_generator'),
        array('class' => 'text-info'));
        $output .= html_writer::end_tag('div');

        $output .= html_writer::end_tag('form');

        $output .= $OUTPUT->container_end();

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
     * @param array $data
     * @param array $files
     * @return array|bool
     */
    public function validation($data, $files) {
        global $CFG, $DB;
        $errors = array();
        if ($data['thresholdNeg'] < -1 ) {
            $errors['thresholdNeg'] = 'error';
        }

        return true;
    }
}


