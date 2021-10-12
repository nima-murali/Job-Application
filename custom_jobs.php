<?php

class Wpcustomjobs{
	public function __construct(){
		add_action('init',array($this, 'wp_jobs_post_types'));
	}

	public function wp_jobs_post_types(){
		register_post_type('jobs',array(
			'public' => true,
			'labels' => array(
				'name' => 'Job Listing',
				'add_new_item' => 'Add New Job',
				'edit_item' => 'Edit Job',
				'all_items' => 'All Jobs',
			),
			'taxonomies' => array( 'category', 'post_tag' ),
			'menu_icon' => 'dashicons-search',
			'rewrite' => array('slug' => 'jobs'),
			'has_archive' => true,
		));
	}
}

$objjob	=	new Wpcustomjobs();

?>