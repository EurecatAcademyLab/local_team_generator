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
$string['greetingusercat'] = 'Buenos días, user';
$string['greetingloggedinusercat'] = 'Buenos días, {$a}';
$string['select_course'] = 'Seleccione un curso:';
$string['select_title'] = 'Seleccione un título:';
$string['select_group_cour'] = 'Seleccione un grupo del curso:';
$string['byStudents'] = 'según el número de estudiantes';
$string['byGroups'] = 'según un número de grupos';
$string['choose'] = 'Seleccione... ';
$string['none'] = ' &nbsp;&nbsp; Ningún filtro creado &nbsp;';
$string['manyStudent'] = 'Cuántos estudiantes?';
$string['manyGroups'] = 'Cuántos grupos?';
$string['groupsChoises'] = '¿Cómo dividir los grupos?:';
$string['title_indications'] = 'Seleccione un curso y como dividirlo';
$string['pupils'] = 'Lista de estudiante';
$string['create'] = 'Crear "Team"';
$string['refresh'] = 'Actualizar';
$string['try_again'] = 'Pruebe otra vez';
$string['with_history'] = 'Con referencia del historial de los grupos pasados';
$string['history'] = 'Historial';
$string['saveGroups'] = 'Guardar en el historial';
$string['save'] = 'Guardar';
$string['add_button'] = 'Añadir';
$string['remove_button'] = 'Quitar';
$string['group_proposal'] = 'Propuesta de estudiante "Teams"';
$string['name_filter'] = 'Nombre del filtro:';
$string['value_filter'] = 'Introduzca los valores:';
$string['values_print'] = 'Valores del filtro';
$string['filter_print'] = 'Nombre del filtro';
$string['heterogenic'] = 'Team heterogéneo';
$string['homogenic'] = 'Team homogéneo';
$string['select_personal_filter'] = 'Seleccione un filtro personalizado';
$string['result'] = 'Resultado del filtro personalizado';
$string['indications1'] = 'Pulse ENTER después del nombre';
$string['indications2'] = 'Pulse ENTER después de cada valor';
$string['indications3'] = 'Elija un valor y los estudiantes que tienen ese valor, a continuación, pulse "Añadir".';
$string['indications4'] = 'Para crear un tándem a partir de aquellos alumnos que NO tienen que compartir el mismo grupo';
$string['threshold'] = 'Insertar un umbral';
$string['santi'] = 'Es posible no repetir equipos anteriores';
$string['f_screen'] = 'Pantalla completa ...';
$string['x'] = 'X';
$string['customisable'] = 'Filtro personalizado';
$string['fullscreen'] = 'Pantalla completa';
$string['incompatible'] = 'Tándem Incompatible';
$string['tandem'] = 'Tándem Incompatible';
$string['student_one'] = 'Primer estudiante';
$string['student_two'] = 'Segundo estudiante';
$string['nostudent'] = 'Sin estudiantes';
$string['more_filter'] = 'Más filtros ...';
$string['less_filter'] = 'Menos filtros ...';
$string['export'] = 'Exportar a CSV';
$string['explain_course'] = 'Seleccione un curso para empezar. A continuación aparecerán diferentes opciones';
$string['explain_course_help'] = 'Seleccione un curso para empezar. A continuación aparecerán diferentes opciones';
$string['explain_groupcour'] = 'En caso de que el curso tenga grupos, se mostrarán en esta sección. Seleccione un grupo para este curso para continuar.';
$string['explain_groupcour_help'] = 'En caso de que el curso tenga grupos, se mostrarán en esta sección. Seleccione un grupo para este curso para continuar.';
$string['explain_formatsplit'] = 'Decidir cómo se dividirán los grupos, teniendo la opción de dividirse por alumnos o por grupos.';
$string['explain_formatsplit_help'] = 'Decidir cómo se dividirán los grupos, teniendo la opción de dividirse por alumnos o por grupos.';
$string['explain_bystudent_help'] = 'Escribir un número determinado de alumnos para cada grupo. Sólo permite valores numéricos';
$string['explain_bygroup_help'] = 'Para escribir un número determinado de grupos a dividir. Sólo admite valores numéricos';
$string['explain_bystudent'] = 'Escribir un número determinado de alumnos para cada grupo. Sólo permite valores numéricos';
$string['explain_bygroup'] = 'Para escribir un número determinado de grupos a dividir. Sólo admite valores numéricos';
$string['explainhisto'] = 'Al hacer clic en esta casilla, el programa utilizará como referencia los grupos generados anteriormente.';
$string['explainhisto_help'] = 'Al hacer clic en esta casilla, el programa utilizará como referencia los grupos generados anteriormente.';
$string['explain_tandem'] = 'Al hacer clic en esta casilla, el programa se referirá a las parejas creadas como tándems incompatibles. Si desea modificar las parejas creadas, vaya a dicha pestaña.';
$string['explain_tandem_help'] = 'Al hacer clic en esta casilla, el programa se referirá a las parejas creadas como tándems incompatibles. Si desea modificar las parejas creadas, vaya a dicha pestaña.';
$string['explain_personalfilter'] = 'Si el curso tiene un filtro personalizado, se mostrará en esta sección. También tiene la posibilidad de crear un filtro personalizado en la pestaña indicada. Además, se incluyen los valores por defecto de nota media y curso completo.';
$string['explain_personalfilter_help'] = 'Si el curso tiene un filtro personalizado, se mostrará en esta sección. También tiene la posibilidad de crear un filtro personalizado en la pestaña indicada. Además, se incluyen los valores por defecto de nota media y curso completo.';
$string['explain_homogenic'] = 'Esta opción permite elegir los grupos entre heterogéneos (diferentes) u homogéneos (iguales), en relación con el filtro elegido.';
$string['explain_homogenic_help'] = 'Esta opción permite elegir los grupos entre heterogéneos (diferentes) u homogéneos (iguales), en relación con el filtro elegido.';
$string['explain_heterogen'] = 'Esta opción permite elegir los grupos entre heterogéneos (diferentes) u homogéneos (iguales), en relación con el filtro elegido.';
$string['explain_threshold'] = 'El umbral nos permite dividir el grupo de una forma más flexible. cambiando este valor generamos mitades no exactas.';
$string['explain_threshold_help'] = 'El umbral nos permite dividir el grupo de una forma más flexible. cambiando este valor generamos mitades no exactas.';
$string['explain_title'] = 'Escriba un título para todo el proyecto';
$string['titletable'] = 'Historial del generador de "Teams"';
$string['id_user'] = 'Usuarios';
$string['id_course'] = 'Curso';
$string['id_group'] = 'Subgrupos';
$string['toggle'] = 'Grupos o estudiantes';
$string['toggle_value'] = 'Dividir en';
$string['split_group'] = '"Teams"';
$string['timecreated'] = 'Momento de creación';
$string['record_course'] = 'No hay registros guardados';
$string['aftersave'] = 'Tarea añadida satisfactoriamente';
$string['history'] = 'Historial';
$string['filter'] = 'Filtro';
$string['homogenic_table'] = 'Heterogéneo';
$string['threshold_table'] = 'Umbral';
$string['tandem_value'] = 'Tándem';
$string['no'] = '-';
$string['right'] = 'Si';
$string['reference'] = 'con referencia de grupo anterior';
$string['homogenic_explain'] = '¿Cómo crear un "team"?';
$string['personal_filter'] = 'Filtro Personalizado';
$string['general_filter'] = 'Filtro General';
$string['allstudent'] = 'Todos los estudiantes';
$string['modal'] = 'Pantalla completa';
$string['savemoodle'] = 'Guardar en Moodle';
$string['coursecompleted'] = 'Curso completado';
$string['meangrade'] = 'Nota media';
$string['titleteam'] = 'Seleccione un título para este proyecto';
$string['explain_titleteam'] = 'Debe escribir un título para mostrarlo como resultado';
$string['explain_titleteam_help'] = 'Debe escribir un título para mostrarlo como resultado';
$string['filter_name'] = 'Nombre del filtro';
$string['filter_value'] = 'Valores del filtro';
$string['filter_studentOn'] = 'Estudiantes';
$string['form'] = 'nuevo formulario';
$string['titletable'] = 'Tabla de resultados "Teams"';
$string['all_courses'] = 'Todo los cursos';
$string['select'] = 'Seleccionar';
$string['select_title'] = 'Seleccione un título';
$string['all_courses'] = 'Todos los cursos';
$string['explain_title'] = 'Cuando escribas un título aquí, los grupos se guardarán en moodle group con este título';
$string['saveinmoodle'] = 'Guardar en moodle';
$string['typeeach'] = 'Escriba cada valor y pulse Intro';
$string['typename'] = 'Escriba el nombre del filtro';
$string['sti'] = 'Seleccione un título';
$string['title'] = 'Título';
$string['titleteam'] = 'Título del "Team"';
$string['avgcourse'] = 'Promedio';
$string['success'] = 'Proceso satisfactorio. Guardado en el historial';
$string['successmoodle'] = 'Proceso satisfactorio. Guardado en moodle';
$string['norec'] = 'Ningún registro guardado';
$string['managedeletion'] = '* Para manejar la eliminación de grupos, se deberá realizar desde la plataforma de moodle.';

