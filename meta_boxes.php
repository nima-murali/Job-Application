<?php 

class Wpcustommetaboxes{
	public function __construct(){
		add_action( 'add_meta_boxes',array($this, 'wp_add_location'));
		add_action( 'save_post', array($this, 'wp_location_save' ));
		add_filter( 'the_content', array($this, 'wp_location_get' ) );
		add_action( 'add_meta_boxes',array($this, 'wp_add_qualification'));
		add_action( 'save_post', array($this, 'wp_qualification_save' ));
		add_filter( 'the_content', array($this, 'wp_qualification_get' ) );
		
	}

	public function wp_add_location(){
		add_meta_box( 'location-id', 'Add location',array($this, 'wp_add_location_form'), 'jobs', 'side', 'high');																							
	}
	public function wp_add_qualification(){
		add_meta_box( 'qualification-id', 'Add Qualification',array($this, 'wp_add_qualification_form'),'jobs', 'side', 'high');																							
	}
	public function wp_add_location_form($post){
		include plugin_dir_path(__FILE__).'location_form.php';		
	}
	public function wp_add_qualification_form($post){
		include plugin_dir_path(__FILE__).'qualification_form.php';		
	}


	public function wp_location_save( $post_id ){
    	if (! isset( $_POST['location_name_nonce_field'] )|| ! wp_verify_nonce( $_POST['location_name_nonce_field'], 'save_location_name' ))
    	{
   			return $post_id;
		} 
		if ($_POST['location-input']){
        	update_post_meta( $post_id, 'location-input',sanitize_text_field( $_POST['location-input'] ));
		}			
	}

	public function wp_qualification_save( $post_id ){
    	if (! isset( $_POST['qualification_nonce_field'] )|| ! wp_verify_nonce( $_POST['qualification_nonce_field'], 'save_qualification' ))
    	{
   			return $post_id;
		} 
        if(isset($_POST['qualification'])){
            update_post_meta( $post_id, 'qualification',sanitize_text_field( $_POST['qualification']));
        }
	}

	public function wp_location_get($content){
    	$id = get_the_ID();								// taking postid
		if(!empty($get_location)){
			$get_location .='<br>';
			$get_location = get_post_meta( $id, 'location-input', true );
			return $content."Locations :  ".$get_location;
		}
		else{
			return $content;
		}
		
	}
	public function wp_qualification_get($content){
    	$id = get_the_ID();								// taking postid
		$get_qualification = get_post_meta( $id, 'qualification', true );
		if($get_qualification == '--select--' || empty($get_qualification)){
			return $content;
		}
		else{
			$get_qualification .='<br>';
			return "Qualification : ".$get_qualification.$content;
		}
		
	}
}

$obj_custom_metabox		= new Wpcustommetaboxes();
?>