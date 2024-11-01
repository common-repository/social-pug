<?php
/**
 * AJAX callback for Save This Block and Tool
 * 
 * @return boolean
 */
function dpsp_ajax_send_save_this_email() {
	$dpsp_token = filter_input( INPUT_POST, '_ajax_nonce' );
	if ( empty( $dpsp_token ) || ! wp_verify_nonce( $dpsp_token, 'dpsp_token' ) ) {
		echo 0;
		wp_die();
	}

	$form_post = stripslashes_deep( $_POST );

	if ( empty( $form_post['email'] ) ) {
		echo 0;
		wp_die();
	}

	if ( ! empty( $form_post['snare'] ) ) { // Likely a bot
		echo 0;
		wp_die();
	}

	do_action( 'hubbub_save_this_action_preparing', $form_post['postID'] );

	$settings = \Mediavine\Grow\Settings::get_setting( 'dpsp_email_save_this', [] );

	/** Data Processing  */

	$name					= ( ! empty( $settings['display']['name_field'] && $settings['display']['name_field'] == 'yes' && ! empty( $form_post['name'] ) ) ) ? $form_post['name'] : false;
	$email_address      	= sanitize_email( $form_post['email'] );
	
	$post_id				= ( ! empty( $form_post['postID'] ) ) ? $form_post['postID'] : 'None';
    $post_url    			= ( ! empty( $form_post['postURL'] ) ) ? $form_post['postURL'] : 'No link available';
    $post_title  			= ( ! empty( $form_post['postTitle'] ) ) ? $form_post['postTitle'] : 'Untitled post';
	$is_shortcode  			= ( ! empty( $form_post['isShortcode'] && $form_post['isShortcode'] != 'false' ) ) ? true : false;

	$consentCheckbox		= ( ! empty( $form_post['consentCheckbox'] ) ) ? $form_post['consentCheckbox'] : 'na';
	
	$site_title 			= get_bloginfo( 'name' );
	$site_url 				= get_bloginfo( 'url' );
	
	$email_fromName  		= ( ! empty( $settings['email']['fromname'] ) ) ? $settings['email']['fromname'] : 'Hubbub';
	$email_fromAddress 		= ( ! empty( $settings['email']['fromemail'] ) ) ? $settings['email']['fromemail'] : 'no-reply@morehubbub.com';
	$email_showFeaturedImage = ( ! empty( $settings['email']['featuredimage'] ) ) ? $settings['email']['featuredimage'] : '';
	$email_message			= ( ! empty( $settings['email']['emailmessage'] ) ) ? $settings['email']['emailmessage'] : '';
	$email_bottomContent	= ( ! empty( $settings['email']['emailbottomcontent'] ) ) ? $settings['email']['emailbottomcontent'] : '';
	$email_customLinkColor	= ( ! empty( $settings['email']['custom_link_color'] ) ) ? $settings['email']['custom_link_color'] : '#003ffe';

	$email_featuredImageURL = ( $email_showFeaturedImage == 'yes' ) ? get_the_post_thumbnail_url( $post_id, 'large' ) : '';

	/** Data Filters */

	$name					= apply_filters( 'hubbub_save_this_filter_name', $name, $post_id, $is_shortcode );
	$email_address			= apply_filters( 'hubbub_save_this_filter_email_address', $email_address, $post_id, $is_shortcode );
	$post_url 				= apply_filters( 'hubbub_save_this_filter_post_url', $post_url, $post_id, $is_shortcode );
	$post_title 			= apply_filters( 'hubbub_save_this_filter_post_title', $post_title, $post_id, $is_shortcode );
	$email_fromName 		= apply_filters( 'hubbub_save_this_filter_email_fromname', $email_fromName, $post_id, $is_shortcode );
	$email_fromAddress		= apply_filters( 'hubbub_save_this_filter_email_fromaddress', $email_fromAddress, $post_id, $is_shortcode );
	$email_featuredImageURL = apply_filters( 'hubbub_save_this_filter_email_featuredimageurl', $email_featuredImageURL, $post_id, $is_shortcode );
	$email_message			= apply_filters( 'hubbub_save_this_filter_email_message', wp_kses_post( wpautop( $email_message ) ), $post_id, $is_shortcode );
	$email_subject			= apply_filters( 'hubbub_save_this_filter_email_subject', 'You Saved This: ' . $post_title, $post_id, $is_shortcode );
	$email_bottomContent	= apply_filters( 'hubbub_save_this_filter_email_bottomcontent', wp_kses_post( wpautop( $email_bottomContent ) ), $post_id, $is_shortcode );
	$email_customLinkColor 	= apply_filters( 'hubbub_save_this_filter_email_customlinkcolor', $email_customLinkColor, $post_id, $is_shortcode );

	// If {{NAME}} is in the email message, replace with name (or remove if not present)
	// Optional additional filter for after the name has been replaced
	$email_message			= str_replace( '{name}', $name, $email_message );
	$email_message			= str_replace( '{post_title}', $post_title, $email_message );
	$email_message			= str_replace( '{email_address}', $email_address, $email_message );
	$email_message			= str_replace( '{saved_url}', $post_url, $email_message );
	$email_message			= str_replace( '{site_name}', $site_title, $email_message );
	$email_message			= str_replace( '{site_url}', $site_url, $email_message );
	$email_message			= str_replace( '{site_domain}', parse_url( $site_url, PHP_URL_HOST ), $email_message );

	$email_message			= apply_filters( 'hubbub_save_this_filter_email_message_complete', $email_message, $post_id, $is_shortcode );

	$email_bottomContent	= str_replace( '{name}', $name, $email_bottomContent );
	$email_bottomContent	= str_replace( '{post_title}', $post_title, $email_bottomContent );
	$email_bottomContent	= str_replace( '{email_address}', $email_address, $email_bottomContent );
	$email_bottomContent	= str_replace( '{saved_url}', $post_url, $email_bottomContent );
	$email_bottomContent	= str_replace( '{site_name}', $site_title, $email_bottomContent );
	$email_bottomContent	= str_replace( '{site_url}', $site_url, $email_bottomContent );
	$email_bottomContent	= str_replace( '{site_domain}', parse_url( $site_url, PHP_URL_HOST ), $email_bottomContent );

	$email_bottomContent	= apply_filters( 'hubbub_save_this_filter_email_bottomcontent_complete', $email_bottomContent, $post_id, $is_shortcode );

	/** Constructing Email */

	$email_post_title_link  = '<a href="' . esc_url( $post_url ) . '" target="_blank" style="color:'.$email_customLinkColor.';">' . esc_html( $post_title ) . '</a>';

	$headers = [
		'From: ' . $email_fromName . ' <' . $email_fromAddress . '>',
		'Reply-To: ' . $email_fromName . ' <' . $email_fromAddress . '>',
		'Hubbub: Save This form submission',
	];

	$headers = apply_filters( 'hubbub_save_this_filter_headers', $headers, $post_id, $is_shortcode );

	$powered_by = 'Powered by <a title="Hubbub: The best social sharing plugin for WordPress" href="https://morehubbub.com/" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; text-decoration: none; color: rgba(0,0,0,.4) !important; ">Hubbub Pro+</a>';
	$powered_by = apply_filters( 'hubbub_save_this_filter_poweredby', $powered_by, $post_id, $is_shortcode );

	// Load HTML template for email based on priority
	// 1. In the uploads directory
	// 2. In the theme directory
	// 3. Hubbub's built-in template

	$upload_directory = wp_upload_dir();

	if ( file_exists( $upload_directory['basedir'] . '/hubbub/save-this-email-template.html' ) ) {
		$html_template = file_get_contents( $upload_directory['basedir'] . '/hubbub/save-this-email-template.html' );	
	}

	$in_theme_directory = get_theme_file_path( '/hubbub/save-this-email-template.html' );

	if ( empty( $html_template ) && file_exists( $in_theme_directory ) ) {
		$html_template = file_get_contents( $in_theme_directory );	
	}

	if ( empty( $html_template ) ) {
		$html_template = file_get_contents( __DIR__ . '/tools/email-save-this/email-template.html' );
	}

	$html_template = apply_filters( 'hubbub_save_this_filter_html_template', $html_template, $post_id, $is_shortcode );

	$html_template = str_replace( '{{VERIFYBUTTON}}', '', $html_template ); // Removing Verify button

	// Already filtered in "Filters" section
	$html_template = str_replace( '{{URL}}', esc_url( $post_url ), $html_template );
	if ( $email_featuredImageURL != '' ) {
		$html_template = str_replace( '{{FEATUREDIMAGE}}', 
						'<a href="' . esc_url( $post_url ) . '" target="_blank"><img style="max-width: 80%; max-height: 400px;" alt="The featured image for the post you saved." src="' . esc_url( $email_featuredImageURL ) . '" /></a>',
						$html_template );
	} else {
		$html_template = str_replace( '{{FEATUREDIMAGE}}', '', $html_template );
	}
	$html_template = str_replace( '{{EMAILMESSAGE}}', $email_message, $html_template );
	$html_template = str_replace( '{{BOTTOMCONTENT}}', $email_bottomContent, $html_template );
	$html_template = str_replace( ['000LINKCOLOR000','000LINKCOLOR000'], $email_customLinkColor, $html_template );
	$html_template = str_replace( '{{SITEURL}}', esc_url( $site_url ), $html_template );
	$html_template = str_replace( '{{POWEREDBY}}', $powered_by, $html_template );

	//** Additional Filters */
	
	$html_template = str_replace( '{{HEADING}}', 
						apply_filters( 'hubbub_save_this_filter_email_heading', 'You Saved This:', $post_id, $is_shortcode ),
						$html_template );

	$html_template = str_replace( '{{RAWURL}}',
						apply_filters( 'hubbub_save_this_filter_raw_url', esc_url( $post_url ), $post_id, $is_shortcode ), 
						$html_template );

	$html_template = str_replace( '{{POSTTITLELINK}}', 
						apply_filters( 'hubbub_save_this_filter_post_title_link', $email_post_title_link, $post_id, $is_shortcode ),
						$html_template );

	$html_template = str_replace( '{{footerTITLE}}', 
						esc_html( apply_filters( 'hubbub_save_this_filter_footer_site_title', $site_title, $post_id, $is_shortcode ) ),
						$html_template );

	$email_image_details = wp_get_attachment_image_src( $settings['email']['logo'], 'full' );
	$html_template = str_replace( '{{SITETITLE}}', 
						( is_array( $email_image_details ) ) ? '' : '<a href="' . esc_url( $site_url ) . '">' . esc_html( $site_title ) . '</a>',
						$html_template );

	$html_template = str_replace( '{{SITELOGO}}', 
						( is_array( $email_image_details ) ) ? '<a href="' . esc_url( $site_url ) . '"><img style="max-width: 80%" src="' . esc_attr( apply_filters( 'hubbub_save_this_filter_image_url', $email_image_details[0], $post_id, $is_shortcode ) ) . '" alt="' . esc_attr( $site_title ) . '" width="400" max-width="100%" /></a>' : '',
						$html_template );
	
	/** Custom Sections */
	$custom_after_logo 				= apply_filters( 'hubbub_save_this_filter_custom_after_logo', '', $post_id, $is_shortcode );
	$custom_after_message 			= apply_filters( 'hubbub_save_this_filter_custom_after_message', '', $post_id, $is_shortcode );
	$custom_after_post_link 		= apply_filters( 'hubbub_save_this_filter_custom_after_post_link', '', $post_id, $is_shortcode );
	$custom_before_bottom_content 	= apply_filters( 'hubbub_save_this_filter_custom_before_bottom_content', '', $post_id, $is_shortcode );
	$custom_after_bottom_content 	= apply_filters( 'hubbub_save_this_filter_custom_after_bottom_content', '', $post_id, $is_shortcode );

	
	$html_template = ( $custom_after_logo != '' ) ? 
					str_replace( '{{CUSTOMAFTERLOGO}}', '<tr style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
                    <td style="-ms-text-size-adjust: 100%; padding-top: 20px; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important;" align="center">
                        '.$custom_after_logo.'
                    </td>
          			</tr>', $html_template ) :
					str_replace( '{{CUSTOMAFTERLOGO}}', '', $html_template ); // Custom Section is its own row, may change in the future
	$html_template = str_replace( '{{CUSTOMAFTERMESSAGE}}', $custom_after_message, $html_template );
	$html_template = str_replace( '{{CUSTOMAFTERPOSTLINK}}', $custom_after_post_link, $html_template );
	$html_template = str_replace( '{{CUSTOMBEFOREBOTTOMCONTENT}}', $custom_before_bottom_content, $html_template );
	$html_template = str_replace( '{{CUSTOMAFTERBOTTOMCONTENT}}', $custom_after_bottom_content, $html_template );
	

	// No Longer in Use $html_template = str_replace( '{{EMAIL_PREVIEW_TEXT}}', 'You saved a link!', $html_template );

	$html_template = apply_filters( 'hubbub_save_this_filter_html_email_complete', $html_template, $post_id, $is_shortcode );

	add_filter( 'wp_mail_content_type', 'dpsp_set_html_mail_content_type' ); // Allows HTML email for wp_mail (will be removed right after send)

	do_action( 'hubbub_save_this_action_before_sent', $post_id, $is_shortcode );
	
	$sent = wp_mail( 
		$email_address,
		$email_subject,
		$html_template,
		$headers
	);

	do_action( 'hubbub_save_this_action_sent', $post_id, $is_shortcode );

	remove_filter( 'wp_mail_content_type', 'dpsp_set_html_mail_content_type' ); // Resets wp_mail content type default to text

	do_action( 'hubbub_save_this_action_before_count_increment', $post_id, $is_shortcode );

	// Count Saves
	$save_count = ( ! empty( get_post_meta( $post_id, 'dpsp_save_this_count', true ) ) ) ? intval( get_post_meta( $post_id, 'dpsp_save_this_count', true ) )+1 : 1;
	update_post_meta( $post_id, 'dpsp_save_this_count', $save_count );

	do_action( 'hubbub_save_this_action_counted', $post_id, $is_shortcode );

	do_action( 'hubbub_save_this_action_before_cookie', $post_id, $is_shortcode );
	
	$should_save_cookie = apply_filters( 'hubbub_save_this_filter_should_save_cookie', 'true', $post_id, $is_shortcode );
	$should_save_cookie = ( $should_save_cookie == 'false' ) ? false : true;

	if ( $should_save_cookie ) {
		setcookie( "hubbub-save-this-name", $name, strtotime( '+1 year', time() ), '/', COOKIE_DOMAIN );
		setcookie( "hubbub-save-this-email-address", $email_address, strtotime( '+1 year', time() ), '/', COOKIE_DOMAIN );
	}

	do_action( 'hubbub_save_this_action_cookie_saved', $post_id, $is_shortcode );

	/**
	 * Add email address to mailing list?
	 */
	if ( isset( $settings['connection']['service'] ) && $settings['connection']['service'] != 'none' ) {
		if ( $settings['display']['consent'] == "" || ( $settings['display']['consent'] == 'yes' && $consentCheckbox == "yes" ) || ( $settings['display']['consent'] == 'mailing-list' && $consentCheckbox == 'yes' ) ) {

			do_action( 'hubbub_save_this_action_before_mailing_list_add', $post_id, $is_shortcode );

			$metadata = array(
				'hubbub_source' 		=> 'save_this',
				'hubbub_position' 		=> ( $is_shortcode ) ? 'shortcode' : $settings['display']['position'],
				'hubbub_post_title' 	=> $post_title,
				'hubbub_post_id'		=> $post_id,
				'hubbub_post_url'		=> $post_url
			);

			$metadata = apply_filters( 'hubbub_save_this_filter_mailing_list_service_custom_metadata', $metadata, $post_id, $is_shortcode );

			if ( !is_array( $metadata ) ) {
				$metadata = array();
			}

			switch( $settings['connection']['service'] ) {
				case 'convertkit':
					$convertkit_form = $settings['connection']['convertkit-form'];

					$save_this_mailing_service = \Mediavine\Grow\Connections\ConvertKit::get_instance();

					$subscriber_data = array(
						'email' => sanitize_email( $email_address ),
						'form' => $convertkit_form
					);

					if ( $settings['connection']['convertkit-metadata'] ) {

						$attach_metadata = $save_this_mailing_service->maybe_create_custom_fields();

						if ( $attach_metadata ) {
							$subscriber_data['fields'] = $metadata;
						}
					}

					if ( $name ) {
						$subscriber_data['first_name'] = $name;
					}

					$subscriber_data = apply_filters( 'hubbub_save_this_filter_subscriber_data', $subscriber_data, $post_id, $is_shortcode );

					$save_this_mailing_service->add_subscriber( $subscriber_data );
					
					do_action( 'hubbub_save_this_action_mailing_list_added', $post_id, $is_shortcode );
					do_action( 'hubbub_save_this_action_mailing_list_added_convertkit', $post_id, $is_shortcode );
					break;
				case 'flodesk':
					$flodesk_segment = $settings['connection']['flodesk-segment'];

					$save_this_mailing_service = \Mediavine\Grow\Connections\Flodesk::get_instance();

					$subscriber_data = array(
						'email' => sanitize_email( $email_address ),
						'segment' => $flodesk_segment
					);

					if ( $name ) {
						$subscriber_data['first_name'] = $name;
					}

					$subscriber_data = apply_filters( 'hubbub_save_this_filter_subscriber_data', $subscriber_data, $post_id, $is_shortcode );

					$save_this_mailing_service->add_subscriber( $subscriber_data );	
					do_action( 'hubbub_save_this_action_mailing_list_added', $post_id, $is_shortcode );
					do_action( 'hubbub_save_this_action_mailing_list_added_flodesk', $post_id, $is_shortcode );
					break;
				case 'mailchimp':
					$mailchimp_list = $settings['connection']['mailchimp-list'];

					$save_this_mailing_service = \Mediavine\Grow\Connections\Mailchimp::get_instance();

					$subscriber_data = array(
						'email_address' => sanitize_email( $email_address ),
						'list' => $mailchimp_list,
						'status' => 'subscribed'
					);

					if ( $name ) {
						$subscriber_data['merge_fields']['FNAME'] = $name;
					}

					$subscriber_data = apply_filters( 'hubbub_save_this_filter_subscriber_data', $subscriber_data, $post_id, $is_shortcode );

					$save_this_mailing_service->add_subscriber( $subscriber_data );
					do_action( 'hubbub_save_this_action_mailing_list_added', $post_id, $is_shortcode );
					do_action( 'hubbub_save_this_action_mailing_list_added_mailchimp', $post_id, $is_shortcode );
					break;
				case 'mailerlite':
					$mailerlite_group = $settings['connection']['mailerlite-group'];

					$save_this_mailing_service = \Mediavine\Grow\Connections\MailerLite::get_instance();

					$subscriber_data = array(
						'email' => sanitize_email( $email_address ),
						'groups' => array( $mailerlite_group ),
					);

					if ( $name ) {
						$subscriber_data['fields']['name'] = $name;
					}

					$subscriber_data = apply_filters( 'hubbub_save_this_filter_subscriber_data', $subscriber_data, $post_id, $is_shortcode );

					$save_this_mailing_service->add_subscriber( $subscriber_data );
					do_action( 'hubbub_save_this_action_mailing_list_added', $post_id, $is_shortcode );
					do_action( 'hubbub_save_this_action_mailing_list_added_mailerlite', $post_id, $is_shortcode );
					break;
				case 'mailerlite-classic':
					$mailerlite_classic_group = $settings['connection']['mailerlite-classic-group'];

					$save_this_mailing_service = \Mediavine\Grow\Connections\MailerLiteClassic::get_instance();

					$subscriber_data = array(
						'email' => sanitize_email( $email_address ),
						'group' => $mailerlite_classic_group,
					);
   
					if ( $name ) {
						$subscriber_data['name'] = $name;
					}

					$subscriber_data = apply_filters( 'hubbub_save_this_filter_subscriber_data', $subscriber_data, $post_id, $is_shortcode );
   
					$save_this_mailing_service->add_subscriber( $subscriber_data );
					do_action( 'hubbub_save_this_action_mailing_list_added', $post_id );
					do_action( 'hubbub_save_this_action_mailing_list_added_mailerlite_classic', $post_id );
					break;
				case 'flodesk':
					$flodesk_segment = $settings['connection']['flodesk-segment'];

					$save_this_mailing_service = \Mediavine\Grow\Connections\MailerLiteClassic::get_instance();
					$subscriber_data = array(
						'email' => sanitize_email( $email_address ),
						'group' => $mailerlite_classic_group,
					);

					if ( $name ) {
						$subscriber_data['name'] = $name;
					}

					$subscriber_data = apply_filters( 'hubbub_save_this_filter_subscriber_data', $subscriber_data, $post_id, $is_shortcode );

					$save_this_mailing_service->add_subscriber( $subscriber_data );
					do_action( 'hubbub_save_this_action_mailing_list_added', $post_id, $is_shortcode );
					do_action( 'hubbub_save_this_action_mailing_list_added_mailerlite_classic', $post_id, $is_shortcode );
					break;
				case 'none':
				default:
					// None selected, do nothing.
					break;
			}
		}
	}

	/**
	 * Automations
	 */

	// Zapier
	$zapier = \Mediavine\Grow\Connections\Zapier::get_instance();

	$zapier_payload = array(
		'page_title'	=> $post_title,
		'page_url'		=> $post_url,
		'email_address'	=> $email_address,
	);

	if ( $name ) {
		$zapier_payload['name'] = $name;
	}

	$zapier_payload = apply_filters( 'hubbub_save_this_filter_zapier_data', $zapier_payload, $post_id, $is_shortcode );

	$zapier->call_hook_savethis( $zapier_payload );

	echo ( $sent ? 1 : 0 );
	wp_die();
}

/**
 * AJAX callback for Save This Block and Tool for Email Verification
 * 
 * @return boolean
 */
function dpsp_ajax_verify_save_this_email() {
	$hubbub_save_this_verify_token = filter_input( INPUT_POST, '_ajax_nonce' );

	if ( empty( $hubbub_save_this_verify_token ) || ! wp_verify_nonce( $hubbub_save_this_verify_token, 'hubbub_save_this_verify' ) ) {
		echo 0;
		wp_die();
	}

	$post = stripslashes_deep( $_POST );

	if ( empty( $post['email'] ) ) {
		echo 0;
		wp_die();
	}

	$email      	= $post['email'];
	$siteTitle 		= get_bloginfo( 'name' );
	$siteURL 		= get_bloginfo( 'url' );

	// Determine default email address
	// If email address includes domain name, use it
	// If any other domain, use wordpress@domain.com
	$website_domain = str_replace( 'www.', '', parse_url( get_site_url(), PHP_URL_HOST ));
	$default_email_address = ( strpos( get_option('admin_email'), $website_domain ) === false ) ? 'wordpress@' . $website_domain : get_option('admin_email');

	$emailFromName  = ( ! empty( $settings['email']['fromname'] ) ) ? $settings['email']['fromname'] : esc_html($siteTitle);
	$emailFromEmail = ( ! empty( $settings['email']['fromemail'] ) ) ? $settings['email']['fromemail'] : $default_email_address;

	$headers = [
		'From: ' . $emailFromName . ' <' . $emailFromEmail . '>',
		'Reply-To: ' . $emailFromName . ' <' . $emailFromEmail . '>',
		'Hubbub: Save This verification email',
	];

	$verify_link = admin_url( 'admin.php?page=dpsp-email-save-this&verify=' . rand(1,53453439) );

	$html_template = file_get_contents( __DIR__ . '/tools/email-save-this/email-template.html' );
	$html_template = str_replace( '{{HEADING}}', '', $html_template );
	$html_template = str_replace( '{{POSTTITLELINK}}', '', $html_template );
	$html_template = str_replace( '{{SITELOGO}}', '', $html_template );
	$html_template = str_replace( '{{CUSTOMSECTION1}}', '', $html_template );
	$html_template = str_replace( '{{CUSTOMSECTION2}}', '', $html_template );
	$html_template = str_replace( '{{CUSTOMSECTION3}}', '', $html_template );
	$html_template = str_replace( '{{CUSTOMSECTION4}}', '', $html_template );
	$html_template = str_replace( '{{BOTTOMCONTENT}}', '', $html_template );
	$html_template = str_replace( '000LINKCOLOR000;', '#003ffe', $html_template );
	$html_template = str_replace( '{{FEATUREDIMAGE}}', '', $html_template );

	$html_template = str_replace( '{{EMAILMESSAGE}}', '<div align="center"><h3>Hubbub Save This Confirmation</h3><strong>Success! 🎉<br/>Sending email works from<br/>your website.</strong><br/>Please click the button below to confirm and proceeed to setup.<br /><br/></div>', $html_template );
	$html_template = str_replace( '{{URL}}', $verify_link, $html_template );
	$html_template = str_replace( '{{RAWURL}}', $verify_link, $html_template );
	$html_template = str_replace( '{{SITETITLE}}', esc_html($siteTitle), $html_template );
	$html_template = str_replace( '{{VERIFYBUTTON}}', '<p><a href="' . $verify_link . '" style="padding: 10px 15px;display: inline-block;border-radius: 5px;background: #363535;color: #ffffff;"class="btn btn-primary">Confirm Receipt</a></p>', $html_template );
	
	$html_template = str_replace( '{{SITEURL}}', esc_url($siteURL), $html_template );
	$html_template = str_replace( '{{footerTITLE}}', esc_html($siteTitle), $html_template );

	add_filter( 'wp_mail_content_type', 'dpsp_set_html_mail_content_type' ); // Allows HTML email for wp_mail
	
	$sent = wp_mail( 
		sanitize_email( $email ),
		'Hubbub Pro+: Email Sending Verification',
		$html_template,
		$headers
	);

	remove_filter( 'wp_mail_content_type', 'dpsp_set_html_mail_content_type' ); // Resets wp_mail content type default to text
	
	echo ( $sent ? 1 : 0 );
	wp_die();
}

function dpsp_set_html_mail_content_type() {
	return 'text/html';
}