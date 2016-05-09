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

/**
 * Block definition
 *
 * @package    block_selfenrol
 * @copyright  2016 Mathias Chouet, Tela Botanica
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_selfenrol extends block_base {

    /**
     * Initiates the block title
     */
    public function init() {
        $this->title = get_string('block_selfenrol_title', 'block_selfenrol');
    }

    /**
     * Returns the block content
     * @return string
     */
    public function get_content() {
        if ($this->content !== null) {
            return $this->content;
        }
        $this->content = new stdClass;
        $this->content->text = $this->generate_content();

        return $this->content;
    }

    /**
     * Generates the block content
     * @global type $COURSE
     * @global type $USER
     * @global type $DB
     * @return string
     */
    protected function generate_content() {
        global $COURSE;
        global $USER;
        global $DB;

        $str = "";
        if ($COURSE->id == 1) { // Platform home.
            // No content will make the block disappear.
            return '';
        }

        if ($USER->id == 1) { // Guest user.
            // Are guests allowed to view course ?
            $str .= "<p>";
            $row3 = $DB->get_record('enrol',
				array('enrol' => 'guest', 'courseid' => $COURSE->id, 'status' => 0),
				'id', IGNORE_MISSING);
            if ($row3 === false) {
                if (! empty($this->config->must_login_to_enrol)) {
                    $str .= $this->config->must_login_to_enrol;
                } else {
                    $str .= get_string('must_login_to_enrol', 'block_selfenrol');
                }
            } else {
                if (! empty($this->config->viewing_course_as_guest)) {
                    $str .= $this->config->viewing_course_as_guest;
                } else {
                    $str .= get_string('viewing_course_as_guest', 'block_selfenrol');
                }
            }
            $loginurl  = new moodle_url('/login/index.php');
            $str .= "</p>";
            $str .= "<br/>";
            $str .= '<a class="submit" href="' . $loginurl->out() . '">';
            if (! empty($this->config->login_now)) {
                $str .= $this->config->login_now;
            } else {
                $str .= get_string('login_now', 'block_selfenrol');
            }
            $str .= "</a>";
        } else { // Logged-in user.
            // Find 'self' enrolid for current course.
            $row1 = $DB->get_record('enrol',
				array('enrol' => 'self', 'courseid' => $COURSE->id, 'status' => 0),
				'id', IGNORE_MISSING);
            if ($row1 === false) { // Self enrollment not allowed.
                $str .= get_string('self_enrol_not_enabled', 'block_selfenrol');
            } else { // Self-enrollement allowed !
                $courseenrolid = $row1->id;
                // Find if current user is enrolled.
                $row2 = $DB->get_record('user_enrolments',
					array('enrolid' => $courseenrolid, 'userid' => $USER->id),
					'id', IGNORE_MISSING);
                $userisenrolled = ($row2 !== false);

                if ($userisenrolled) {
                    $unenrolurl = new moodle_url('/enrol/self/unenrolself.php', array('enrolid' => $courseenrolid));
                    $str .= "<p>";
                    if (! empty($this->config->already_enrolled)) {
                        $str .= $this->config->already_enrolled;
                    } else {
                        $str .= get_string('already_enrolled', 'block_selfenrol');
                    }
                    $str .= "</p>";
                    $str .= "<br/>";
                    $str .= '<a class="submit" href="' . $unenrolurl->out() . '">';
                    if (! empty($this->config->unenrol)) {
                        $str .= $this->config->unenrol;
                    } else {
                        $str .= get_string('unenrol', 'block_selfenrol');
                    }
                    $str .= "</a>";
                } else {
                    // Self-enrol form.
                    // @TODO is it possible to reuse the method in "enrol_self" that generates such a form ?
                    $formurl = new moodle_url('/enrol/index.php');
                    $str .= "<p>";
                    if (! empty($this->config->not_enrolled_yet)) {
                        $str .= $this->config->not_enrolled_yet;
                    } else {
                        $str .= get_string('not_enrolled_yet', 'block_selfenrol');
                    }
                    $str .= "</p>";
                    $str .= '<form class="mform" accept-charset="utf-8" method="post" action="' . $formurl->out() . '">';
                    $str .= '<input type="hidden" value="' . $COURSE->id . '" name="id">';
                    $str .= '<input type="hidden" value="' . $courseenrolid . '" name="instance">';
                    $str .= '<input type="hidden" value="1" name="_qf__' . $courseenrolid . '_enrol_self_enrol_form">';
                    $str .= '<input type="hidden" value="1" name="mform_isexpanded_id_selfheader">';
                    $str .= '<input type="hidden" value="' . $USER->sesskey . '" name="sesskey">';
                    if (! empty($this->config->enrol_now)) {
                        $str .= '<input type="submit" value="' . $this->config->enrol_now . '">';
                    } else {
                        $str .= '<input type="submit" value="' . get_string('enrol_now', 'block_selfenrol') . '">';
                    }
                    $str .= "</form>";
                }
            }
        }

        return $str;
    }
}
