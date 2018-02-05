<?php
// Activates this plugin in WordPress so it can be tested.
$GLOBALS['wp_tests_options'] = array('active_plugins' => array( 'socialhub-egc/socialhub-egc.php' ),);

// If the develop repo location is defined (as WP_DEVELOP_DIR), use that
// location. Otherwise, we'll just assume that this plugin is installed in a
// WordPress develop SVN checkout.
require '../../../../tests/phpunit/includes/bootstrap.php';
?>