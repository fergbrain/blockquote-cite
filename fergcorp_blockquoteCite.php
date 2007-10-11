<?php
/*
Plugin Name: Blockquote Cite
Plugin URI: http://www.andrewferguson.net/wordpress-plugins/
Plugin Description: Adds citations for the blockquote tag with the cite value is set
Version: 0.3.1
Author: Andrew Ferguson
Author URI: http://www.andrewferguson.net

Adding images to display:
The plugin uses a rather simple, and hopefully idiot proof, way to include images. It just looks in a directory and sees if the domain name is there in the format sld.tld.png. For example: example.com.png or wsj.com.png). Not that it really matters, but I've saving all the images using Photoshop using 32 Colors, Adaptive Color reduction, No dither, no web-snap. File sizes should come out to somewhere around 1kb or less.



Blockquote Cite - Adds citations for the blockquote tag with the cite value is set
Copyright (c) 2006 Andrew Ferguson

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


function fergcorp_blockquote_cite($theContent){
	$theContent = preg_replace("/<blockquote cite[ ]?=[ ]?[\"|'](.*?)[\"|'][ ]?>/e", "fergcorp_blockquote('$1')", $theContent);

	return $theContent;
}

function fergcorp_blockquote($source){
	$parsedURL = parse_url($source);
	$host = split("\.", $parsedURL["host"]);
	$i = count($host);
	$domain = $host[$i-2].".".$host[$i-1];
	if(file_exists(ABSPATH."/wp-content/plugins/fergcorp_blockquote/$domain.png"))
		$img = "<img src=\"".get_bloginfo('url')."/wp-content/plugins/fergcorp_blockquote/$domain.png\" border=\"0\" align=\"left\" vspace=\"5\" hspace=\"5\" alt=\"From $domain\"/></a><br />";
	else
		$img = "From ".$parsedURL["host"].":";
	return "<a href=\"$source\">$img</a><blockquote>";
}

add_filter('the_content', 'fergcorp_blockquote_cite', 1);



?>
