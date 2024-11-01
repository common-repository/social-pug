<?php

/**
 * Add the Save This Tool's settings pane to the toolkit array.
 *
 * @param array $tools
 * @return array
 */
function dpsp_tool_email_save_this( $tools = [] ) {
	//@TODO: Use Toolkit class
	$tools['email_save_this'] = [
		'name'               => __( 'Save This', 'social-pug' ),
		'type'               => 'email_tool',
		'activation_setting' => 'dpsp_email_save_this[active]',
		'img'                => 'assets/dist/tool-email-save-this.png?' . DPSP_VERSION,
		'admin_page'         => 'admin.php?page=dpsp-email-save-this',
	];

	return $tools;
}

/**
 * Register the Save This hooks.
 */
function dpsp_register_email_save_this() {
	add_filter( 'dpsp_get_tools', 'dpsp_tool_email_save_this', 10 );
	add_action( 'admin_menu', 'dpsp_register_email_save_this_subpage', 20 );
	add_action( 'admin_init', 'dpsp_email_save_this_register_settings' );

	// Updates default values
	add_action( 'dpsp_update_database', 'dpsp_tool_email_save_this_add_default_settings' );
}

/**
 * Add the default settings for the Save This feature
 */
function dpsp_tool_email_save_this_add_default_settings() {
	$settings = Mediavine\Grow\Settings::get_setting( 'dpsp_email_save_this', [] );
	if ( empty( $settings ) ) {
		return;
	}
	if ( ! empty( $settings['display']['heading'] ) ) {
		return;
	}

	$settings['display']['heading']        			= 'Would you like to save this?';
	$settings['display']['message']           		= 'We\'ll email this post to you, so you can come back to it later!';
	$settings['display']['consent_text']    		= 'I agree to be sent email.';
	$settings['display']['button_text']   			= 'Save This';
	$settings['display']['spotlight'] 				= 'yes';

	update_option( 'dpsp_email_save_this', $settings );
}