<?php
require_once('custom_applications.php');

class Wpapplyjob{
  
    public function __construct(){
        add_action( 'wp_ajax_display_applied_jobs',array($this,'display_applied_jobs'));  
        add_action( 'wp_ajax_nopriv_display_applied_jobs',array($this,'display_applied_jobs')); 
        add_action( 'init',array($this,'script_enqueue'));
    }
    public function display_applied_jobs(){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $skills = $_POST['skills'];
        $title = $_POST['jobtitle'];
       
        $new_post = array(
            'post_title'    => $name,
            'post_content'  => "Applicant Full Name : ".$name."Applied For the position of ".$title."<br><br>Email : ".$email."<br>Primary Skills : ". $skills,
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

$objapplyjob    =   new Wpapplyjob();
?>