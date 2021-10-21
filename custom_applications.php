<?php

class Wpcustomapplications{
  
	public function __construct(){
		add_action('init',array($this, 'wp_applications_post_types')); 
	}
  public function wp_applications_post_types(){
    $labels = array(
      'name'                     =>__( 'Applied Jobs '),
      'singular_name'            =>__( 'Applied Job '),
      'add_new'                  =>__( 'Add New', 'Applicant' ),
      'add_new_item'             =>__( 'Add New Applicant ' ),
      'edit_item'                =>__( 'Edit Applied Jobs' ),
      'new_item'                 =>__( 'New Applicant' ),
      'all_items'                =>__( 'All Applied Jobs' ),
      'view_item'                =>__( 'View Applied Job' ),
      'parent_item_colon'        => '',
      'menu_name'                => 'Applied Jobs'
    );
  
    $args = array(
      'labels'                 => $labels,
      'description'            => 'Applicant description',
      'public'                 => true,
      'has_archive'         => true,
    );
    register_post_type( 'appliedjobs', $args ); 
  
  }

}
$objapplications	=	new Wpcustomapplications();


?>