<?php
class block_simplehtml extends block_base {

	public function init() {
		$this->title = get_string('enrolblock', 'block_enrolblock');
	}

	public function get_content() {
		if ($this->content !== null) {
			return $this->content;
		}
		$this->content  =  new stdClass;
		$this->content->text = "Coucou les amis, voici un super bloc de ouf !!";
		$this->content->footer = "On a bien rigolé, non ?";
		return $this->content;
	}
}
?>