<label for="location-input">Locations</label>
<input type="text" name="location-input" id="location-input" value="<?php $id = get_the_ID(); $input_value = get_post_meta( $id, 'location-input', true ); echo $input_value ?>">
<?php
	wp_nonce_field( 'save_location_name', 'location_name_nonce_field' ); ?>
