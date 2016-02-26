<?php
$plugin->component = 'block_enrolblock';
$plugin->version = 2016022617;
$plugin->requires = 2010112400;
$plugin->dependencies = array(
	'enrol_self' => ANY_VERSION,   // The Foo activity must be present (any version).
);