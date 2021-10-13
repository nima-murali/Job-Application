<?php
class Wpsubmenu{
	public function __construct(){
		add_action('admin_menu',array($this, 'wp_register_submenu_settings'));
		add_action( 'admin_init', array( $this, 'setup_sections_fields' ) );
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

		// Registe input field
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
        	'Input Field',
        	array( $this, 'general_settings_input_field_callback'),
        	'job-settings',
        	'general_settings_section'
    	);

        // Registe textarea field
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

     	// Registe select field
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
        	'select',
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
        	'Radio Field',
        	array( $this, 'myplugin_settings_radio_field_callback'),
        	'job-settings',
        	'general_settings_section'
    	);

	}
	public function general_settings_input_field_callback(){
		$get_input_field = get_option('general_settings_input_field');
		?>
    	<input type="text" name="general_settings_input_field" class="regular-text" value="<?php echo isset($get_input_field) ? esc_attr( $get_input_field ) : ''; ?>" />
    	<?php 
	}
	

	public function general_settings_textarea_field_callback() {
    	$get_textarea_field = get_option('general_settings_textarea_field');
    	$get_checkbox_field = get_option('display');
    	?>
    	<textarea name="general_settings_textarea_field" class="large-text" rows="5"><?php echo isset($get_textarea_field) ? esc_textarea( $get_textarea_field ) : ''; ?></textarea>
    	<?php
    	if($get_checkbox_field == 'True'){ ?>
			<input type="checkbox" id="display" name="display" value="True" checked>Display Content</input>
		<?php
		}
		else{ ?>
			<input type="checkbox" id="display" name="display" value="True">Display Content</input>
		<?php
		}
	}


	public function general_settings_select_field_callback(){
		$get_select_field = get_option('general_settings_select_field');
		?>
    	<select name="general_settings_select_field" class="regular-text">
        	<option value="">--select--</option>
        	<option value="option1" <?php selected( 'option1', $get_select_field ); ?> >Option 1</option>
        	<option value="option2" <?php selected( 'option2', $get_select_field ); ?>>Option 2</option>
    	</select>
    	<?php 
	}

	public function myplugin_settings_radio_field_callback(){
		$get_radio_field = get_option( 'general_settings_radio_field' );
    	?>
    	<label for="value1">
        	<input type="radio" name="general_settings_radio_field" value="value1" <?php checked( 'value1', $get_radio_field ); ?>/> Value 1
    	</label>
    	<label for="value2">
        	<input type="radio" name="general_settings_radio_field" value="value2" <?php checked( 'value2', $get_radio_field ); ?>/> Value 2
    	</label>
    	<?php
	}


}	


$objsubmenu		= new Wpsubmenu();

?>