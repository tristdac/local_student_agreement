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

define('NO_OUTPUT_BUFFERING', true);

require('../../config.php');
require('lib.php');
global $PAGE, $USER, $CFG;

// Load the context
$context = context_system::instance();


$PAGE->set_context($context);
$PAGE->set_url('/local/studentagreement/index.php');
$PAGE->set_pagelayout('standard');
$PAGE->set_title(get_string('pluginname', 'local_studentagreement'));
$PAGE->set_heading('Student Agreement');

echo $OUTPUT->header('Student Agreement');

echo get_content();

echo $OUTPUT->notification(notification(), 'info');

echo $OUTPUT->footer();
