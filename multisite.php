<?php
//Get the post title by post_id and site_id
function rm_get_multisite_post_title( $post_id, $site_id ){
	
	//>>Check the passed Variables
	if( !$post_id || !$site_id ){
		//If either the post id or site id are null, return an empty string
		$title = '';
		return $title;
	}
	
	//>>Access the global variable
	global $wpdb;
	
	//>>Get the DB Table Name
	$wp_prefix = $wpdb->prefix;
	
	//>>>>If the current blog is not the main blog, the db prefix will include the current blog id, so we need to remove it
	$current_blog_id =  get_current_blog_id();
	
	if( $current_blog_id != 1 ){
		$wp_prefix = str_replace( $current_blog_id . '_', '', $wp_prefix );
	}
	
	$table_name = $wp_prefix . $site_id . '_posts';
	
	//>>Get the post title
	$title = $wpdb->get_var(
		"
		SELECT post_title
		FROM $table_name
		WHERE ID = $post_id
		"
	);
	
	//>>Return the title
	return $title;

}
