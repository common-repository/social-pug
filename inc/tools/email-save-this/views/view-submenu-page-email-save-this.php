<form method="post" action="options.php">
	<div class="dpsp-page-wrapper dpsp-page-email-save-this wrap">

        <?php
			$dpsp_email_save_this = Mediavine\Grow\Settings::get_setting( 'dpsp_email_save_this', 'not_set' );
			settings_fields( 'dpsp_email_save_this' );

			$dpsp_email_save_this['display']['heading']        			= ( !isset( $dpsp_email_save_this['display']['heading'] ) ) ? 'Would you like to save this?' : $dpsp_email_save_this['display']['heading'];
			$dpsp_email_save_this['display']['message']           		= ( !isset( $dpsp_email_save_this['display']['message'] ) ) ? 'We\'ll email this post to you, so you can come back to it later!' : $dpsp_email_save_this['display']['message'];
			$dpsp_email_save_this['display']['consent_text']    		= ( !isset( $dpsp_email_save_this['display']['consent_text'] ) ) ? 'I agree to be sent email.' : $dpsp_email_save_this['display']['consent_text'];
			$dpsp_email_save_this['display']['button_text']   			= ( !isset( $dpsp_email_save_this['display']['button_text'] ) ) ? 'Save This' : $dpsp_email_save_this['display']['button_text'];
			//$dpsp_email_save_this['display']['spotlight'] 				= ( !isset( $dpsp_email_save_this['display']['spotlight'] ) ) ? 'yes' : $dpsp_email_save_this['display']['spotlight'];
		?>

		<!-- Page Title -->
		<h1 class="dpsp-page-title">
			<?php esc_html_e( 'Configure Save This Tool Options', 'social-pug' ); ?>
			<input type="hidden" name="dpsp_email_save_this[active]" value="<?php echo ( isset( $dpsp_email_save_this['active'] ) ? 1 : '' ); ?>" <?php echo ( ! isset( $dpsp_email_save_this['active'] ) ? 'disabled' : '' ); ?> />
			<input type="hidden" name="dpsp_email_save_this[verify_email_send_capability]" value="<?php echo ( isset( $dpsp_email_save_this['verify_email_send_capability'] ) ? 'yes' : '' ); ?>" />
		</h1>

		<?php if ( isset( $dpsp_email_save_this['verify_email_send_capability'] ) && $dpsp_email_save_this['verify_email_send_capability'] !== '' ) { ?>
		<!-- Save This Preview -->
		<div class="dpsp-card save-this-preview">
			<div class="dpsp-card-header">
				<?php esc_html_e( 'Preview', 'social-pug' ); ?> 
				<div class="dpsp-setting-field-tooltip-wrapper "><span class="dpsp-setting-field-tooltip-icon"></span><div class="dpsp-setting-field-tooltip dpsp-transition" style="opacity: 0; visibility: hidden;">This is a simple preview of the Save This Tool. Please view your site to see exactly what it looks like.</div></div>
			</div>

			<div class="dpsp-card-inner">
				<div class="wp-block-social-pug-save-this dpsp-email-save-this-tool" style="background: <?php echo ( isset( $dpsp_email_save_this['display']['custom_background_color'] ) ? $dpsp_email_save_this['display']['custom_background_color'] : '' ); ?>;">
					<div id="dpsp-save-this-preview" class="hubbub-save-this-form-wrapper">
						<h3 class="hubbub-save-this-heading"><?php echo ( isset( $dpsp_email_save_this['display']['heading'] ) ? $dpsp_email_save_this['display']['heading'] : 'Would you like to save this?' ); ?></h3>
						<div class="hubbub-save-this-message"><?php echo ( isset( $dpsp_email_save_this['display']['message'] ) ? wp_kses_post( wpautop( $dpsp_email_save_this['display']['message'] ) ) : '<p>Message area</p>' ); ?></div>
						<div>
							<form disabled name="hubbub-save-this-form" method="post" action="">
								<p class="hubbub-save-this-name-paragraph-wrapper"><input disabled type="text" placeholder="First Name" name="hubbub-save-this-name" id="hubbub-save-this-name" class="hubbub-block-save-this-text-control" /></p>
								<p class="hubbub-save-this-emailaddress-paragraph-wrapper"><input disabled type="text" placeholder="Email Address" name="hubbub-save-this-emailaddress" id="hubbub-save-this-emailaddress" class="hubbub-block-save-this-text-control" /></p>
								<div class="hubbub-save-this-preview-checkbox-field-wrapper">
									<p class="hubbub-save-this-consent-paragraph-wrapper"><input type="checkbox" name="hubbub-save-this-consent" id="hubbub-save-this-consent" value="1" /> <label class="hubbub-save-this-consent-text hubbub-save-this-checkbox-text" for="hubbub-save-this-consent"><?php echo ( isset( $dpsp_email_save_this['display']['consent_text'] )  ? $dpsp_email_save_this['display']['consent_text'] : '' ); ?></label></p>
								</div>
								<p class="hubbub-save-this-submit-button-paragraph-wrapper"><input disabled type="submit" value="<?php echo ( isset( $dpsp_email_save_this['display']['button_text'] ) && $dpsp_email_save_this['display']['button_text']  !== '' ? $dpsp_email_save_this['display']['button_text'] : 'Save This' ); ?>" class="hubbub-block-save-this-submit-button" name="hubbub-block-save-this-submit-button" id="hubbub-block-save-this-submit-button"
								style="background-color: <?php echo ( isset( $dpsp_email_save_this['display']['custom_button_color'] ) ? $dpsp_email_save_this['display']['custom_button_color'] : '' ); ?>; color: <?php echo ( isset( $dpsp_email_save_this['display']['custom_button_text_color'] ) ? $dpsp_email_save_this['display']['custom_button_text_color'] : '' ); ?>;"
								/></p>
                				
							</form>
						</div>
						<div class="hubbub-save-this-afterform">
							<p class="hubbub-save-this-afterform-paragraph-wrapper"><?php echo ( isset( $dpsp_email_save_this['display']['after_form'] ) ? $dpsp_email_save_this['display']['after_form'] : '' ); ?></p>
						</div>
					</div>
				</div>
			</div>

			<!-- Custom CSS -->
			<?php $customCSS              = ( ! empty($dpsp_email_save_this['display']['custom_css']) ) ? '<style type="text/css">' . strip_tags( $dpsp_email_save_this['display']['custom_css'] ) . '</style>' : ''; 
			echo $customCSS; ?>

		</div> <!-- End Preview -->
		<?php } // End if verification for preview ?>

		<?php if ( ! isset( $dpsp_email_save_this['verify_email_send_capability'] ) || $dpsp_email_save_this['verify_email_send_capability'] == '' ) { ?>

		<!-- About Save This Tool -->
		<div class="dpsp-card save-this-about">
			<div class="dpsp-card-header">
				<span class="dashicons dashicons-info" style="margin-right: 10px;"></span> About The Save This Tool
			</div>
			<div class="dpsp-card-inner">
				<p><img src="<?php echo DPSP_PLUGIN_DIR_URL . '/assets/dist/tool-email-save-this-preview.png'; ?>" /></p>
				<p>The Save This Tool is a form that can be automatically included in all of your posts and/or pages. When your site's visitors use the Save This form they receive a link to the page they are viewing in their email. Their email address can also be added to a variety of mailing list services.</p>
			</div>

		</div>
		<?php } // end if verification ?>
		
		<?php if ( ! isset( $dpsp_email_save_this['verify_email_send_capability'] ) || $dpsp_email_save_this['verify_email_send_capability'] == '' ) { ?>
			<!-- Test Email -->
			<div class="dpsp-card save-this-verify">
				<div class="dpsp-card-header">
					<span class="dashicons dashicons-info" style="margin-right: 10px;"></span> Verify Email
				</div>
				<div class="dpsp-card-inner">

				<?php 
					
					// Use later? When we want to show all Administrators for the website
					// and we can send an email to any one of them to verify.
					// function get_administrator_emails() {
					//     $blogusers = get_users('role=Administrator');
					//     foreach ($blogusers as $user) {
					//         echo $user->user_email;
					//     }
					// }

					$hubbub_currently_logged_in_user = wp_get_current_user();

					$hubbub_admin_email = $hubbub_currently_logged_in_user->user_email;
					$hubbub_verify_nonce = wp_create_nonce( 'hubbub-save-this-verify' );

					if ( ! $hubbub_admin_email || $hubbub_admin_email == '' ) { ?>
						<p>To use the email sending verification process, please set an Adminstration Email Address in <a href="<?php echo admin_url( 'options-general.php' ); ?>">WordPress' General Settings</a>.</p>
					<?php } else { ?>
						<p>To begin, we'd like to verify that your WordPress installation is capable of sending email. Click the "Send Test Email" button to <strong>email <span class="hubbub-admin-email-highlight"><?php echo $hubbub_admin_email; ?></span></strong>. When you receive the email, click the link within it to verify that email works. Need help? <a href="https://morehubbub.com/docs/how-to-use-save-this/" target="_blank" title="Learn More about the Save This tool">Review our Support Doc</a>.</p>
						<p>Not the right email address? <a href="<?php echo admin_url( 'profile.php' ); ?>">Update the email address on your user profile</a>.</p>
						<p><a id="hubbub-email-save-this-verify-email" data-admin-email="<?php echo esc_attr( $hubbub_admin_email ); ?>" class="dpsp-button-primary" target="_blank" href="#" ><?php esc_html_e( 'Send Test Email', 'social-pug' ); ?></a></p>
						<p>If you're sure that your site can send email successfully, you can <a href="<?php echo admin_url( 'admin.php?page=dpsp-email-save-this&verify=1252023' ); ?>">skip this step</a>.</p>
					<?php } ?>
					
				</div>
			</div>
		<?php } // End verification ?>

		<?php if ( isset( $dpsp_email_save_this['verify_email_send_capability'] ) && $dpsp_email_save_this['verify_email_send_capability'] !== '' ) { ?>

			<!-- General Display Settings -->
			<div class="dpsp-card">

				<div class="dpsp-card-header">
					<?php esc_html_e( 'Form Display Settings', 'social-pug' ); ?>
				</div>

				<div class="dpsp-card-inner">

					<?php 
					dpsp_settings_field(
							'select',
							'dpsp_email_save_this[display][position]',
							( isset( $dpsp_email_save_this['display']['position'] ) ) ? $dpsp_email_save_this['display']['position'] : 'middle',
							__( 'Position', 'social-pug' ),
							[
								'top'  => __( 'Top', 'social-pug' ),
								'middle' => __( 'Middle', 'social-pug' ),
								'after-first-image-middle' => __( 'After First Image (middle if no image found)', 'social-pug' ),
								'after-first-image' => __( 'After First Image (bottom if no image found)', 'social-pug' ),
								'bottom' => __( 'Bottom', 'social-pug' ),
							],
							__( 'Where in your post content would you like to the Save This form to be shown?', 'social-pug' )
					); ?>

					<?php dpsp_settings_field( 'text', 'dpsp_email_save_this[display][heading]', ( isset( $dpsp_email_save_this['display']['heading'] ) ? $dpsp_email_save_this['display']['heading'] : '' ), __( 'Heading', 'social-pug' ), [ 'Would you like to save this?' ], __( 'The call-to-action headline displayed above the email input field of the form.', 'social-pug' ) ); ?>

					<?php dpsp_settings_field( 'textarea', 'dpsp_email_save_this[display][message]', ( isset( $dpsp_email_save_this['display']['message'] ) ? $dpsp_email_save_this['display']['message'] : '' ), __( 'Message', 'social-pug' ), [ 'We\'ll email this post to you, so you can come back to it later!' ], __( 'The copy displayed between the headline above and the form below. Some HTML tags are allowed. Paragraph tags automatically added.', 'social-pug' ) ); ?>

					<?php dpsp_settings_field( 'switch', 'dpsp_email_save_this[display][name_field]', ( isset( $dpsp_email_save_this['display']['name_field'] ) ? $dpsp_email_save_this['display']['name_field'] : '' ), __( 'Show name field', 'social-pug' ), [ 'yes' ], __( 'Require the user to provide a name', 'social-pug' ) ); ?>

					<!-- <div class="dpsp-setting-field-wrapper dpsp-email-save-this-name-field-label-wrapper">
						<?php // dpsp_settings_field( 'text', 'dpsp_email_save_this[display][name_field_label]', ( isset( $dpsp_email_save_this['display']['name_field_label'] ) ? $dpsp_email_save_this['display']['name_field_label'] : 'Name' ), __( 'Name field label', 'social-pug' ), [ 'Name'], __( 'The label for the name field. E.g. "Full Name" or "Name"', 'social-pug' ) ); ?>
					</div> -->

					<?php dpsp_settings_field( 'text', 'dpsp_email_save_this[display][button_text]', ( isset( $dpsp_email_save_this['display']['button_text'] ) && $dpsp_email_save_this['display']['button_text'] !== '' ? $dpsp_email_save_this['display']['button_text'] : 'Save This' ), __( 'Button text', 'social-pug' ), [ 'Save This' ], __( 'The text of the button in the Save This form.', 'social-pug' ) ); ?>

					<?php
					 dpsp_settings_field(
						'select',
						'dpsp_email_save_this[display][consent]',
						( isset( $dpsp_email_save_this['display']['consent'] ) ) ? $dpsp_email_save_this['display']['consent'] : '',
						__( 'Show consent checkbox', 'social-pug' ),
						[
							'' => __( 'Disabled', 'social-pug' ),
							'yes' => __( 'Consent required to submit', 'social-pug' ),
							'mailing-list' => __( 'Consent for mailing list only', 'social-pug' ),
						],
						__( 'The consent checkbox can be used for sending the Save This email OR for requiring consent to be added to your mailing list.', 'social-pug' )
					);

					//dpsp_settings_field( 'switch', 'dpsp_email_save_this[display][consent]', ( isset( $dpsp_email_save_this['display']['consent'] ) ? $dpsp_email_save_this['display']['consent'] : '' ), __( 'Show checkbox', 'social-pug' ), [ 'yes' ], __( 'Display a consent checkbox on the form.', 'social-pug' ) ); ?>

					<div class="dpsp-setting-field-wrapper dpsp-email-save-this-checkbox-text-wrapper">
						<?php dpsp_settings_field( 'text', 'dpsp_email_save_this[display][consent_text]', ( isset( $dpsp_email_save_this['display']['consent_text'] ) ? $dpsp_email_save_this['display']['consent_text'] : 'I agree to be sent email.' ), __( 'Checkbox text', 'social-pug' ), [ 'I agree to be sent email.'], __( 'The copy displayed next to the checkbox.', 'social-pug' ) ); ?>
					</div>

					<?php dpsp_settings_field( 'text', 'dpsp_email_save_this[display][after_form]', ( isset( $dpsp_email_save_this['display']['after_form'] ) ? $dpsp_email_save_this['display']['after_form'] : '' ), __( 'After form text', 'social-pug' ), [], __( 'The copy displayed underneath the form.', 'social-pug' ) ); ?>

					<?php dpsp_settings_field( 'text', 'dpsp_email_save_this[display][successmessage]', ( isset( $dpsp_email_save_this['display']['successmessage'] ) ? $dpsp_email_save_this['display']['successmessage'] : 'Saved! We\'ve emailed you a link to this page.' ), __( 'Successful Save Message', 'social-pug' ), [ 'Saved! We\'ve emailed you a link to this page.' ], __( 'After the form is successfully submitted, this message will appear in place of the Save This form. This cannot be blank.', 'social-pug' ) ); ?>

					<?php dpsp_settings_field( 'switch', 'dpsp_email_save_this[display][spotlight]', ( isset( $dpsp_email_save_this['display']['spotlight'] ) ? $dpsp_email_save_this['display']['spotlight'] : '' ), __( 'Spotlight when in view?', 'social-pug' ), [ 'yes' ], __( 'When the form is in view, fade out the rest of the page, spotlighting it.', 'social-pug' ) ); ?>

					<?php // Removed, perhaps temporarily dpsp_settings_field( 'switch', 'dpsp_email_save_this[display][disable_injection_shortcode]', ( isset( $dpsp_email_save_this['display']['disable_injection_shortcode'] ) ? $dpsp_email_save_this['display']['disable_injection_shortcode'] : '' ), __( 'Disable if shortcode present?', 'social-pug' ), [ 'yes' ], __( 'When enabled, do not automatically insert a Save This form if the Save This shortcode is present.', 'social-pug' ) ); ?>

				</div>

			</div>

			<!-- Custom Colors Settings -->
			<div class="dpsp-card">

				<div class="dpsp-card-header">
					<?php esc_html_e( 'Custom Style', 'social-pug' ); ?>
				</div>

				<div class="dpsp-card-inner">

					<?php dpsp_settings_field( 'color-picker', 'dpsp_email_save_this[display][custom_background_color]', ( isset( $dpsp_email_save_this['display']['custom_background_color'] ) ? $dpsp_email_save_this['display']['custom_background_color'] : '' ), __( 'Background color', 'social-pug' ), [] ); ?>
					
					<?php dpsp_settings_field( 'color-picker', 'dpsp_email_save_this[display][custom_button_color]', ( isset( $dpsp_email_save_this['display']['custom_button_color'] ) ? $dpsp_email_save_this['display']['custom_button_color'] : '' ), __( 'Button background color', 'social-pug' ), [], __( 'Try to choose background colors that are high enough contrast against your website\'s background colors. We recommend viewing your form on your website.', 'social-pug' ) ); ?>

					<?php dpsp_settings_field( 'color-picker', 'dpsp_email_save_this[display][custom_button_text_color]', ( isset( $dpsp_email_save_this['display']['custom_button_text_color'] ) ? $dpsp_email_save_this['display']['custom_button_text_color'] : '' ), __( 'Button text color', 'social-pug' ), [], __( 'Try to choose text colors that are high enough contrast against your button\'s background colors. We recommend viewing your form on your website.', 'social-pug' ) ); ?>

					<?php dpsp_settings_field( 'textarea', 'dpsp_email_save_this[display][custom_css]', ( isset( $dpsp_email_save_this['display']['custom_css'] ) ? $dpsp_email_save_this['display']['custom_css'] : '' ), __( 'Custom CSS', 'social-pug' ), [], __( 'Customize the Save This form by supplying style overrides. Do not include style tags.', 'social-pug' ) ); ?>
					<div class="dpsp-setting-field-wrapper dpsp-setting-field-text dpsp-has-field-label">
						<span class="dpsp-email-save-this-help-text">Click "Save Changes" button at bottom of page to preview Custom CSS. This Custom CSS will be added to every page where the Save This form appears. Please see <a href="https://morehubbub.com/docs/save-this-custom-css/" target="_blank" title="Custom CSS Support Doc">this support doc</a> for more information.</span>
					</div>

				</div>

			</div>

			<!-- Email Settings -->
			<div class="dpsp-card">

				<div class="dpsp-card-header">
					<?php esc_html_e( 'Email Settings', 'social-pug' ); ?>
				</div>

				<div class="dpsp-card-inner">

				<?php 

					// Determine default email address
					// If email address includes domain name, use it
					// If any other domain, use wordpress@domain.com
					$website_domain = str_replace( 'www.', '', parse_url( get_site_url(), PHP_URL_HOST ));
					$default_email_address = ( strpos( get_option('admin_email'), $website_domain ) === false ) ? 'wordpress@' . $website_domain : get_option('admin_email');

				?>
				
					<?php dpsp_settings_field( 'text', 'dpsp_email_save_this[email][fromname]', ( isset( $dpsp_email_save_this['email']['fromname'] ) && $dpsp_email_save_this['email']['fromname'] != '' ) ? $dpsp_email_save_this['email']['fromname'] : get_bloginfo( 'name' ), __( 'From Name', 'social-pug' ), [ get_bloginfo( 'name' ) ], __( 'The name displayed on the Save This email that the user receives when they use the form.', 'social-pug' ) ); ?>

					<?php dpsp_settings_field( 'text', 'dpsp_email_save_this[email][fromemail]', ( isset( $dpsp_email_save_this['email']['fromemail'] ) && $dpsp_email_save_this['email']['fromemail'] != '' ) ? $dpsp_email_save_this['email']['fromemail'] : $default_email_address, __( 'From Email Address', 'social-pug' ), [ $default_email_address ], __( 'The email address that the Save This email will come from when they use the form. For best deliverability, we recommend using an email address at your domain (not a Gmail/Yahoo/etc. address).', 'social-pug' ) ); ?>
					<div class="dpsp-setting-field-wrapper dpsp-setting-field-text dpsp-has-field-label">
						<span class="dpsp-email-save-this-help-text">Need email delivery help? Please refer to <a href="https://morehubbub.com/docs/email-deliverability/" target="_blank" title="Read our support doc on email deliverability">this support doc</a>.</span>
					</div>

					<?php
					
					echo '<div class="dpsp-setting-field-wrapper dpsp-has-field-label dpsp-setting-field-image">';
					echo '<label for="dpsp_email_save_this[email][logo]" class="dpsp-setting-field-label">Logo for Email Header</label>';
					
					dpsp_output_backend_tooltip( __( 'Add an image that will be used at the top of the email. We recommend an image that is between 400-600px wide and under 20KB.', 'social-pug' ), false );
					
					echo '<div>';

						$thumb_details = [];
						$image_details = [];

						if ( ! empty( $dpsp_email_save_this['email']['logo'] ) ) {
							$thumb_details = wp_get_attachment_image_src( $dpsp_email_save_this['email']['logo'], 'high' );
							$image_details = wp_get_attachment_image_src( $dpsp_email_save_this['email']['logo'], 'full' );
						}

						if ( ! empty( $thumb_details[0] ) && ! empty( $image_details[0] ) ) {
							$thumb_src = $thumb_details[0];
							$image_src = $image_details[0];
						} else {
							$thumb_src = DPSP_PLUGIN_DIR_URL . 'assets/dist/custom-save-this-logo-placeholder.png?' . DPSP_VERSION;
							$image_src = '';
						}

						echo '<div>';
							echo '<img src="' . esc_attr( $thumb_src ) . '" data-pin-nopin="true" />';
							echo '<span class="dpsp-field-image-placeholder" data-src="' . esc_url( DPSP_PLUGIN_DIR_URL . 'assets/dist/custom-save-this-logo-placeholder.png?' . DPSP_VERSION ) . '"></span>';
						echo '</div>';

						echo '<a class="dpsp-image-select dpsp-button-primary ' . ( ! empty( $dpsp_email_save_this['email']['logo'] ) ? 'dpsp-hidden' : '' ) . '" href="#">' . esc_html__( 'Select Image', 'social-pug' ) . '</a>';
						echo '<a class="dpsp-image-remove dpsp-button-secondary ' . ( empty( $dpsp_email_save_this['email']['logo'] ) ? 'dpsp-hidden' : '' ) . '" href="#">' . esc_html__( 'Remove Image', 'social-pug' ) . '</a>';

						echo '<input class="dpsp-image-id" type="hidden" name="dpsp_email_save_this[email][logo]" value="' . ( ! empty( $dpsp_email_save_this['email']['logo'] ) ? esc_attr( $dpsp_email_save_this['email']['logo'] ) : '' ) . '" />';

					echo '</div>';
				echo '</div>';
					
					
					?>

					<?php dpsp_settings_field( 'switch', 'dpsp_email_save_this[email][featuredimage]', ( isset( $dpsp_email_save_this['email']['featuredimage'] ) ? $dpsp_email_save_this['email']['featuredimage'] : '' ), __( 'Display Post\'s Featured Image?', 'social-pug' ), [ 'yes' ], __( 'Include the featured image (if present) just above the link in the Save This email.', 'social-pug' ) ); ?>

					<?php dpsp_settings_field( 'textarea', 'dpsp_email_save_this[email][emailmessage]', ( isset( $dpsp_email_save_this['email']['emailmessage'] ) ? $dpsp_email_save_this['email']['emailmessage'] : '' ), __( 'Email Message', 'social-pug' ), [], __( 'Included in the email directly above the link to your post. Some HTML tags allowed. Paragraphs automatically added. Thank the person for saving your post?', 'social-pug' ) ); ?>
					<div class="dpsp-setting-field-wrapper dpsp-setting-field-text dpsp-has-field-label">
						<span class="dpsp-email-save-this-help-text">Tip: Use merge fields to personalize the message: <span class="dpsp-email-save-this-email-message-name-field">{name}, </span>{post_title}, {email_address}, {saved_url}, {site_name}, {site_domain}. Please see <a href="https://morehubbub.com/docs/how-to-use-save-this/" target="_blank" title="Save This Support Doc">this support doc</a> for more information.</span>
					</div>

					<?php dpsp_settings_field( 'textarea', 'dpsp_email_save_this[email][emailbottomcontent]', ( isset( $dpsp_email_save_this['email']['emailbottomcontent'] ) ? $dpsp_email_save_this['email']['emailbottomcontent'] : '' ), __( 'Email Bottom Content', 'social-pug' ), [], __( 'Content area at the bottom of the Save This email. Some HTML tags allowed. Paragraphs automatically added.', 'social-pug' ) ); ?>

					<?php dpsp_settings_field( 'color-picker', 'dpsp_email_save_this[email][custom_link_color]', ( isset( $dpsp_email_save_this['email']['custom_link_color'] ) ? $dpsp_email_save_this['email']['custom_link_color'] : '' ), __( 'Custom Link color', 'social-pug' ), [], __( 'The color of all links in the email. Choose a custom link color that matches your branding. Remember, link colors should be obvious and high contrast to stand out. Default is: #003ffe', 'social-pug' ) ); ?>

				</div>

			</div>

			<!-- Mailing List Settings -->
			<div class="dpsp-card">

				<div class="dpsp-card-header">
					<?php esc_html_e( 'Mailing List Options', 'social-pug' ); ?>
				</div>

				<div class="dpsp-card-inner">

					<?php 
						dpsp_settings_field(
								'select',
								'dpsp_email_save_this[connection][service]',
								( isset( $dpsp_email_save_this['connection']['service'] ) ) ? $dpsp_email_save_this['connection']['service'] : 'none',
								__( 'Mailing List Service', 'social-pug' ),
								[
									'none' => __( 'Disabled', 'social-pug' ),
									'convertkit' => __( 'Kit (formerly ConvertKit)', 'social-pug' ),
									'flodesk' => __( 'Flodesk', 'social-pug' ),
									'mailchimp' => __( 'Mailchimp', 'social-pug' ),
									'mailerlite' => __( 'MailerLite', 'social-pug' ),
									'mailerlite-classic' => __( 'MailerLite Classic', 'social-pug' ),
								],
								__( 'The mailing list service you would like to use to collect email addresses using the Save This form.', 'social-pug' )
						); ?>

					<!-- Begin Kit -->
					<div class="dpsp-setting-field-wrapper dpsp-setting-mailing-list-service dpsp-setting-mailing-list-service-convertkit disabled">
						
						<?php if ( ! isset( $dpsp_email_save_this['connection']['convertkit-apikey'] ) || ! isset( $dpsp_email_save_this['connection']['convertkit-apisecret'] ) || $dpsp_email_save_this['connection']['convertkit-apikey'] == '' || $dpsp_email_save_this['connection']['convertkit-apisecret'] == '' ) { ?>
							<div class="dpsp-setting-field-wrapper dpsp-setting-field-text dpsp-has-field-label">
								<a target="_blank" href="https://app.kit.com/account_settings/developer_settings"><?php esc_html_e( 'Get Kit API Credentials', 'social-pug' ); ?></a>
							</div>
						<?php } ?>

						<?php dpsp_settings_field( 'text', 'dpsp_email_save_this[connection][convertkit-apikey]', ( isset( $dpsp_email_save_this['connection']['convertkit-apikey'] ) ? $dpsp_email_save_this['connection']['convertkit-apikey'] : '' ), __( 'Kit API Key', 'social-pug' ), [], __( 'Your Kit API Key.', 'social-pug' ) ); ?>
						<?php dpsp_settings_field( 'text', 'dpsp_email_save_this[connection][convertkit-apisecret]', ( isset( $dpsp_email_save_this['connection']['convertkit-apisecret'] ) ? $dpsp_email_save_this['connection']['convertkit-apisecret'] : '' ), __( 'Kit API Secret', 'social-pug' ), [], __( 'Your Kit API Secret Key. Required for including extra post data for each subscriber.', 'social-pug' ) ); ?>

						<?php if ( ! isset( $dpsp_email_save_this['connection']['convertkit-apikey'] ) ) { ?>
							<div class="dpsp-setting-field-wrapper dpsp-setting-field-text dpsp-has-field-label">
								<span class="dpsp-email-save-this-help-text">Click "Save Changes" button at bottom of page to continue.</span>
							</div>
						<?php } ?>
						<?php if ( isset( $dpsp_email_save_this['connection']['convertkit-apikey'] ) && $dpsp_email_save_this['connection']['convertkit-apikey'] != '' ) {
							
								$save_this_mailing_service = \Mediavine\Grow\Connections\ConvertKit::get_instance();
								$dpsp_convertkit_forms = $save_this_mailing_service::get_forms();
							
								if ( isset( $dpsp_convertkit_forms->forms ) && is_array( $dpsp_convertkit_forms->forms ) && count( $dpsp_convertkit_forms->forms ) > 0 ) {
									$dpsp_convertkit_list = [];
									$dpsp_convertkit_list['none'] = __( 'None', 'social-pug' );
									
									foreach( $dpsp_convertkit_forms->forms as $form ) {								
										$dpsp_convertkit_list[strval($form->id)] = $form->name; // (We are converting the ID (int) to a String here
									}

									dpsp_settings_field(
										'select',
										'dpsp_email_save_this[connection][convertkit-form]',
										( isset( $dpsp_email_save_this['connection']['convertkit-form'] ) ) ? $dpsp_email_save_this['connection']['convertkit-form'] : 'none',
										__( 'Kit Form', 'social-pug' ),
										$dpsp_convertkit_list,
										__( 'Select the Kit Form that you\'d like to add new subscribers to.', 'social-pug' )
									);

								} else { ?>
									<div class="dpsp-setting-field-wrapper dpsp-setting-field-text dpsp-has-field-label">
										<?php echo __( 'No Kit forms found. Please create one on Kit.', 'social-pug' ); ?>
									</div>
									<?php
								}
								
								
							}
						?>

						<?php if ( isset( $dpsp_email_save_this['connection']['convertkit-apisecret'] ) && $dpsp_email_save_this['connection']['convertkit-apisecret'] != '' ) {
							dpsp_settings_field( 'switch', 'dpsp_email_save_this[connection][convertkit-metadata]', ( isset( $dpsp_email_save_this['connection']['convertkit-metadata'] ) ? $dpsp_email_save_this['connection']['convertkit-metadata'] : '' ), __( 'Include extra data?', 'social-pug' ), [ 'yes' ], __( 'Include post title, post ID, and URL with each subscriber added. This is useful for personalization and analytics.', 'social-pug' ) );
						} ?>

					</div>

					<!-- Begin Flodesk -->
					<div class="dpsp-setting-field-wrapper dpsp-setting-mailing-list-service dpsp-setting-mailing-list-service-flodesk disabled">
						
					<?php if ( ! isset( $dpsp_email_save_this['connection']['flodesk-apikey'] ) || $dpsp_email_save_this['connection']['flodesk-apikey'] == '' ) { ?>
						<div class="dpsp-setting-field-wrapper dpsp-setting-field-text dpsp-has-field-label">
							<a target="_blank" href="https://help.flodesk.com/en/articles/8128775-about-api-keys"><?php esc_html_e( 'Get Flodesk API Credentials', 'social-pug' ); ?></a>
						</div>
						<?php } ?>

						<?php dpsp_settings_field( 'text', 'dpsp_email_save_this[connection][flodesk-apikey]', ( isset( $dpsp_email_save_this['connection']['flodesk-apikey'] ) ? $dpsp_email_save_this['connection']['flodesk-apikey'] : '' ), __( 'Flodesk API Key', 'social-pug' ), [], __( 'Your Flodesk API Key.', 'social-pug' ) ); ?>

						<?php if ( isset( $dpsp_email_save_this['connection']['flodesk-apikey'] ) && $dpsp_email_save_this['connection']['flodesk-apikey'] != '' ) {
							
								$save_this_mailing_service = \Mediavine\Grow\Connections\Flodesk::get_instance();
								$dpsp_flodesk_segments = $save_this_mailing_service::get_segments();
							
								if ( is_array( $dpsp_flodesk_segments->data ) && count( $dpsp_flodesk_segments->data ) > 0 ) {
									$dpsp_flodesk_list = [];
									$dpsp_flodesk_list['none'] = __( 'All subscribers', 'social-pug' );
									
									foreach( $dpsp_flodesk_segments->data as $segment ) {
										$dpsp_flodesk_list[strval($segment->id)] = $segment->name; // (We are converting the ID (int) to a String here
									}

									dpsp_settings_field(
										'select',
										'dpsp_email_save_this[connection][flodesk-segment]',
										( isset( $dpsp_email_save_this['connection']['flodesk-segment'] ) ) ? $dpsp_email_save_this['connection']['flodesk-segment'] : 'none',
										__( 'Flodesk Segment', 'social-pug' ),
										$dpsp_flodesk_list,
										__( 'Select the Flodesk Segment that you\'d like to add new subscribers to.', 'social-pug' )
									);

								} else { ?>
									<div class="dpsp-setting-field-wrapper dpsp-setting-field-text dpsp-has-field-label">
										<?php echo __( 'No Flodesk Segments found. Please create one on Flodesk.', 'social-pug' ); ?>
									</div>
								<?php
								
								}
								
								
							}
						?>

					</div>

					<!-- Begin Mailchimp -->
					<div class="dpsp-setting-field-wrapper dpsp-setting-mailing-list-service dpsp-setting-mailing-list-service-mailchimp disabled">
						
						<?php if ( ! isset( $dpsp_email_save_this['connection']['mailchimp-apikey'] ) || $dpsp_email_save_this['connection']['mailchimp-apikey'] == '' ) { ?>
							<div class="dpsp-setting-field-wrapper dpsp-setting-field-text dpsp-has-field-label">
								<a target="_blank" href="https://admin.mailchimp.com/account/api/"><?php esc_html_e( 'Get Mailchimp API Credentials', 'social-pug' ); ?></a>
							</div>
						<?php } ?>

						<?php dpsp_settings_field( 'text', 'dpsp_email_save_this[connection][mailchimp-apikey]', ( isset( $dpsp_email_save_this['connection']['mailchimp-apikey'] ) ? $dpsp_email_save_this['connection']['mailchimp-apikey'] : '' ), __( 'Mailchimp API Key', 'social-pug' ), [], __( 'Your Mailchimp API Key.', 'social-pug' ) ); ?>

						<?php if ( isset( $dpsp_email_save_this['connection']['mailchimp-apikey'] ) && $dpsp_email_save_this['connection']['mailchimp-apikey'] != '' ) {
							
								$save_this_mailing_service = \Mediavine\Grow\Connections\Mailchimp::get_instance();
								$dpsp_mailchimp_lists = $save_this_mailing_service::get_lists();

								$useDefault = false;
							
								if ( is_array( $dpsp_mailchimp_lists->lists ) && count( $dpsp_mailchimp_lists->lists ) > 0 ) {
									$dpsp_mailchimp_list = [];

									if ( count( $dpsp_mailchimp_lists->lists ) == 1 ) {
										$useDefault = true;
										//$dpsp_mailchimp_list['none'] = __( 'Using Default: ', 'social-pug' );

										foreach( $dpsp_mailchimp_lists->lists as $list ) {
											$dpsp_mailchimp_list[strval($list->id)] = 'Using Default: ' . $list->name; // (We are converting the ID (int) to a String here
										}
									} else {

										$dpsp_mailchimp_list['none'] = __( 'None specified. Use default.', 'social-pug' );

										foreach( $dpsp_mailchimp_lists->lists as $list ) {
											$dpsp_mailchimp_list[strval($list->id)] = $list->name; // (We are converting the ID (int) to a String here
										}

									}

									dpsp_settings_field(
										'select',
										'dpsp_email_save_this[connection][mailchimp-list]',
										( isset( $dpsp_email_save_this['connection']['mailchimp-list'] ) ) ? $dpsp_email_save_this['connection']['mailchimp-list'] : 'none',
										__( 'MailChimp List', 'social-pug' ),
										$dpsp_mailchimp_list,
										__( 'Select the Mailchimp List that you\'d like to add new subscribers to.', 'social-pug' )
									);

								} else { ?>
									<div class="dpsp-setting-field-wrapper dpsp-setting-field-text dpsp-has-field-label">
										<?php echo __( 'No Mailchimp Lists found. Please create one on Mailchimp.', 'social-pug' ); ?>
									</div>
									<?php
								}
								
								
							}
							?>

					</div>


					<!-- Begin MailerLite -->
					<div class="dpsp-setting-field-wrapper dpsp-setting-mailing-list-service dpsp-setting-mailing-list-service-mailerlite disabled">
							
						<?php if ( ! isset( $dpsp_email_save_this['connection']['mailerlite-token'] ) || $dpsp_email_save_this['connection']['mailerlite-token'] == '' ) { ?>
							<div class="dpsp-setting-field-wrapper dpsp-setting-field-text dpsp-has-field-label">
								<a target="_blank" href="https://dashboard.mailerlite.com/integrations/api"><?php esc_html_e( 'Generate MailerLite Token', 'social-pug' ); ?></a>
							</div>
						<?php } ?>

						<?php dpsp_settings_field( 'text', 'dpsp_email_save_this[connection][mailerlite-token]', ( isset( $dpsp_email_save_this['connection']['mailerlite-token'] ) ? $dpsp_email_save_this['connection']['mailerlite-token'] : '' ), __( 'MailerLite Token', 'social-pug' ), [], __( 'Your MailerLite API Token.', 'social-pug' ) ); ?>

						<?php if ( isset( $dpsp_email_save_this['connection']['mailerlite-token'] ) && $dpsp_email_save_this['connection']['mailerlite-token'] != '' ) {
							
								$save_this_mailing_service = \Mediavine\Grow\Connections\MailerLite::get_instance();
								$dpsp_mailerlite_groups = $save_this_mailing_service::get_groups();
							
								if ( isset($dpsp_mailerlite_groups->data) && is_array( $dpsp_mailerlite_groups->data ) && count( $dpsp_mailerlite_groups->data ) > 0 ) {
									$dpsp_mailerlite_group_list = [];
									$dpsp_mailerlite_group_list['none'] = __( 'None', 'social-pug' );
									
									foreach( $dpsp_mailerlite_groups->data as $group ) {
										$dpsp_mailerlite_group_list[strval($group->id)] = $group->name; // (We are converting the ID (int) to a String here
									}

									dpsp_settings_field(
										'select',
										'dpsp_email_save_this[connection][mailerlite-group]',
										( isset( $dpsp_email_save_this['connection']['mailerlite-group'] ) ) ? $dpsp_email_save_this['connection']['mailerlite-group'] : 'none',
										__( 'MailerLite Group', 'social-pug' ),
										$dpsp_mailerlite_group_list,
										__( 'Select the MailerLite Group that you\'d like to add new subscribers to.', 'social-pug' )
									);

								} else { ?>
									<div class="dpsp-setting-field-wrapper dpsp-setting-field-text dpsp-has-field-label">
										<?php if ( strlen( $dpsp_email_save_this['connection']['mailerlite-token'] ) < 34 ) { // Very likely MailerLite Classic
											echo __( 'The API Token provided appears to be an API Key for MailerLite Classic or is invalid. Please choose MailerLite Classic.', 'social-pug' ); 
											echo '<br/>';
										} else { ?>
											<?php echo __( 'No MailerLite Groups found. Please create one on MailerLite.', 'social-pug' ); 
										} ?>
									</div>
									<?php
								}
								
								
							}
							?>

					</div>

					<!-- Begin MailerLite Classic -->
					<div class="dpsp-setting-field-wrapper dpsp-setting-mailing-list-service dpsp-setting-mailing-list-service-mailerlite-classic disabled">
							
						<?php if ( ! isset( $dpsp_email_save_this['connection']['mailerlite-classic-apikey'] ) || $dpsp_email_save_this['connection']['mailerlite-classic-apikey'] == '' ) { ?>
							<div class="dpsp-setting-field-wrapper dpsp-setting-field-text dpsp-has-field-label">
								<a target="_blank" href="https://app.mailerlite.com/integrations/api/"><?php esc_html_e( 'Generate MailerLite Classic API Key', 'social-pug' ); ?></a>
							</div>
						<?php } ?>

						<?php dpsp_settings_field( 'text', 'dpsp_email_save_this[connection][mailerlite-classic-apikey]', ( isset( $dpsp_email_save_this['connection']['mailerlite-classic-apikey'] ) ? $dpsp_email_save_this['connection']['mailerlite-classic-apikey'] : '' ), __( 'MailerLite Classic API Key', 'social-pug' ), [], __( 'Your MailerLite Classic API Key.', 'social-pug' ) ); ?>

						<?php if ( isset( $dpsp_email_save_this['connection']['mailerlite-classic-apikey'] ) && $dpsp_email_save_this['connection']['mailerlite-classic-apikey'] != '' ) {
							
								$save_this_mailing_service = \Mediavine\Grow\Connections\MailerLiteClassic::get_instance();
								$dpsp_mailerlite_classic_groups = $save_this_mailing_service::get_groups();
							
								if ( isset($dpsp_mailerlite_classic_groups) && is_array( $dpsp_mailerlite_classic_groups ) && count( $dpsp_mailerlite_classic_groups ) > 0 ) {
									$dpsp_mailerlite_classic_group_list = [];
									$dpsp_mailerlite_classic_group_list['none'] = __( 'None', 'social-pug' );
									
									foreach( $dpsp_mailerlite_classic_groups as $group ) {
										$dpsp_mailerlite_classic_group_list[strval($group['id'])] = $group['name']; // (We are converting the ID (int) to a String here
									}

									dpsp_settings_field(
										'select',
										'dpsp_email_save_this[connection][mailerlite-classic-group]',
										( isset( $dpsp_email_save_this['connection']['mailerlite-classic-group'] ) ) ? $dpsp_email_save_this['connection']['mailerlite-classic-group'] : 'none',
										__( 'MailerLite Classic Group', 'social-pug' ),
										$dpsp_mailerlite_classic_group_list,
										__( 'Select the MailerLite Classic Group that you\'d like to add new subscribers to.', 'social-pug' )
									);

								} else { ?>
									<div class="dpsp-setting-field-wrapper dpsp-setting-field-text dpsp-has-field-label">
										<?php if ( strlen( $dpsp_email_save_this['connection']['mailerlite-classic-apikey'] ) > 33 ) { // Very likely MailerLite (not Classic)
											echo __( 'The API Key provided appears to be an API Token for MailerLite (not Classic) or is invalid.', 'social-pug' ); 
											echo '<br/>';
										} else { ?>
											<?php echo __( 'No MailerLite Classic Groups found. Please create one on MailerLite Classic.', 'social-pug' ); 
										} ?>
									</div>
									<?php
								}
								
								
							}
							?>

					</div>
				</div>

			</div>

			<!-- Automations Settings -->
			<div class="dpsp-card">

				<div class="dpsp-card-header">
					<?php esc_html_e( 'Automation Settings', 'social-pug' ); ?>
				</div>

				<div class="dpsp-card-inner">

					<?php dpsp_settings_field( 'switch', 'dpsp_email_save_this[automation][zapier][enabled]', ( isset( $dpsp_email_save_this['automation']['zapier']['enabled'] ) ? $dpsp_email_save_this['automation']['zapier']['enabled'] : '' ), __( 'Enable Zapier', 'social-pug' ), [ 'yes' ], __( 'When enabled, Save This form data will be sent via webhook to Zapier to trigger automations.', 'social-pug' ) ); ?>

					<div class="dpsp-setting-field-wrapper dpsp-setting-automation dpsp-setting-automation-zapier disabled">
				
						<?php dpsp_settings_field( 'text', 'dpsp_email_save_this[automation][zapier][webhookurl]', ( isset( $dpsp_email_save_this['automation']['zapier']['webhookurl'] ) && $dpsp_email_save_this['automation']['zapier']['webhookurl'] != '' ) ? $dpsp_email_save_this['automation']['zapier']['webhookurl'] : '', __( 'Zap Webhook URL', 'social-pug' ), [ ], __( 'Your Zap\'s webhook URL.', 'social-pug' ) ); ?>

						<div class="dpsp-setting-field-wrapper dpsp-setting-field-text dpsp-has-field-label">
							<span class="dpsp-email-save-this-help-text">Need help with Zapier? Please refer to <a href="https://morehubbub.com/docs/triggering-zaps/" target="_blank" title="Read our support doc on triggering zaps">this support doc</a>.</span>
						</div>

					</div>

				</div>

			</div>

			<!-- Post Type Display Settings -->
			<div class="dpsp-card">

				<div class="dpsp-card-header">
					<?php esc_html_e( 'Enable Post Types', 'social-pug' ); ?>
				</div>

				<div class="dpsp-card-inner">

					<?php dpsp_settings_field( 'checkbox', 'dpsp_email_save_this[post_type_display][]', ( isset( $dpsp_email_save_this['post_type_display'] ) ? $dpsp_email_save_this['post_type_display'] : [] ), '', dpsp_get_post_types() ); ?>

				</div>

			</div>


			<!-- Save Changes Button -->
			<input type="hidden" name="action" value="update" />
			<p class="submit"><input type="submit" class="dpsp-button-primary" value="<?php esc_attr_e( 'Save Changes', 'social-pug' ); ?>" /></p>

	<?php } // End if verification ?>
	<p><strong>Please note:</strong> To ensure that changes take effect, please clear all caches. (Need help? <a href="https://morehubbub.com/docs/cache-help/" target="_blank" title="Read our support doc on caches">See our support doc</a>.)</p>
	<p>⭐ Love Hubbub? Please <a href="https://wordpress.org/support/plugin/social-pug/reviews/?filter=5#new-post" title="Rate Hubbub on WordPress.org">rate Hubbub 5-stars on WordPress.org</a>. Thank you!</p>
	</div>
</form>
<?php do_action( 'dpsp_submenu_page_bottom' ); ?>