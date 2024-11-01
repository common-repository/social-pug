<?php
/**
 * Plugin Name:         Hubbub Lite
 * Plugin URI:          https://morehubbub.com/
 * Description:         Add customizable website growth tools such as social sharing buttons, follow buttons, and the new Save This mailing list signup form.
 * Version:             1.34.7

 * Requires at least:   5.3
 * Requires PHP:        7.2.24
 * Author:              NerdPress
 * Text Domain:         social-pug
 * Author URI:          https://morehubbub.com/
 * License:             GPL2
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Oops, this file cannot be loaded on its own.' );
}

require_once __DIR__ . '/inc/functions-requirements.php';

if ( ! mv_grow_is_compatible() ) {
	add_action( 'admin_notices', 'mv_grow_incompatible_notice' );
	add_action( 'admin_head', 'mv_grow_throw_warnings' );
	return false;
}

require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/constants.php';

/**
 * Returns plugin activation path. Here for backwards compatibility.
 *
 * @return string
 */
function mv_grow_get_activation_path() {
	return __FILE__;
}

Social_Pug::get_instance();
