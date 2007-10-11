<?php
/*
Plugin Name: Blockquote Cite
http://www.andrewferguson.net/wordpress-plugins/blockquote-cite/
Plugin Description: Adds citations for the blockquote tag with the cite value
Version: 0.41
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
	$foundImage = false;
	for($i = 0; $i < count($host)-1; $i++){
		for($k = $i; $k < count($host); $k++){
			$thisHost .= $host[$k].".";
		}
		if(file_exists(dirname(__FILE__)."/".$thisHost."png")){
			$img = "<img src=\"".get_bloginfo('url')."/wp-content/plugins/".plugin_basename(dirname(__FILE__))."/".$thisHost."png\" border=\"0\" align=\"left\" vspace=\"5\" hspace=\"5\" alt=\"From ".$parsedURL["host"]."\"/></a><br />";
			$foundImage = true;
			break; //Escape if we find the image
		}
		$thisHost = "";		
	}
	if(!$foundImage)
		$img = "From ".$parsedURL["host"].":";
	return "<a href=\"$source\">$img</a><blockquote>";
}

add_filter('the_content', 'fergcorp_blockquote_cite', 1);



?>