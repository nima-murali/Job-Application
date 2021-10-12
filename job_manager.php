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
		add_action('admin_menu',array($this, 'wp_register_submenu_settings'));
		add_action( 'add_meta_boxes',array($this, 'wp_add_location'));
		add_action( 'save_post', array($this, 'wp_location_save' ));
		add_filter( 'the_content', array($this, 'wp_location_get' ) );
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

	public function wp_add_location(){
		add_meta_box( 'location-id', 'Add location',array($this, 'wp_add_location_form'), 'jobs', 'side', 'high');																							
	}
	public function wp_add_location_form($post){
		include plugin_dir_path(__FILE__).'location_form.php';		
	}

	public function wp_location_save( $post_id ){
		$inputs = [
        'location-input',
    	];
    	foreach ( $inputs as $input ) {
    		if (! isset( $_POST['location_name_nonce_field'] )|| ! wp_verify_nonce( $_POST['location_name_nonce_field'], 'save_location_name' ))
    		{
   				wp_nonce_ays( '' );
			} 
			else{
        			update_post_meta( $post_id, $input,sanitize_text_field( $_POST[$input] ));
			}			
    		
    	}
	}

	public function wp_location_get($content){
    	$id = get_the_ID();								// taking postid
		$get_location = get_post_meta( $id, 'location-input', true );
		if(!empty($get_location)){
			return "Locations :  ".$get_location.$content;
		}
		else{
			return $content;
		}
		
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





