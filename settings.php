<?php
class Wpsubmenu{
	public function __construct(){
		add_action('admin_menu',array($this, 'wp_register_submenu_settings'));
		add_action( 'admin_init', array( $this, 'setup_sections_fields' ) );
		add_filter( 'the_content', array($this,'wp_email_get' ) );
		add_filter( 'the_content', array($this,'wp_display_job_description' ) );
		add_filter( 'the_content', array($this,'wp_display_about_company' ) );
		add_filter( 'the_content', array($this,'wp_mode_of_work' ) );
	}

	public function wp_register_submenu_settings() {
		add_submenu_page( 'edit.php?post_type=jobs', 'Settings', 'Settings', 'administrator', 'job-settings',array($this, 'wp_submenu_settings_callback'));
	}

	public function wp_submenu_settings_callback() {?>
    	<div class="wrap">
        	<h2>Settings Page</h2>
        	<form method="post" action="options.php">
            	<?php
                	settings_fields( 'job-settings' );
                	do_settings_sections( 'job-settings' );
                	submit_button('Save settings');
            	?>
        	</form>
    	</div> <?php
	}

	public function setup_sections_fields(){

		// Setup settings section
		add_settings_section(
        	'general_settings_section',
        	'General Settings',
        	'',
        	'job-settings'
    	);

		// Register input field
		register_setting(
        	'job-settings',
        	'general_settings_input_field',
        	array(
            	'type' => 'string',
            	'sanitize_callback' => 'sanitize_text_field',
            	'default' => ''
        	)
        );

		// Add text fields
        add_settings_field(
        	'general_settings_input_field',
        	'Company Email',
        	array( $this, 'general_settings_input_field_callback'),
        	'job-settings',
        	'general_settings_section'
    	);

        // Register textarea field
    	register_setting(
        	'job-settings',
        	'general_settings_textarea_field',
        	array(
            	'type' => 'string',
            	'sanitize_callback' => 'sanitize_textarea_field',
            	'default' => ''
        	)
    	);

    	// Add textarea fields
     	add_settings_field(
        	'general_settings_textarea_field',
        	'About the Company',
        	array( $this, 'general_settings_textarea_field_callback'),
        	'job-settings',
        	'general_settings_section'
    	);

     	// Register checkbox field
    	register_setting(
        	'job-settings',
        	'general_settings_checkbox_field',
        	array(
            	'type' => 'string',
            	'sanitize_callback' => 'sanitize_text_field',
            	'default' => ''
        	)
    	);

    	// Add checkbox fields
     	add_settings_field(
        	'general_settings_checkbox_field',
        	'Display the above content ?',
        	array( $this, 'general_settings_checkbox_field_callback'),
        	'job-settings',
        	'general_settings_section'
    	);

     	// Register select field
    	register_setting(
        	'job-settings',
        	'general_settings_select_field',
        	array(
            	'type' => 'string',
            	'sanitize_callback' => 'sanitize_text_field',
            	'default' => ''
        	)
    	);

    	// Add select fields
     	add_settings_field(
        	'general_settings_select_field',
        	'Mode of Work',
        	array( $this, 'general_settings_select_field_callback'),
        	'job-settings',
        	'general_settings_section'
    	);

    	// register radio fields
     	register_setting(
        	'job-settings',
        	'general_settings_radio_field',
        	array(
            	'type' => 'string',
            	'sanitize_callback' => 'sanitize_text_field',
            	'default' => ''
        	)
    	);

    	// Add radio fields
    	add_settings_field(
        	'general_settings_radio_field',
        	'Hide job description ?',
        	array( $this, 'myplugin_settings_radio_field_callback'),
        	'job-settings',
        	'general_settings_section'
    	);

	}
	public function general_settings_input_field_callback(){
		$get_input_field = get_option('general_settings_input_field');
		?>
    	<input type="email" name="general_settings_input_field" class="regular-text" value="<?php echo isset($get_input_field) ? esc_attr( $get_input_field ) : ''; ?>" />
    	<?php 
	}
	

	public function general_settings_textarea_field_callback() {
    	$get_textarea_field = get_option('general_settings_textarea_field');
    	?>
    	<textarea name="general_settings_textarea_field" class="large-text" rows="5"><?php echo isset($get_textarea_field) ? esc_textarea( $get_textarea_field ) : ''; ?></textarea>
    	<?php
	}

	public function general_settings_checkbox_field_callback(){
		$get_checkbox_field = get_option('general_settings_checkbox_field');
		if($get_checkbox_field == 'True'){
		?>
			<input type="checkbox" name="general_settings_checkbox_field" value="True" checked>Display Content</input>
		<?php
		}
		else{
			?>
			<input type="checkbox" name="general_settings_checkbox_field" value="True">Display Content</input>
			<?php
		}
	}


	public function general_settings_select_field_callback(){
		$get_select_field = get_option('general_settings_select_field');
		?>
    	<select name="general_settings_select_field" class="regular-text">
        	<option value="">--select--</option>
        	<option value="Work-from-home" <?php selected( 'Work-from-home', $get_select_field ); ?> >Work from home</option>
        	<option value="Offline" <?php selected( 'Offline', $get_select_field ); ?>>Offline</option>
    	</select>
    	<?php 
	}

	public function myplugin_settings_radio_field_callback(){
		$get_radio_field = get_option( 'general_settings_radio_field' );
    	?>
    	<label for="yes">
        	<input type="radio" name="general_settings_radio_field" value="yes" <?php checked( 'yes', $get_radio_field ); ?>/> yes
    	</label>
    	<label for="no">
        	<input type="radio" name="general_settings_radio_field" value="no" <?php checked( 'no', $get_radio_field ); ?>/> no
    	</label>
    	<?php
	}



	// settings action

	public function wp_email_get($content){
		$post_type = get_post_type();
		if($post_type == 'jobs'){
			$get_input_field = get_option('general_settings_input_field');
			if (isset($get_input_field)){
				return "Company email : ".$get_input_field.$content;
			}
			else{
				return $content;
			}
		}
	}


	public function wp_display_job_description($content){

		$post_type = get_post_type();
		if($post_type == 'jobs'){
			$radio_field_value = get_option( 'general_settings_radio_field' );
			if($radio_field_value == 'yes'){
					return " ";
			}
			else{
				return $content;
			}
		}
		
	}

	public function wp_display_about_company($content){
		$post_type = get_post_type();
		if($post_type == 'jobs'){
			$checkbox_field_value = get_option('general_settings_checkbox_field');
			$textarea_field_value = get_option('general_settings_textarea_field');
			if($checkbox_field_value == 'yes'){
				return $content.$textarea_field_value;
			}
			else{
				return $content;
			}
		}
	}

	public function wp_mode_of_work($content){
		$post_type = get_post_type();
		if($post_type == 'jobs'){
			$select_field_value = get_option('general_settings_select_field');
			if($select_field_value == 'Work-from-home'){
				return $content."Mode of Work : ".$select_field_value;
			}
			if($select_field_value == 'Offline'){
				return $content."Mode of Work : ".$select_field_value;
			}
			else{
				return $content;
			}

		}
	}

}	


$objsubmenu		= new Wpsubmenu();

?>