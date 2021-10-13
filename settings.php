<?php
class Wpsubmenu{
	public function __construct(){
		add_action('admin_menu',array($this, 'wp_register_submenu_settings'));
		add_action( 'admin_init', array( $this, 'setup_sections' ) );
		add_action( 'admin_init', array( $this, 'setup_fields' ) );
	}

	public function wp_register_submenu_settings() {
		add_submenu_page( 'edit.php?post_type=jobs', 'Settings', 'Settings', 'administrator', 'job-settings',array($this, 'wp_submenu_settings_callback'));
	}

	public function wp_submenu_settings_callback() {?>
    	<div class="wrap">
        	<h2>Settings Page</h2>
        	<form method="post" action="settings.php">
            	<?php
                	settings_fields( 'job-settings' );
                	do_settings_sections( 'job-settings' );
                	submit_button();
            	?>
        	</form>
    	</div> <?php
	}
	public function setup_sections() {
		add_settings_section( 'general_setting_section', 'General Settings', array( $this, 'general_setting_callback' ), 'job-settings' );
	}
	public function general_setting_callback( $arguments ) {
		echo '';
	}
	public function setup_fields() {
		add_settings_field( 'email_field', 'Email', array( $this, 'email_field_callback' ), 'job-settings', 'general_setting_section' );
	}
	public function email_field_callback( $arguments ) {
		echo '<input name="email_field" id="email_field" type="text" value="' . get_option( 'email_field' ) . '" />';
	}


}	


$objsubmenu		= new Wpsubmenu();

?>