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
 * Plugin strings are defined here.
 *
 * @package     local_group_generator
 * @author      2022 JuanCarlo Castillo <juancarlo.castillo20@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @copyright   2022 JuanCa Castillo & Eurecat.dev
 * @since       3.11
 * @category    string
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Team generator';
$string['greetingusercat'] = 'Bon dia, user';
$string['greetingloggedinusercat'] = 'Bon dia, {$a}';
$string['select_course'] = 'Select a course:';
$string['select_title'] = 'Select a title:';
$string['select_group_cour'] = 'Select a group of the course:';
$string['byStudents'] = 'by number of students';
$string['byGroups'] = 'by number of groups';
$string['choose'] = 'Choose... ';
$string['none'] = ' &nbsp;&nbsp; No filter created &nbsp;';
$string['manyStudent'] = 'How many students? ';
$string['manyGroups'] = 'How many groups? ';
$string['groupsChoises'] = 'How to split the team?:';
$string['title_indications'] = 'Select a course and how to split it up';
$string['pupils'] = 'Student list';
$string['create'] = 'Create team';
$string['refresh'] = 'Refresh';
$string['try_again'] = 'Try again';
$string['with_history'] = 'With reference to the history of past groups';
$string['history'] = 'History';
$string['saveGroups'] = 'Save to history';
$string['save'] = 'Save';
$string['add_button'] = 'Add';
$string['remove_button'] = 'Remove';
$string['group_proposal'] = 'Student teams proposal';
$string['name_filter'] = 'Filter name: ';
$string['value_filter'] = 'Insert the values:';
$string['values_print'] = 'Filter values';
$string['filter_print'] = 'Filter name';
$string['heterogenic'] = 'Heterogenic team';
$string['homogenic'] = 'Homogenic team';
$string['select_personal_filter'] = 'Select a personal filter';
$string['result'] = 'Result personal filter';
$string['indications1'] = 'Press ENTER after name';
$string['indications2'] = 'Press ENTER after if value';
$string['indications3'] = 'Choose a value and the students that have that value, then press "Add".';
$string['indications4'] = 'For create a tandem from those students who do NOT have to share the same group';
$string['threshold'] = 'Insert a threshold';
$string['santi'] = 'To do not repeat past teams if possible';
$string['f_screen'] = 'Full screen ...';
$string['x'] = 'X';
$string['customisable'] = 'Personal Filter';
$string['fullscreen'] = 'Full Screen';
$string['incompatible'] = 'Incompatible Tandem';
$string['tandem'] = 'Incompatible tandem';
$string['student_one'] = 'Student one';
$string['student_two'] = 'Student two';
$string['nostudent'] = 'No student here';
$string['more_filter'] = 'More filters ...';
$string['less_filter'] = 'Less filters ...';
$string['export'] = 'Export to CSV';
$string['explain_course'] = 'Select a course to start. Then will be appear diferrent options';
$string['explain_course_help'] = 'Select a course to start. Then will be appear diferrent options';
$string['explain_groupcour'] = 'If the course have groups this will display in this section. Select a group for this course to continue.';
$string['explain_groupcour_help'] = 'If the course have groups this will display in this section. Select a group for this course to continue.';
$string['explain_formatsplit'] = 'To decide how the groups will be divided, having the option to be divided by students or by groups.';
$string['explain_formatsplit_help'] = 'To decide how the groups will be divided, having the option to be divided by students or by groups.';
$string['explain_bystudent_help'] = 'To write a certain number of students for each group. Only allows numeric values';
$string['explain_bygroup_help'] = 'To write a given number of groups or to divide. Only allows numeric values';
$string['explain_bystudent'] = 'To write a certain number of students for each group. Only allows numeric values';
$string['explain_bygroup'] = 'To write a given number of groups or to divide. Only allows numeric values';
$string['explainhisto'] = 'By clicking this box, the program will use the previously generated groups as a reference.';
$string['explainhisto_help'] = 'By clicking this box, the program will use the previously generated groups as a reference.';
$string['explain_tandem'] = 'By clicking this box, the program will refer to the pairs created as incompatible tandems. If you wish to modify the couples created, go to that tab.';
$string['explain_tandem_help'] = 'By clicking this box, the program will refer to the pairs created as incompatible tandems. If you wish to modify the couples created, go to that tab.';
$string['explain_personalfilter'] = 'If the course has a personal filter, it will be displayed in this section. You also have the possibility to create a personal filter in the indicated tab. In addition, the default values for average grade and complete course are included.';
$string['explain_personalfilter_help'] = 'If the course has a personal filter, it will be displayed in this section. You also have the possibility to create a personal filter in the indicated tab. In addition, the default values for average grade and complete course are included.';
$string['explain_homogenic'] = 'This option allows you to choose the groups from heterogeneous (differents) or homogeneous (equals), in relation to the chosen filter.';
$string['explain_homogenic_help'] = 'This option allows you to choose the groups from heterogeneous (differents) or homogeneous (equals), in relation to the chosen filter.';
$string['explain_heterogen'] = 'This option allows you to choose the groups from heterogeneous (differents) or homogeneous (equals), in relation to the chosen filter.';
$string['explain_threshold'] = 'The threshold allows us to divide the group in a more flexible way. by changing this value we generate non-exact halves.';
$string['explain_threshold_help'] = 'The threshold allows us to divide the group in a more flexible way. by changing this value we generate non-exact halves.';
$string['explain_title'] = 'Write a title for all the project';
$string['titletable'] = 'Team Generator History ';
$string['id_user'] = 'Users';
$string['id_course'] = 'Course';
$string['id_group'] = 'Subgroup';
$string['toggle'] = 'Groups or Students';
$string['toggle_value'] = 'Divide in';
$string['split_group'] = 'Split Group';
$string['timecreated'] = 'Timecreated';
$string['record_course'] = 'There are no saved records';
$string['aftersave'] = 'Task Added Succesfully';
$string['history'] = 'History';
$string['filter'] = 'Filter';
$string['homogenic_table'] = 'Heterogenic';
$string['threshold_table'] = 'Threshold';
$string['tandem_value'] = 'Tandem';
$string['no'] = '-';
$string['right'] = 'Yes';
$string['reference'] = 'with previous group reference';
$string['homogenic_explain'] = 'How to create a team';
$string['personal_filter'] = 'Personal Filter';
$string['general_filter'] = 'General Filter';
$string['allstudent'] = 'All Student';
$string['modal'] = 'Full screen';
$string['savemoodle'] = 'Save in Moodle';
$string['coursecompleted'] = 'Course completed';
$string['meangrade'] = 'Mean grade';
$string['titleteam'] = 'Select a title for this project';
$string['explain_titleteam'] = 'You must write a title to display it as a result';
$string['explain_titleteam_help'] = 'You must write a title to display it as a result';
$string['filter_name'] = 'Filter name';
$string['filter_value'] = 'Filter value';
$string['filter_studentOn'] = 'Student On';
$string['form'] = 'new form';
$string['titletable'] = 'Teams table result';
$string['all_courses'] = 'All courses';
$string['select'] = 'Select';
$string['select_title'] = 'Select Title';
$string['all_courses'] = 'All_courses';
$string['explain_title'] = 'When you write a title here, the groups will save at moodle group with this title';
$string['saveinmoodle'] = 'Save in moodle';
$string['typeeach'] = 'Type each value and press enter';
$string['typename'] = 'Type the name of the filter';
$string['sti'] = 'Select title';
$string['title'] = 'Title';
$string['titleteam'] = 'Title Team';
$string['avgcourse'] = 'Averaging';
$string['success'] = 'Successful process. saved in history';
$string['successmoodle'] = 'Successful process. saved in moodle';
$string['norec'] = 'No saved records';
$string['managedeletion'] = '* To manage the group deletion, it must be done from the moodle platform.';

