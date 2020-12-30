
<?php

/**
 * @snippet       Add Select Field to "My Account" Register Form | WooCommerce
 * @author        Allan Ramos
 * @testedwith    WooCommerce 3.5.7
 */
  
// -------------------
// 1. Show field @ My Account Registration
  
add_action( 'woocommerce_register_form', 'allan_extra_register_select_field' );
  
function allan_extra_register_select_field() {
    
    ?>
  
<p class="form-row form-row-wide">
<label for="numero_tel"><?php _e( 'Número telefónico', 'woocommerce' ); ?>  <span class="required">*</span></label>
<input type="number" name="numero_tel" id="numero_tel">
</p>
 <p class="form-row form-row-wide">
<label for="fecha_nac"><?php _e( 'Fecha de nacimiento', 'woocommerce' ); ?>  <span class="required">*</span></label>
<input type="date" name="fecha_nac" id="fecha_nac">
</p> 
<?php
    
}
  
// -------------------
// 2. Save field on Customer Created action
  
add_action( 'woocommerce_created_customer', 'allan_save_extra_register_select_field' );
   
function allan_save_extra_register_select_field( $customer_id ) {
if ( isset( $_POST['numero_tel'] ) ) {
        update_user_meta( $customer_id, 'numero_tel', $_POST['numero_tel'] );
}
if ( isset( $_POST['fecha_nac'] ) ) {
        update_user_meta( $customer_id, 'fecha_nac', $_POST['fecha_nac'] );
}
}
  
// -------------------
// 3. Display Select Field @ User Profile (admin) and My Account Edit page (front end)
   
add_action( 'show_user_profile', 'allan_show_extra_register_select_field', 30 );
add_action( 'edit_user_profile', 'allan_show_extra_register_select_field', 30 ); 
add_action( 'woocommerce_edit_account_form', 'allan_show_extra_register_select_field', 30 );
   
function allan_show_extra_register_select_field($user){ 
    
  if (empty ($user) ) {
  $user_id = get_current_user_id();
  $user = get_userdata( $user_id );
  }
    
?>    
        
<p class="form-row form-row-wide">
<label for=""><?php _e( 'Número telefónico', 'woocommerce' ); ?>  <span class="required">*</span></label>
	<input type="number" name="numero_tel" id="numero_tel" value="<?php echo get_the_author_meta( 'numero_tel', $user->ID ); ?>">
</p>
	
<p class="form-row form-row-wide">
<label for=""><?php _e( 'Fecha de nacimiento', 'woocommerce' ); ?>  <span class="required">*</span></label>
	<input type="date" name="fecha_nac" id="fecha_nac" value="<?php echo get_the_author_meta( 'fecha_nac', $user->ID ); ?>">
</p>
  
<?php
  
}
  
// -------------------
// 4. Save User Field When Changed From the Admin/Front End Forms
   
add_action( 'personal_options_update', 'allan_save_extra_register_select_field_admin' );    
add_action( 'edit_user_profile_update', 'allan_save_extra_register_select_field_admin' );   
add_action( 'woocommerce_save_account_details', 'allan_save_extra_register_select_field_admin' );
   
function allan_save_extra_register_select_field_admin( $customer_id ){
if ( isset( $_POST['numero_tel'] ) ) {
   update_user_meta( $customer_id, 'numero_tel', $_POST['numero_tel'] );
}
if ( isset( $_POST['fecha_nac'] ) ) {
   update_user_meta( $customer_id, 'fecha_nac', $_POST['fecha_nac'] );
}
}
?>
