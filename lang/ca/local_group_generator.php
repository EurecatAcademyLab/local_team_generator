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
 * @category    string
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Generador de "Teams"';
$string['greetingusercat'] = 'Bon dia, user';
$string['greetingloggedinusercat'] = 'Bon dia, {$a}';
$string['select_course'] = 'Seleccioni un curs:';
$string['select_title'] = 'Seleccioni un títol:';
$string['select_group_cour'] = 'Seleccioni un grup del curs:';
$string['byStudents'] = "segons el nombre d'estudiants";
$string['byGroups'] = 'segons un nombre de grups';
$string['choose'] = 'Seleccioni... ';
$string['none'] = ' &nbsp;&nbsp; Cap filtre creat &nbsp;';
$string['manyStudent'] = 'Quants estudiants?';
$string['manyGroups'] = 'Quants grups?';
$string['groupsChoises'] = 'Com dividir els grups?:';
$string['title_indications'] = 'Seleccioni un curs i com dividir-lo';
$string['pupils'] = "Llista d'estudiant";
$string['create'] = 'Crear "Teams"';
$string['refresh'] = 'Refresca';
$string['try_again'] = 'torna-ho a provar';
$string['with_history'] = "Amb referència de l'historial dels grups passats";
$string['history'] = 'Historial';
$string['saveGroups'] = "Desa en l'historial";
$string['save'] = 'Desa';
$string['add_button'] = 'Afegir';
$string['remove_button'] = 'Remoure';
$string['group_proposal'] = "Proposta d'estudiant Teams";
$string['name_filter'] = 'Nom del filtre:';
$string['value_filter'] = 'Introdueixi els valors:';
$string['values_print'] = 'Valors del filtre';
$string['filter_print'] = 'Nom del filtre';
$string['heterogenic'] = 'Team heterogeni';
$string['homogenic'] = 'Team homogeni';
$string['select_personal_filter'] = 'Seleccioni un filtre personalitzat';
$string['result'] = 'Resultat del filtre personalitzat';
$string['indications1'] = 'Premi ENTER després del nom';
$string['indications2'] = 'Premi ENTER després de cada valor';
$string['indications3'] = 'Triï un valor i els estudiants que tenen aquest valor, a continuació, premi "Afegir".';
$string['indications4'] = "Per a crear un tàndem a partir d'aquells alumnes que NO han de compartir el mateix grup";
$string['threshold'] = 'insereixi un llindar';
$string['santi'] = 'És possible no repetir equips anteriors';
$string['f_screen'] = 'Pantalla completa ...';
$string['x'] = 'X';
$string['customisable'] = 'Filtre personalitzat';
$string['fullscreen'] = 'Pantalla completa';
$string['incompatible'] = 'Tàndem Incompatible';
$string['tandem'] = 'Tàndem Incompatible';
$string['student_one'] = 'Primer estudiant';
$string['student_two'] = 'Segon estudiant';
$string['nostudent'] = 'Sense estudiants';
$string['more_filter'] = 'Més filtres ...';
$string['less_filter'] = 'Menys filtres ...';
$string['export'] = 'Exportar a CSV';
$string['explain_course'] = 'Seleccioni un curs per a començar. A continuació apareixeran diferents opcions';
$string['explain_course_help'] = 'Seleccioni un curs per a començar. A continuació apareixeran diferents opcions';
$string['explain_groupcour'] = 'En cas que el curs tingui grups, es mostraran en aquesta secció. Seleccioni un grup per a aquest curs per a continuar.';
$string['explain_groupcour_help'] = 'En cas que el curs tingui grups, es mostraran en aquesta secció. Seleccioni un grup per a aquest curs per a continuar.';
$string['explain_formatsplit'] = "Decidir com es dividiran els grups, tenint l'opció de dividir-se per alumnes o per grups.";
$string['explain_formatsplit_help'] = "Decidir com es dividiran els grups, tenint l'opció de dividir-se per alumnes o per grups.";
$string['explain_bystudent_help'] = "Escriure un nombre determinat d'alumnes per a cada grup. Només permet valors numèrics";
$string['explain_bystudent'] = "Escriure un nombre determinat d'alumnes per a cada grup. Només permet valors numèrics";
$string['explain_bygroup_help'] = 'Per a escriure un nombre determinat de grups a dividir. Només admet valors numèrics';
$string['explain_bygroup'] = 'Per a escriure un nombre determinat de grups a dividir. Només admet valors numèrics';
$string['explainhisto'] = 'En fer clic en aquesta casella, el programa utilitzarà com a referència els grups generats anteriorment.';
$string['explainhisto_help'] = 'En fer clic en aquesta casella, el programa utilitzarà com a referència els grups generats anteriorment.';
$string['explain_tandem'] = 'En fer clic en aquesta casella, el programa es referirà a les parelles creades com a tàndems incompatibles. Si desitja modificar les parelles creades, vagi a aquesta pestanya.';
$string['explain_tandem_help'] = 'En fer clic en aquesta casella, el programa es referirà a les parelles creades com a tàndems incompatibles. Si desitja modificar les parelles creades, vagi a aquesta pestanya.';
$string['explain_personalfilter'] = "Si el curs té un filtre personal, es mostrarà en aquesta secció. També té la possibilitat de crear un filtre personal en la pestanya indicada. A més, s'inclouen els valors per defecte de nota mitjana i curs complet.";
$string['explain_personalfilter_help'] = "Si el curs té un filtre personal, es mostrarà en aquesta secció. També té la possibilitat de crear un filtre personal en la pestanya indicada. A més, s'inclouen els valors per defecte de nota mitjana i curs complet.";
$string['explain_homogenic'] = 'Aquesta opció permet triar els grups entre heterogenis (diferents) o homogenis (iguals), en relació amb el filtre triat.';
$string['explain_homogenic_help'] = 'Aquesta opció permet triar els grups entre heterogenis (diferents) o homogenis (iguals), en relació amb el filtre triat.';
$string['explain_heterogen'] = 'Aquesta opció permet triar els grups entre heterogenis (diferents) o homogenis (iguals), en relació amb el filtre triat.';
$string['explain_threshold'] = "El llindar ens permet dividir el grup d'una forma més flexible. canviant aquest valor generem meitats no exactes.";
$string['explain_threshold_help'] = "El llindar ens permet dividir el grup d'una forma més flexible. canviant aquest valor generem meitats no exactes.";
$string['explain_title'] = 'Escrigui un títol per a tot el projecte';
$string['titletable'] = 'Historial del generador de "Teams"';
$string['id_user'] = 'Usuaris';
$string['id_course'] = 'Curs';
$string['id_group'] = 'Subgrups';
$string['toggle'] = 'Grups o estudiants';
$string['toggle_value'] = 'Dividir en';
$string['split_group'] = '"Teams"';
$string['timecreated'] = 'Moment de creació';
$string['record_course'] = 'No hi ha registres guardats';
$string['aftersave'] = 'Tasca afegida satisfactòriament';
$string['history'] = 'Historial';
$string['filter'] = 'Filtre';
$string['homogenic_table'] = 'Heterogeni';
$string['threshold_table'] = 'Llindar';
$string['tandem_value'] = 'Tàndem';
$string['no'] = '-';
$string['right'] = 'Si';
$string['reference'] = 'amb referència de grup anterior';
$string['homogenic_explain'] = 'Com crear un "team"';
$string['personal_filter'] = 'Filtre Personalitzat';
$string['general_filter'] = 'Filtre General';
$string['allstudent'] = 'Tots els estudiants';
$string['modal'] = 'Pantalla completa';
$string['savemoodle'] = 'Desa en Moodle';
$string['coursecompleted'] = 'Curs completat';
$string['meangrade'] = 'Nota mitjana';
$string['titleteam'] = 'Seleccioni un títol per a aquest projecte';
$string['explain_titleteam'] = "Ha d'escriure un títol per a mostrar-lo com a resultat";
$string['explain_titleteam_help'] = "Ha d'escriure un títol per a mostrar-lo com a resultat";
$string['filter_name'] = 'Nom del filtre';
$string['filter_value'] = 'Valors del filtre';
$string['filter_studentOn'] = 'Estudiants';
$string['form'] = 'nou formulari';
$string['titletable'] = 'Taula de resultats "Teams"';
$string['all_courses'] = 'tots els cursos';
$string['select'] = 'Seleccionar';
$string['select_title'] = 'Seleccioni un títol';
$string['all_courses'] = 'tots els cursos';
$string['explain_title'] = 'Quan escribes un títol aquí, els grups es guardaran en moodle group amb aquest títol';
$string['saveinmoodle'] = 'Desa en moodle';
$string['typeeach'] = 'Escrigui cada valor i premi Intro';
$string['typename'] = 'Escriba el nombre del filtro';
$string['sti'] = 'Seleccioni un títol';
$string['title'] = 'Títol';
$string['titleteam'] = 'Títol del "Team"';
$string['avgcourse'] = 'Mitjana';
$string['success'] = "Procés satisfactori. Desat en l'historial";
$string['successmoodle'] = 'Procés satisfactori. Desat en moodle';
$string['norec'] = 'Cap registre desat';
$string['managedeletion'] = "* Per l'eliminació de grups, s'haurà de realitzar des de la plataforma de moodle.";

