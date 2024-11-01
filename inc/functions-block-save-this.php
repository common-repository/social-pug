<?php
/**
 * Save This Tool
 * Adds hooks for AJAX email sending and verification
 * (Currently disabled, enabling block)
 *
 * @return void
 */
function dpsp_register_save_this_block() {
    // Disabled register_block_type( __DIR__ . '/admin/block-save-this' );

    // Send Save This Email
    add_action( 'wp_ajax_dpsp_ajax_send_save_this_email', 'dpsp_ajax_send_save_this_email' );
    add_action( 'wp_ajax_nopriv_dpsp_ajax_send_save_this_email', 'dpsp_ajax_send_save_this_email' );
    // Verification process
    add_action( 'wp_ajax_dpsp_ajax_verify_save_this_email', 'dpsp_ajax_verify_save_this_email' );
    add_action( 'wp_ajax_nopriv_dpsp_ajax_verify_save_this_email', 'dpsp_ajax_verify_save_this_email' );
    // Error handling
    add_action( 'wp_mail_failed', 'dpsp_save_this_email_error', 10, 1 );     
}

function dpsp_save_this_email_error( $wp_error ) {
    if ( is_wp_error( $wp_error ) ) {
        if ( $wp_error->get_error_code() !== 'wp_mail_failed' ) return;

        $error_message = $wp_error->get_error_message();

        if ( strpos( $error_message, 'hubbub' ) > 0 ) {
            error_log( 'Hubbub: Save This Email Error : ' . $error_message );
        }
    }
    
}  