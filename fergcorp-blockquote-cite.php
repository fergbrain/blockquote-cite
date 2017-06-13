<?php
/**
 * Adds citations for the blockquote tag with the cite value
 *
 * @package Blockquote Cite
 * @version 0.50
 */

/*
Plugin Name: Blockquote Cite
http://www.andrewferguson.net/wordpress-plugins/blockquote-cite/
Plugin Description: Adds citations for the blockquote tag with the cite value
Version: 0.50
Author: Andrew Ferguson
Author URI: http://www.andrewferguson.net

Adding images to display:
The plugin uses a rather simple, and hopefully idiot proof, way to include images. It just looks in a directory and sees if the domain name is there in the format sld.tld.png. For example: example.com.png or wsj.com.png). Not that it really matters, but I've saving all the images using Photoshop using 32 Colors, Adaptive Color reduction, No dither, no web-snap. File sizes should come out to somewhere around 1kb or less.



Blockquote Cite - Adds citations for the blockquote tag with the cite value is set
Copyright (c) 2006-2017 Andrew Ferguson

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
*/


/**
 * Filter search for the shortcode hook.
 *
 * Searches theContent for instances matching the required regex and runs the resulting finds through the fergcorp_blockquote function.
 *
 * @since 0.1
 *
 * @see fergcorp_blockquote
 * @param string $content Content of the post, as passed by the shortcode.
 *
 * @return string Content of the post, filtered.
 */
function fergcorp_blockquote_cite( $content ) {
	$content = preg_replace_callback( "/<blockquote cite[ ]?=[ ]?[\"|'](.*?)[\"|'][ ]?>/", 'fergcorp_blockquote', $content );

	return $content;
}

/**
 * Parses the URL of the citation.
 *
 * Parses the URL of the citation and returns additional information, either the base URL or a link to the image of the site.
 *
 * @since 0.1
 *
 * @param string $source Source URL.
 *
 * @return string Link to cited URL
 */
function fergcorp_blockquote( $source ) {
	$parsed_url = wp_parse_url( $source[1] );
	$host = explode( '\.', $parsed_url['host'] );
	$found_image = false;
	$hose_count = count( $host );
	for ( $i = 0; $i < $hose_count -1; $i++ ) {
		for ( $k = $i; $k < $hose_count; $k++ ) {
			$this_host .= $host[ $k ] . '.';
		}
		if ( file_exists( dirname( __FILE__ ) . '/' . $this_host . 'png' ) ) {
			$img = '<img src="' . get_bloginfo( 'url' ) . '/wp-content/plugins/' . plugin_basename( dirname( __FILE__ ) ) . '/' . $this_host . 'png" border="0" align="left" vspace="5" hspace="5" alt="From ' . $parsed_url['host'] . '"/></a><br />';
			$found_image = true;
			break; // Escape if we find the image.
		}
		$this_host = '';
	}
	if ( ! $found_image ) {
		$img = 'From ' . $parsed_url['host'] . ':';
	}
	return "<a href=\"$source[1]\">$img</a><blockquote>";
}

add_filter( 'the_content', 'fergcorp_blockquote_cite', 1 );
