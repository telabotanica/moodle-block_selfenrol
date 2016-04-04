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
 * A simple block that encourages users to complete their profile
 * 
 * Checks if all required "profile fields" (admin > users > accouts > profile fields)
 * are filled for the current user; if not, suggests him/her to take a few minutes
 * to complete his/her profile
 * 
 * English and french versions included / versions anglaise et française incluses.
 *
 * @package    block_completeyourprofile
 * @category   blocks
 * @copyright  2016 Mathias Chouet, Tela Botanica
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Block definition
 *
 * @package    block_completeyourprofile
 * @copyright  2016 Mathias Chouet, Tela Botanica
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_completeyourprofile_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        // Section header title according to language file.
        $mform->addElement('header', 'configheader', get_string('blocksettings', 'block'));

        // customize block text
        // "must login to enrol"
        $mform->addElement('text', 'config_must_login_to_enrol', get_string('config_must_login_to_enrol', 'block_completeyourprofile'));
        $mform->setDefault('config_must_login_to_enrol', '');
        $mform->setType('config_must_login_to_enrol', PARAM_RAW);
        // "viewing course as guest"
        $mform->addElement('text', 'config_viewing_course_as_guest', get_string('config_viewing_course_as_guest', 'block_completeyourprofile'));
        $mform->setDefault('config_viewing_course_as_guest', '');
        $mform->setType('config_viewing_course_as_guest', PARAM_RAW);
        // "already_enrolled"
        $mform->addElement('text', 'config_already_enrolled', get_string('config_already_enrolled', 'block_completeyourprofile'));
        $mform->setDefault('config_already_enrolled', '');
        $mform->setType('config_already_enrolled', PARAM_RAW);
        // "not_enrolled_yet"
        $mform->addElement('text', 'config_not_enrolled_yet', get_string('config_not_enrolled_yet', 'block_completeyourprofile'));
        $mform->setDefault('config_not_enrolled_yet', '');
        $mform->setType('config_not_enrolled_yet', PARAM_RAW);

        // customize button text
        // "login now"
        $mform->addElement('text', 'config_login_now', get_string('config_login_now', 'block_completeyourprofile'));
        $mform->setDefault('config_login_now', '');
        $mform->setType('config_login_now', PARAM_RAW);
        // "enrol now"
        $mform->addElement('text', 'config_enrol_now', get_string('config_enrol_now', 'block_completeyourprofile'));
        $mform->setDefault('config_enrol_now', '');
        $mform->setType('config_enrol_now', PARAM_RAW);
        // "unenrol"
        $mform->addElement('text', 'config_unenrol', get_string('config_unenrol', 'block_completeyourprofile'));
        $mform->setDefault('config_unenrol', '');
        $mform->setType('config_unenrol', PARAM_RAW);
    }
}
