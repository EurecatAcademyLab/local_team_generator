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
require_once($CFG->dirroot."/local/group_generator/lib.php");

/**
 * Class form, not in use.
 */
class gg_form extends moodleform {

    /**
     * Define the fields in the form.
     */
    public function definition() {

        $mform = $this->_form;

        $courses = array();
        $getcourse = get_courses();

        foreach ($getcourse as $course) {
            $courses[$course->id] = $course->fullname;
        }
        $courses[0] = get_string('choose', 'local_group_generator');
        ksort($courses);

        $groupcourses = array();
        $groupcourses[-1] = get_string('choose', 'local_group_generator');
        $groupcourses[0] = get_string('allstudent', 'local_group_generator');

        $formattosplit = array();
        $formattosplit[-1] = get_string('choose', 'local_group_generator');
        $formattosplit[0] = get_string('byGroups', 'local_group_generator');
        $formattosplit[1] = get_string('byStudents', 'local_group_generator');

        $filter = array();
        $filter[-5] = get_string('choose', 'local_group_generator');
        $filter[-4] = get_string('general_filter', 'local_group_generator');
        $filter[-3] = get_string('coursecompleted', 'local_group_generator');
        $filter[-2] = get_string('meangrade', 'local_group_generator');
        $filter[-1] = get_string('personal_filter', 'local_group_generator');
        $mfi = get_string('more_filter', 'local_group_generator');
        $lfi = get_string('less_filter', 'local_group_generator');
        $morefilter = '<div id="fitem_more_filter"> <p id="more_filter" style="opacity : 0.6">'.$mfi.'</p> </div>';
        $lessfilter = '<div id="fitem_less_filter"> <p id="less_filter" style="opacity : 0.6">'.$lfi.'</p> </div>';

        // Select a title.
        $tt = get_string('titleteam', 'local_group_generator');
        $select = $mform->addElement('text', 'titleteam', $tt, $courses, array('class' => '', 'id' => 'titleteam'));
        $mform->setType('titleteam', PARAM_INT);
        $mform->addRule('titleteam',  get_string('error'),  'required',  'null',  'client');
        $mform->addHelpButton('titleteam', 'explain_course', 'local_group_generator');

        $mform->addElement('html' , '<div id="fitem_div1"></div>');

        // Select a course.
        $sco = get_string('select_course', 'local_group_generator');
        $select = $mform->addElement('select', 'course', $sco, $courses, array('class' => '', 'id' => 'course'));
        $select->setSelected(get_string('choose', 'local_group_generator'));
        $mform->setType('course', PARAM_INT);
        $mform->addRule('course',  get_string('error'),  'required',  'null',  'client');
        $mform->addHelpButton('course', 'explain_course', 'local_group_generator');

        // Select a group course.
        $sgc = get_string('select_group_course', 'local_group_generator');
        $select = $mform->addElement('select', 'groupcourse', $sgc, $groupcourses, array('class' => '', 'id' => 'groupcourse'));
        $select->setSelected(get_string('choose', 'local_group_generator'));
        $mform->setType('groupcourse', PARAM_INT);
        $mform->addHelpButton('groupcourse', 'explain_groupcourse', 'local_group_generator');

        $mform->addElement('html' , '<div id="fitem_div2"></div>');

        // Select a format.
        $gch = get_string('groupsChoises', 'local_group_generator');
        $select = $mform->addElement('select', 'format', $gch, $formattosplit, array('class' => '', 'id' => 'format'));
        $select->setSelected(get_string('choose', 'local_group_generator'));
        $mform->setType('format', PARAM_INT);
        $mform->addRule('format',  get_string('error'),  'required',  'null',  'client');
        $mform->addHelpButton('format', 'explain_formatsplit', 'local_group_generator');

        // By student.
        $ms = get_string('manyStudent', 'local_group_generator');
        $mform->addElement('text', 'manyStudent', $ms, array('size' => '3', 'class' => '', 'id' => 'manyStudent'));
        $mform->setType('manyStudent', PARAM_TEXT);
        $mform->addRule('manyStudent',  "Numeric",  'numeric',  'null',  'client');
        $mform->addHelpButton('manyStudent', 'explain_bystudent', 'local_group_generator');

        // By group.
        $mgr = get_string('manyGroups', 'local_group_generator');
        $mform->addElement('text', 'manyGroups', $mgr, array('size' => '3', 'class' => '', 'id' => 'manyGroups'));
        $mform->setType('manyGroups', PARAM_TEXT);
        $mform->addRule('manyGroups',  'Numeric',  'numeric',  'null',  'client');
        $mform->addHelpButton('manyGroups', 'explain_bygroup', 'local_group_generator');

        // More filter / less filter.
        $mform->addElement('html' , $morefilter);
        $mform->addElement('html' , $lessfilter);

        // History.
        $sant = get_string('santi', 'local_group_generator');
        $mform->addElement(
        'advcheckbox',
        'history',
        get_string('history', 'local_group_generator'),
        $sant,
        ['id' => 'fitem_history'],
        ['uncheckedvalue', 'checkedvalue']
        );
        $mform->setType('history', PARAM_INT);
        $mform->addHelpButton('history', 'explain_history', 'local_group_generator');

        // Incompatible tandem.
        $mform->addElement(
        'advcheckbox',
        'tandem',
        get_string('tandem', 'local_group_generator'), ' ', ['id' => 'fitem_tandem'], ['uncheckedvalue', 'checkedvalue']
        );
        $mform->setType('tandem', PARAM_INT);
        $mform->addHelpButton('tandem', 'explain_tandem', 'local_group_generator');

        // Select a filter.
        $select = $mform->addElement(
            'select',
            'filter',
            get_string('select_personal_filter', 'local_group_generator'),
            $filter,
            array('class' => '', 'id' => 'filter'));
        $select->setSelected(get_string('choose', 'local_group_generator'));
        $mform->setType('filter', PARAM_INT);
        $mform->addHelpButton('filter', 'explain_personalfilter', 'local_group_generator');

        // Thershold.
        $mform->addElement(
            'text',
            'threshold',
            get_string('threshold', 'local_group_generator'),
            array('size' => '3' , 'class' => '', 'id' => 'threshold')
        );
        $mform->setType('threshold', PARAM_TEXT);
        $mform->addRule('threshold',  'Numeric',  'numeric',  'null',  'client');
        $mform->addHelpButton('threshold', 'explain_threshold', 'local_group_generator');

        // Homogenic / heterogenic group.
        $options = homogenic();
        $homogenic = array();
        for ($i = 0; $i < count($options); $i++) {
            $homogenic[] =& $mform->createElement('radio', 'label', '', $options[$i] , $i);
        }
        $mform->addGroup(
            $homogenic,
            'radioar',
            get_string('homogenic_explain', 'local_group_generator'),
            array(' '),
            false);

        $mform->addHelpButton('radioar', 'explain_homogenic', 'local_group_generator');

        // Create button.
        $mform->addElement(
            'submit',
            'create',
            get_string("create", 'local_group_generator'),
            ['class' => 'button', 'id' => 'create']);

        // Start & Final Container.
        $startcontainer = '
        <div class="d-flex justify-content-between">
            <div>
                <h4>'.get_string('pupils', 'local_group_generator').'</h4>
                <div name="blocAssignConte" class="blocAssignConte" id="blocAssignConte">
                </div>
                <div name="contenedor_ajax">
                </div>
            </div>
            <div>
                <h4>'.get_string('group_proposal', 'local_group_generator').'</h4>
                <div name="output_print_conte" class="output_print_conte">
                </div>
                <div name="contenedor_ajax">
                </div>
            </div>
        </div>';
        $mform->addElement('html' , $startcontainer);

        // Create saveGroups button.
        $mform->addElement(
            'submit',
            'saveGroups',
            get_string("saveGroups", 'local_group_generator'),
            ['class' => 'button ml-5', 'id' => 'saveGroups']);
        // Create Modal button.
        $mo = get_string("modal", 'local_group_generator');
        $mform->addElement('submit', 'modal', $mo, ['class' => 'button ml-2', 'id' => 'modal']);
        // Create save Moodle button.
        $sm = get_string("savemoodle", 'local_group_generator');
        $mform->addElement('submit', 'savemoodle', $sm, ['class' => 'button ml-1', 'id' => 'savemoodle']);

    }

    /**
     * Validate the form data.
     * @param array $data
     * @param array $files
     * @return array|bool
     */
    public function validation($data, $files) {
        $errors = array();
        return $errors;
    }
}

