<?php

#$abspath=dirname(getcwd());

#define('PLUGIN_FILE', getenv('PLUGIN_FILE') );
#$folder = str_replace('.php','', PLUGIN_FILE);
#define('PLUGIN_FOLDER', $abspath.'/tmp/wordpress/wp-content/plugins/'.$folder);
#define('PLUGIN_PATH', PLUGIN_FOLDER.'/'.PLUGIN_FILE);

// Activates this plugin in WordPress
#$GLOBALS['wp_tests_options'] = array(
	#'active_plugins' => array(PLUGIN_PATH),
#);
	
#require $abspath.'/tmp/wordpress/tests/phpunit/includes/bootstrap.php';

// Activates this plugin in WordPress so it can be tested.
$GLOBALS['wp_tests_options'] = array(
	'active_plugins' => array( 'socialhub-egc/socialhub-egc.php' ),
);
// If the develop repo location is defined (as WP_DEVELOP_DIR), use that
// location. Otherwise, we'll just assume that this plugin is installed in a
// WordPress develop SVN checkout.
if( false !== getenv( 'WP_DEVELOP_DIR' ) ) {
	require getenv( 'WP_DEVELOP_DIR' ) . '/tests/phpunit/includes/bootstrap.php';
} else {
	require '../../../../tests/phpunit/includes/bootstrap.php';
}
