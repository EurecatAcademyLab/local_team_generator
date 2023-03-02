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
 * @author      2022 Aina Palacios
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @copyright   2022 JuanCa Castillo & Eurecat.dev
 * @since       3.11
 */
/**
 * Call the API to generate teams.
 */
require_once(__DIR__.'/../../../../config.php');
require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot.'/lib/formslib.php');
require_login();

$idarrayusers = optional_param_array('idarray', null, PARAM_TEXT);
$toggle = optional_param('toogle', null, PARAM_INT);
$togglevalue = optional_param('togglevalue', null, PARAM_INT);
$history = optional_param('historySt', null, PARAM_TEXT);
$features  = optional_param('personalfilter', null, PARAM_TEXT);
$homogeny = optional_param('homogenic', null, PARAM_INT);
$threshold = optional_param('threshold', null, PARAM_INT);
$tandem = optional_param('tandemvalue', null, PARAM_TEXT);


$input["group"] = $integerids = array_map('intval', $idarrayusers);
$input["forGroups"] = $toggle ? false : true;
$input["history"] = []; // Modifica.
$input['number'] = $togglevalue;
$input['features'] = [];
$input["homogeny"] = false;


$makecall = callapi('POST', 'https://tutor-ia-api.herokuapp.com/group', json_encode($input, true));

echo( $makecall );

/**
 * Call the API to generate teams.
 * @param String $method post.
 * @param String $url with the url server.
 * @param Mixed $data Object with the information from the form and a Bolean.
 * @return Object with the information back from server.
 */
function callapi($method, $url, $data) {
      $curl = curl_init();
    switch ($method){
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
         break;
        case "PUT":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            if ($data) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
         break;
        default:
            if ($data) {
                $url = sprintf("%s?%s", $url, http_build_query($data));
            }
    }

      // OPTIONS.
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_HTTPHEADER, array(
         'APIKEY: 111111111111111111111',
         'Content-Type: application/json',
      ));
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
      // EXECUTE.
      $result = curl_exec($curl);
    if (!$result) {
        die("Connection Failure");
    }
      curl_close($curl);
      return $result;
}


