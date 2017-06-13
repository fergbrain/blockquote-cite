<?php
/**
 * PHPUnit bootstrap file
 *
 * @package Blockquote_Cite
 */

$_tests_dir = getenv( 'WP_TESTS_DIR' );
if ( ! $_tests_dir ) {
	$_tests_dir = '/tmp/wordpress-tests-lib';
}

// Give access to tests_add_filter() function.
require_once $_tests_dir . '/includes/functions.php';

/**
 * change PLUGIN_FILE env in phpunit.xml
 */
define('PLUGIN_FILE', getenv('PLUGIN_FILE') );
define('PLUGIN_FOLDER', basename( dirname( __DIR__ ) ) );
define('PLUGIN_PATH', PLUGIN_FOLDER.'/'.PLUGIN_FILE);
// Activates this plugin in WordPress so it can be tested.
$GLOBALS['wp_tests_options'] = array(
  'active_plugins' => array( PLUGIN_PATH ),
);


/**
 * Manually load the plugin being tested.
 */
function _manually_load_plugin() {
	require dirname( dirname( __FILE__ ) ) . '/fergcorp-blockquote-cite.php';
}
tests_add_filter( 'muplugins_loaded', '_manually_load_plugin' );

// Start up the WP testing environment.
require $_tests_dir . '/includes/bootstrap.php';
