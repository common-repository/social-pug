<?php
/**
 * Creates the sub-menu item and page for the Save This form options.
 */
function dpsp_register_email_save_this_subpage() {
	// Only run if tool is active
	if ( ! dpsp_is_tool_active( 'email_save_this' ) ) {
		return;
	}

	add_submenu_page( 'dpsp-social-pug', __( 'Save This', 'social-pug' ), __( 'Save This', 'social-pug' ), 'manage_options', 'dpsp-email-save-this', 'dpsp_email_save_this_subpage' );
}

/**
 * Outputs content to the admin subpage.
 */
function dpsp_email_save_this_subpage() {
	include DPSP_PLUGIN_DIR . '/inc/tools/email-save-this/views/view-submenu-page-email-save-this.php';
}

/**
 *
 */
function dpsp_email_save_this_register_settings() {
	if ( ! dpsp_is_tool_active( 'email_save_this' ) ) {
		return;
	}

	register_setting( 'dpsp_email_save_this', 'dpsp_email_save_this', 'dpsp_email_save_this_settings_sanitize' );
}

/**
 * Filter and sanitize settings.
 *
 * @param array $new_settings
 * @return array
 */
function dpsp_email_save_this_settings_sanitize( $new_settings ) {
    return $new_settings;
}