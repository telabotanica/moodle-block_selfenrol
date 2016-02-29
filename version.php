<?php
$plugin->component = 'block_selfenrol';
$plugin->version = 2016022914;
$plugin->requires = 2014111000; // Moodle v2.8
$plugin->maturity = MATURITY_BETA;
$plugin->release = "0.1";
$plugin->dependencies = array(
	'enrol_self' => ANY_VERSION,
);