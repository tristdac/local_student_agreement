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
 * This file defines observers needed by the plugin.
 *
 * @package    local_studentagreement
 * @copyright   2019 Tristan daCosta
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

class local_studentagreement_observer {
    public static function user_loggedin(core\event\base $event) {
        global $USER, $CFG, $SESSION;
        require_once("{$CFG->libdir}/completionlib.php");

        $config = get_config('local_studentagreement');
        
        if ($config->enabled) {
	        if ( (strpos($USER->username, 'ec1') !== false) || (strpos($USER->username, 'ec2') !== false) ) {
	          	$lastlogin = $USER->lastlogin;
			  	$courseid = $config->courseid;
			  	// $course = $DB->get_record('course', array('id' => $courseid));
			  	$course = get_course($courseid);
			  	$cinfo = new completion_info($course);
			  	$iscomplete = $cinfo->is_course_complete($USER->id);
	            if ($iscomplete === FALSE) { // hasn't agreed
	            	if ($lastlogin !== 0) { // not users first login
	            		$logincount = get_user_preferences('sa_logincount','0');
	            		$logincount++;
	            		set_user_preference('sa_logincount',$logincount);
			            if ($logincount % ($config->numberoflogins+1) == 0) {
		                	redirect($CFG->wwwroot.'/local/studentagreement/index.php');
		                }
		            }
	        	} else {
	        		unset_user_preference('sa_logincount');
	        		// if (strpos($SESSION->wantsurl,'login/index.php') === false) {
	        		// 	redirect($SESSION->wantsurl);
	        		// }
	        	}
	      	}
	    }  
    }
}