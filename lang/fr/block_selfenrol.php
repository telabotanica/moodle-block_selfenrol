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

$string['selfenrol:addinstance'] = "Ajouter un Bloc d'inscription";
$string['pluginname'] = "Bloc d'inscription";
$string['block_selfenrol_title'] = "Inscription au cours";
$string['already_enrolled'] = "Vous êtes inscrit à ce cours";
$string['not_enrolled_yet'] = "Vous n'êtes pas encore inscrit à ce cours";
$string['enrol_now'] = "S'inscrire";
$string['unenrol'] = "Se désinscrire";
$string['login_now'] = "Se connecter";
$string['not_in_a_course'] = "Vous n'êtes pas sur une page de cours";
$string['self_enrol_not_enabled'] = 'La méthode "self_enrol" doit être activée pour utiliser ce bloc';
$string['viewing_course_as_guest'] = "Vous parcourez ce cours en tant qu'invité";
$string['cannot_view_course_as_guest'] = "Vous devez vous identifier pour voir ce cours";
$string['must_login_to_enrol'] = "Pour vous inscrire à ce cours, vous devez d'abord être identifié(e)";