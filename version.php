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

$plugin->component = 'block_selfenrol';
$plugin->version = 2016040413;
$plugin->requires = 2014111000; // Moodle v2.8
$plugin->maturity = MATURITY_BETA;
$plugin->release = "0.1";
$plugin->dependencies = array(
    'enrol_self' => ANY_VERSION,
);