<?php
class block_enrolblock extends block_base {

	public function init() {
		$this->title = get_string('block_enrolblock_title', 'block_enrolblock');
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
		//global $PAGE;
		global $DB;

		$str = "";
		if ($COURSE->id == 1) { // platform home
			return get_string('not_in_a_course', 'block_enrolblock');
		}
		//echo "PAGE: "; var_dump($PAGE->course); echo "<br/><br/>";
		//echo "CONTEXTE: "; var_dump($this->context); echo "<br/><br/>";
		//echo "COURS: "; var_dump($COURSE); echo "<br/><br/>";
		//echo "UTILISATEUR: "; var_dump($USER); echo "<br/><br/>";
		//$coursecontext = context_course::instance($COURSE->id);
		//echo "CONTEXTE DE COURS: "; var_dump($coursecontext); echo "<br/><br/>";
		/*try {
			$enrolled = is_enrolled($this->context, $USER);
		} catch (Exception $e) {
			return $e->getMessage();
		}*/

		// find 'self' enrolid for current course
		$row1 = $DB->get_record('enrol', array('enrol' => 'self', 'courseid' => $USER->id), $fields='id', $strictness=IGNORE_MISSING);
		if ($row1 === false) {
			return get_string('self_enrol_not_enabled', 'block_enrolblock');
		}
		$course_enrol_id = $row1->id;

		// find if current user is enrolled
		//$row2 = $DB->get_record_sql('SELECT ue.enrolid FROM {user_enrolments} ue LEFT JOIN {enrol} e ON e.id = ue.enrolid WHERE ue.userid = ? AND e.courseid = ?', array($USER->id, $COURSE->id));
		$row2 = $DB->get_record('user_enrolments', array('enrolid' => $course_enrol_id, 'userid' => $USER->id), $fields='id', $strictness=IGNORE_MISSING);
		$user_is_enrolled = ($row2 !== false);

		if ($user_is_enrolled) {
			$unenrol_url  = new moodle_url('/enrol/self/unenrolself.php', array('enrolid' => $course_enrol_id));
			$str .= "<p>";
			$str .= get_string('already_enrolled', 'block_enrolblock');
			$str .= "</p>";
			$str .= "<br/>";
			$str .= '<a class="submit" href="' . $unenrol_url->out() . '">';
			$str .= get_string('unenrol', 'block_enrolblock');
			$str .= "</a>";
		} else {
			// self-enrol form
			// @TODO is it possible to reuse the method in "enrol_self" that generates such a form ?
			$form_url = new moodle_url('/enrol/index.php');
			$str .= "<p>";
			$str .= get_string('not_enrolled_yet', 'block_enrolblock');
			$str .= "</p>";
			$str .= "<br/>";
			$str .= '<form class="mform" accept-charset="utf-8" method="post" action="' . $form_url->out() . '">';
			$str .= '<input type="hidden" value="' . $COURSE->id . '" name="id">';
			$str .= '<input type="hidden" value="' . $course_enrol_id . '" name="instance">';
			$str .= '<input type="hidden" value="1" name="_qf__' . $course_enrol_id . '_enrol_self_enrol_form">';
			$str .= '<input type="hidden" value="1" name="mform_isexpanded_id_selfheader">';
			$str .= '<input type="submit" value="' . get_string('enrol_now', 'block_enrolblock') . '">';
			$str .= "</form>";
		}

		return $str;
	}
}
?>