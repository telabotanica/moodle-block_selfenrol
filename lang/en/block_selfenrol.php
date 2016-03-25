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
 * A simple block that shows the user's enrolment status, and suggests him to (un)enroll (and login if needed)
 *
 * This plugin uses enrol_self module. If enrol_self is enabled for a given course,
 * this block will show user's enrolment status and suggest him/her to (un)enrol.
 * 
 * This allows to hide the Administration block that is usually responsible for displaying
 * an (un)enrolment link, and might not be wanted (confusing title, other options might appear, etc.)
 * 
 * Make sure to display it on "every page" so that it appears also on courses summary pages.
 * 
 * English and french versions included / versions anglaise et française incluses.
 *
 * @package    block_selfenrol
 * @category   blocks
 * @copyright  2016 Mathias Chouet, Tela Botanica
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['selfenrol:addinstance'] = 'Add a Self-enrol block';
$string['pluginname'] = 'Self-enrol block';
$string['block_selfenrol_title'] = 'Enrol in this course';
$string['already_enrolled'] = "You are enrolled in this course";
$string['not_enrolled_yet'] = "You are not enrolled in this course yet";
$string['enrol_now'] = "Enrol";
$string['unenrol'] = "Unenrol";
$string['login_now'] = "Log in";
$string['not_in_a_course'] = "You are not on a course page";
$string['self_enrol_not_enabled'] = '"self_enrol" method must be enabled to use this block';
$string['viewing_course_as_guest'] = 'You are viewing this course as a guest';
$string['cannot_view_course_as_guest'] = "You have to log in to view this course";
$string['must_login_to_enrol'] = "To enrol in this course, you have to log in first";