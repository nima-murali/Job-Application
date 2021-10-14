<?php

class Wpcustomjobs{
	public function __construct(){
		add_action('init',array($this, 'wp_jobs_post_types'));
		add_shortcode( 'job-post-list', array($this, 'wp_create_shortcode_for_jobs' )); 
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


	public function wp_create_shortcode_for_jobs(){
		$args = array(
			'post_type'      => 'jobs',
            'posts_per_page' => '10',
            'publish_status' => 'published',
        );
  
    	$query = new WP_Query($args);
  
    	if($query->have_posts()) :
  
        	while($query->have_posts()) :
        		$link=get_permaLink();
  
            	$query->the_post() ;
                      
        		$result .= '<div class="job-item">';
        		$result .= '<div class="job-name" ><a href='.$link.'>'. get_the_title() . '</div>';
        		$result .= '</div>';
  
        	endwhile;
  
        	wp_reset_postdata();
    	endif;    
  
    	return $result;            
}
  

}

$objjob	=	new Wpcustomjobs();

?>