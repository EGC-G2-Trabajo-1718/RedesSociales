<?php

$abspath=dirname(getcwd());

define('PLUGIN_FILE', getenv('PLUGIN_FILE') );
$folder = str_replace('.php','', PLUGIN_FILE);
define('PLUGIN_FOLDER', $abspath.'/tmp/wordpress/wp-content/plugins/'.$folder);
define('PLUGIN_PATH', PLUGIN_FOLDER.'/'.PLUGIN_FILE);

// Activates this plugin in WordPress
$GLOBALS['wp_tests_options'] = array(
	'active_plugins' => array(PLUGIN_PATH),
);
	
require $abspath.'/tmp/wordpress/tests/phpunit/includes/bootstrap.php';
