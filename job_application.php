<?php

require_once('custom_applications.php');

class Wpapplyjob{
  
	public function __construct(){
		add_action( 'wp_ajax_set_form',array($this,'set_form'));  
        add_action( 'wp_ajax_nopriv_set_form',array($this,'set_form')); 
        add_action( 'init',array($this,'script_enqueue'));
	}
    public function set_form(){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $title = $_POST['jobname'];
       
        $new_post = array(
            'post_title'    => $name,
            'post_content'  => "Applicant Full Name : ".$name."<br>Applied For the position of ".$title."<br><br>Email : ".$email."<br>Primary Skills : ". $message,
            'post_status'   => 'publish',           
            'post_type' => 'applicant'  
        );
        $pid = wp_insert_post($new_post);
      
        if ( empty( $email ) OR ! $email ){
             delete_post_meta( $pid,  'meta_email');
        }
        elseif( ! get_post_meta( $pid, 'meta_email' ) ){
            add_post_meta( $pid, 'meta_email', $email );
        }
        else{
            update_post_meta( $pid, 'meta_email', $email );
        }
        
    }

    public function script_enqueue() {
        wp_register_script( "main", plugin_dir_url(__FILE__).'main.js', array('jquery') );
        wp_localize_script( 'main', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));        
        
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'main' );
     }
}

$objapplyjob	=	new Wpapplyjob();
 

?>