<?php
namespace Mediavine\Grow\Tools;

use Mediavine\Grow\Settings;
use Mediavine\Grow\Custom_Color;

class Email_Save_This extends Tool {
	use Renderable;
	
	public function init() {
		$this->slug          = 'email_save_this';
		$this->api_slug      = 'email_save_this';
		$this->name          = __( 'Save This', 'social-pug' );
		$this->type          = 'email_tool';
		$this->settings_slug = 'dpsp_email_save_this';
		$this->img           = 'assets/dist/tool-email-save-this.png?' . DPSP_VERSION;
		$this->admin_page    = 'admin.php?page=dpsp-email-save-this';
		add_filter( 'mv_grow_frontend_data', [ $this, 'frontend_data' ] );
	}

	/**
	 * The rendering action of this tool.
	 *
	 * @return string HTML output of tool
	 */
	public function render() {
		// @TODO Migrate functionality from global function to this class
		$this->has_rendered			= true;
		return '';
	}

	/**
	 * Get the settings
	 *
	 * @return array
	 */
	public static function get_prepared_settings() {
		$settings                    = Settings::get_setting( 'dpsp_email_save_this', [] );
		return $settings;
	}

	/**
	 * Add Data specific to the Save This Tool to the frontend output
	 *
	 * @param array $data
	 * @return array
	 */
	public function frontend_data( $data = [] ) {
		$settings 									= $this->get_prepared_settings();

		$data['saveThis']['spotlight'] 				= ( isset( $settings['display']['spotlight'] ) ) ? sanitize_text_field( ( $settings['display']['spotlight'] ) ) : '';
		$data['saveThis']['successMessage'] 		= ( isset( $settings['display']['successmessage'] ) ) ? sanitize_text_field( ( $settings['display']['successmessage'] ) ) : '';
		$data['saveThis']['consent']				= ( isset( $settings['display']['consent'] ) ) ? sanitize_text_field( ( $settings['display']['consent'] ) ) : '';
		$data['saveThis']['consentForMailingList']	= ( isset( $settings['display']['consent_for_mailing_list'] ) ) ? sanitize_text_field( ( $settings['display']['consent_for_mailing_list'] ) ) : '';
		$data['saveThis']['position']				= ( isset( $settings['display']['position'] ) ) ? sanitize_text_field( ( $settings['display']['position'] ) ) : '';
		$data['saveThis']['mailingListService']		= ( isset( $settings['connection']['service'] ) ) ? sanitize_text_field( ( $settings['connection']['service'] ) ) : '';

		return $data;
	}
}
