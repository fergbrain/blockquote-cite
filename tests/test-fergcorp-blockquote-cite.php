<?php
//require_once( '../fergcorp-blockquote-cite.php' );
/**
 * Class Test_Fergcorp_Blockquote_Cite
 *
 * @package Blockquote_Cite
 */

/**
 * Sample test case.
 */


class Test_Fergcorp_Blockquote_Cite extends WP_UnitTestCase {


	function setUp() {

			parent::setUp();
		
		} // end setup
	 
 	function test_plugin_activated() {
 		$this->assertTrue( is_plugin_active( PLUGIN_PATH ) );
 	}
	
	function test_fergcorp_blockquote_cite(){
		
		$test_content = 'Lorem ipsum dolor sit amet, no mea dicit inermis alienum, eum minim moderatius ut. <blockquote cite="http://www.example.com/path/to/file">Sea eu antiopam theophrastus voluptatibus, cu modo dicat altera est.</blockquote> Has ad quidam moderatius, at tempor scripserit definitionem sit. Erat movet sensibus mei cu, ea mea harum vivendo singulis, inermis detracto mea ea. At nec solet definitionem, phaedrum maiestatis et mel.';
		
		$assert_content = 'Lorem ipsum dolor sit amet, no mea dicit inermis alienum, eum minim moderatius ut. <a href="http://www.example.com/path/to/file">From www.example.com:</a><blockquote>Sea eu antiopam theophrastus voluptatibus, cu modo dicat altera est.</blockquote> Has ad quidam moderatius, at tempor scripserit definitionem sit. Erat movet sensibus mei cu, ea mea harum vivendo singulis, inermis detracto mea ea. At nec solet definitionem, phaedrum maiestatis et mel.';
		
		
		
		
		$this->assertEquals($assert_content, fergcorp_blockquote_cite( $test_content ) );
		
	}
}
