<?php
/**
* Plugin Name: Job Manager
* Plugin URI: https://in.linkedin.com/
* Version: 0.1
* Author: Nima
* Author URI: https://twitter.com/?lang=en
**/


class Wpcustomjobs{
	public function __construct(){
		add_action('init',array($this, 'wp_jobs_post_types'));
		#add_action('admin_menu', array($this, 'wp_add_submenu'));
		add_action('admin_menu',array($this, 'wp_register_submenu_settings'));
	}

	public function wp_jobs_post_types(){
		register_post_type('jobs',array(
			'public' => true,
			'labels' => array(
				'name' => 'Jobs',
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

	public function wp_register_submenu_settings() {
		add_submenu_page( 'edit.php?post_type=jobs', 'Settings', 'Settings', 'administrator', 'job-settings',array($this, 'wp_submenu_settings_callback'));
	}

	public function wp_submenu_settings_callback() {
		echo 'Hii';
	}

}

$objjob	=	new Wpcustomjobs();

?>





