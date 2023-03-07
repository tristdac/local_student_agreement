<?php
// This file is part of Moodle - http://moodle.org/
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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 *
 *
 * @package    local_studentagreement
 * @author     Darko Miletic
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();


function get_last_login($user) {
    global $DB;

}

function show_reminder() {
    
  return $content;
}

function get_completion_status($userid) {
  global $DB, $CFG;
  require_once("{$CFG->libdir}/completionlib.php");
  $courseid = get_config('local_studentagreement', 'courseid');
  $course = $DB->get_record('course', array('id' => $courseid));
  $cinfo = new completion_info($course);
  $iscomplete = $cinfo->is_course_complete($userid);
  return $iscomplete;
}

function get_content() {
    global $USER, $SESSION, $CFG;
    $courseid = get_config('local_studentagreement', 'courseid');
    if (!empty($SESSION->wantsurl)) {
      $redirect = $SESSION->wantsurl;
    } else {
      $redirect = $CFG->wwwroot;
    }
    $content = '';
    $content .= '<div class="center">';
    $content .= "<h4>Hi ".$USER->firstname."</h4>".get_string('message','local_studentagreement')."</p>";              
    $content .= '<div class="btn-container">';
    $content .= '<a role="button" href="'.$CFG->wwwroot.'/course/view.php?id='.$courseid.'" class="btn btn-success">'.get_string('takeme','local_studentagreement').'</a>';
    $content .= '<p><a href="'.$redirect.'" class="">'.get_string('later','local_studentagreement').'</a></p>';
    $content .= '</div>';
    $content .= '</div>';
    return $content;
}

function notification() {
  $logins = get_config('local_studentagreement', 'numberoflogins')+1;
  $content = get_string('notification','local_studentagreement',ordinal($logins));
  return $content;
}

function ordinal($number) {
    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
    if ((($number % 100) >= 11) && (($number%100) <= 13) && $number > 1)
        return $number. '<sup>th</sup>';
    if ($number === 1)
        return '';
    else
        return $number. '<sup>'.$ends[$number % 10].'</sup>';
}

// function user_loggedin() {
//     /**
//      * Event processor - user logged in.
//      * @param \core\event\user_loggedin $event
//      */
//     // public static function loggedin(\core\event\user_loggedin $event) {
//         global $USER;
// // redirect('/local/studentagreement/index.php');
//         if (strpos($USER->username, 'ec1') !== false) {
//           $lastlogin = $USER->lastlogin;
//           $currentlogin = $USER->currentlogin;
//             if ($lastlogin !== 0) {
//                 redirect('/local/studentagreement/index.php');

//         }
//       }
//     // }
// }