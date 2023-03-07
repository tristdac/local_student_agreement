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
 * @author     Tristan daCosta
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {

    $settings = new admin_settingpage(
        'studentagreement',
        new lang_string('pluginname', 'local_studentagreement')
    );

    $name = 'local_studentagreement/enabled';
    $title = get_string('enabled', 'local_studentagreement');
    $description = get_string('enabled_desc', 'local_studentagreement');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $settings->add($setting);

    $name = 'local_studentagreement/courseid';
    $title = get_string('courseid', 'local_studentagreement');
    $description = get_string('courseid_desc', 'local_studentagreement');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $settings->add($setting);

    $name = 'local_studentagreement/numberoflogins';
    $title = get_string('numberoflogins' , 'local_studentagreement');
    $description = get_string('numberoflogins_desc', 'local_studentagreement');
    $default = '3';
    $choices = array(
        range(1,10)
    );
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $settings->add($setting);


    /** @var admin_root $ADMIN */
    $ADMIN->add('localplugins', $settings);
}
