<?php
class Wpsubmenu{
	public function __construct(){
		add_action('admin_menu',array($this, 'wp_register_submenu_settings'));
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
}	


$objsubmenu		= new Wpsubmenu();

?>