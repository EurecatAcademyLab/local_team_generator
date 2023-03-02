/* eslint-disable no-undef */
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
 * Display information about all the local_group_generator modules in the requested course.
 *
 * @package     local_group_generator
 * @author      2022 JuanCarlo Castillo <juancarlo.castillo20@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @copyright   2022 JuanCa Castillo & Eurecat.dev
 * @since       3.11
 */
//
// * Javascript
// *

/**
 * To start Datatable library and assign it data table.
 */
$('#mytablegroup').DataTable({

    responsive: true,
    dom: 'Bfrtip',
    lengthMenu: [
        [10, 20, 40, -1],
        [10, 20, 40, 'All'],
    ],

    buttons: {
        name: 'Download',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class= "fa-solid fa-file-excel"></i>',
                titleAttr: 'Export to Excel',
                className: 'btn btn-light'
            }, {
                extend: 'csv',
                text: '<i class= "fa-solid fa-file-csv"></i>',
                titleAttr: 'Export to Csv',
                className: 'btn btn-light'
            }, {
                extend: 'pdfHtml5',
                text: '<i class= "fa-solid fa-file-pdf"></i>',
                titleAttr: 'Export to PDF',
                className: 'btn btn-light'
            }, {
                extend: 'print',
                text: '<i class= "fa-solid fa-print"></i>',
                titleAttr: 'Print',
                className: 'btn btn-light'
            }, {
                extend: 'copy',
                text: '<i class= "fa-solid fa-clipboard"></i>',
                titleAttr: 'copy to Clipboard',
                className: 'btn btn-light'
            }
        ]
    },
});

$('.dataTables_length').addClass('bs-select');

var table = $('#mytablegroup').DataTable();
table
    .buttons()
    .container()
    .appendTo('#mytablegroup');

// let download = 'Export to:';
// $('.btn-group').prepend(`<label class="mt-2 ml-2"> ${download} </label>`);
// $('.btn-group').css({"margin-left": "40px", "display": 'block'});

$('#table_personalFilter').DataTable({

    responsive: true,
    dom: 'Bfrtip',
    lengthMenu: [
        [10, 20, 40, -1],
        [10, 20, 40, 'All'],
    ],

    buttons: {
        name: 'Download',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class= "fa-solid fa-file-excel"></i>',
                titleAttr: 'Export to Excel',
                className: 'btn btn-light'
            }, {
                extend: 'csv',
                text: '<i class= "fa-solid fa-file-csv"></i>',
                titleAttr: 'Export to Csv',
                className: 'btn btn-light'
            }, {
                extend: 'pdfHtml5',
                text: '<i class= "fa-solid fa-file-pdf"></i>',
                titleAttr: 'Export to PDF',
                className: 'btn btn-light'
            }, {
                extend: 'print',
                text: '<i class= "fa-solid fa-print"></i>',
                titleAttr: 'Print',
                className: 'btn btn-light'
            }, {
                extend: 'copy',
                text: '<i class= "fa-solid fa-clipboard"></i>',
                titleAttr: 'copy to Clipboard',
                className: 'btn btn-light'
            }
        ]
    },
});

$('.dataTables_length').addClass('bs-select');

var filtertable = $('#table_personalFilter').DataTable();
$('#table_personalFilter').css({'margin-bottom' : '60px'})
filtertable
    .buttons()
    .container()
    .appendTo('#table_personalFilter');


$('#tandemtable').DataTable({

    responsive: true,
    dom: 'Bfrtip',
    lengthMenu: [
        [10, 20, 40, -1],
        [10, 20, 40, 'All'],
    ],

    buttons: {
        name: 'Download',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class= "fa-solid fa-file-excel"></i>',
                titleAttr: 'Export to Excel',
                className: 'btn btn-light'
            }, {
                extend: 'csv',
                text: '<i class= "fa-solid fa-file-csv"></i>',
                titleAttr: 'Export to Csv',
                className: 'btn btn-light'
            }, {
                extend: 'pdfHtml5',
                text: '<i class= "fa-solid fa-file-pdf"></i>',
                titleAttr: 'Export to PDF',
                className: 'btn btn-light'
            }, {
                extend: 'print',
                text: '<i class= "fa-solid fa-print"></i>',
                titleAttr: 'Print',
                className: 'btn btn-light'
            }, {
                extend: 'copy',
                text: '<i class= "fa-solid fa-clipboard"></i>',
                titleAttr: 'copy to Clipboard',
                className: 'btn btn-light'
            }
        ]
    },
});

$('.dataTables_length').addClass('bs-select');
$('#tandemtable').css({'margin-bottom' : '60px'})

var filtertable = $('#tandemtable').DataTable();
filtertable
    .buttons()
    .container()
    .appendTo('#tandemtable');

