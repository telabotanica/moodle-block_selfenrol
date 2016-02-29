<?php
class block_selfenrol extends block_base {

	public function init() {
		$this->title = get_string('block_selfenrol_title', 'block_selfenrol');
	}

	public function get_content() {
		if ($this->content !== null) {
			return $this->content;
		}
		$this->content  =  new stdClass;
		$this->content->text = $this->generate_content();

		return $this->content;
	}

	protected function generate_content() {
		global $COURSE;
		global $USER;
		global $DB;

		$str = "";
		if ($COURSE->id == 1) { // platform home
			// no content will make the block disappear
			return '';
		}

		if ($USER->id == 1) { // guest user
			// are guests allowed to view course ?
			$str .= "<p>";
			$row3 = $DB->get_record('enrol', array('enrol' => 'guest', 'courseid' => $COURSE->id, 'status' => 0), $fields='id', $strictness=IGNORE_MISSING);
			if ($row3 === false) {
				//$str .= get_string('cannot_view_course_as_guest', 'block_selfenrol');
				$str .= get_string('must_login_to_enrol', 'block_selfenrol');
			} else {
				$str .= get_string('viewing_course_as_guest', 'block_selfenrol');
			}
			$login_url  = new moodle_url('/login/index.php');
			$str .= "</p>";
			$str .= "<br/>";
			$str .= '<a class="submit" href="' . $login_url->out() . '">';
			$str .= get_string('login_now', 'block_selfenrol');
			$str .= "</a>";
		} else { // logged-in user
			// find 'self' enrolid for current course
			$row1 = $DB->get_record('enrol', array('enrol' => 'self', 'courseid' => $COURSE->id, 'status' => 0), $fields='id', $strictness=IGNORE_MISSING);
			if ($row1 === false) { // self enrollment not allowed
				$str .= get_string('self_enrol_not_enabled', 'block_selfenrol');
			} else { // self-enrollement allowed !
				$course_enrol_id = $row1->id;
				// find if current user is enrolled
				$row2 = $DB->get_record('user_enrolments', array('enrolid' => $course_enrol_id, 'userid' => $USER->id), $fields='id', $strictness=IGNORE_MISSING);
				$user_is_enrolled = ($row2 !== false);

				if ($user_is_enrolled) {
					$unenrol_url  = new moodle_url('/enrol/self/unenrolself.php', array('enrolid' => $course_enrol_id));
					$str .= "<p>";
					$str .= get_string('already_enrolled', 'block_selfenrol');
					$str .= "</p>";
					$str .= "<br/>";
					$str .= '<a class="submit" href="' . $unenrol_url->out() . '">';
					$str .= get_string('unenrol', 'block_selfenrol');
					$str .= "</a>";
				} else {
					// self-enrol form
					// @TODO is it possible to reuse the method in "enrol_self" that generates such a form ?
					$form_url = new moodle_url('/enrol/index.php');
					$str .= "<p>";
					$str .= get_string('not_enrolled_yet', 'block_selfenrol');
					$str .= "</p>";
					$str .= '<form class="mform" accept-charset="utf-8" method="post" action="' . $form_url->out() . '">';
					$str .= '<input type="hidden" value="' . $COURSE->id . '" name="id">';
					$str .= '<input type="hidden" value="' . $course_enrol_id . '" name="instance">';
					$str .= '<input type="hidden" value="1" name="_qf__' . $course_enrol_id . '_enrol_self_enrol_form">';
					$str .= '<input type="hidden" value="1" name="mform_isexpanded_id_selfheader">';
					$str .= '<input type="hidden" value="' . $USER->sesskey . '" name="sesskey">';
					$str .= '<input type="submit" value="' . get_string('enrol_now', 'block_selfenrol') . '">';
					$str .= "</form>";
				}
			}
		}

		return $str;
	}
}
?>