<label for="qualification">Preffered Qualification:</label>
  	<select name="qualification" id="qualification" >
<?php
	$id = get_the_ID();
	$value = get_post_meta( $id, 'qualification', true );
	if($value == 'B.Tech'){ ?>
		<option >--select--</option>
		<option selected value="B.Tech">B.Tech</option>
		<option value="M.Tech">M.Tech</option>
		<option value="BCA">BCA</option>
		<option value="MCA">MCA</option>
	<?php
	}
	elseif($value == 'M.Tech'){ ?>
		<option >--select--</option>
		<option value="B.Tech">B.Tech</option>
		<option selected value="M.Tech">M.Tech</option>
		<option value="BCA">BCA</option>
		<option value="MCA">MCA</option>
		
	<?php
	}
	elseif($value == 'BCA'){ ?>
		<option >--select--</option>
		<option value="B.Tech">B.Tech</option>
		<option value="M.Tech">M.Tech</option>
		<option selected value="BCA">BCA</option>
		<option value="MCA">MCA</option>
		
	<?php
	}
	elseif($value == 'MCA'){ ?>
		<option >--select--</option>
		<option value="B.Tech">B.Tech</option>
		<option value="M.Tech">M.Tech</option>
		<option value="BCA">BCA</option>
		<option selected value="MCA">MCA</option>
	<?php
	}
	else{ ?>
		<option selected>--select--</option>
		<option value="B.Tech">B.Tech</option>
		<option value="M.Tech">M.Tech</option>
		<option value="BCA">BCA</option>
		<option value="MCA">MCA</option>
	<?php
	}
	?>
	</select>
 <?php
	wp_nonce_field( 'save_qualification', 'qualification_nonce_field' ); ?>