<?php

// Check that the save this form has been added only once
global $dpsp_output_front_end_email_save_this;

use Mediavine\Grow\Tools\Email_Save_This;
use Mediavine\Grow\View_Loader;

/**
 * Displays the save this form
 */
function dpsp_output_front_end_email_save_this( $content ) {
    global $post;
	// Only run if 
    // - save this is active
    // - is not hidden on post edit screen
    // - is not admin
    // - is not a feed
    // - is doing a filter of the_content
    // - is singular
	if ( is_admin() || ! doing_filter( 'the_content' ) || ! is_singular() || is_feed() || ! is_main_query() || ! in_the_loop() ) {
		return $content;
	}

    if ( ! dpsp_is_tool_active( 'email_save_this' ) ) {
        return $content;
    }

    if ( ! dpsp_is_location_displayable( 'email_save_this' ) ) {
        return $content;
    }
    
    if ( doing_action( 'before_feast_layout' ) || doing_action( 'genesis_header' ) || doing_action( 'genesis_after_header' ) || doing_action( 'genesis_footer' ) || doing_action( 'genesis_sidebar' ) || doing_action( 'kadence_before_sidebar' ) || doing_action( 'kadence_before_footer' ) || doing_action('kadence_dynamic_sidebar_content') || doing_action('kadence_after_header') ) {
        return $content;
    }

    // If a password is required, or, the user hasn't supplied the correct password
    // https://github.com/nerdpressteam/grow-social/issues/1694
    if ( post_password_required( $post ) ) {
        return $content;
    }

    // Save This is only embedded if
    // Pro+ or Priority tier license key
    // License status is not invalid or disabled and is active on this domain
    $hubbub_activation = new \Mediavine\Grow\Activation;
	$license_tier = $hubbub_activation->get_license_tier();
    
    if ( !$license_tier || $license_tier == 'pro' ) { // Pro
        return $content;
    } else { // Pro+ or Priority
        $license_status = get_option( 'mv_grow_license_status' );

        if ( empty( $license_status ) || $license_status != 'valid' && $license_status != 'expired' ) {
            return $content;
        }
    }

    // If shortcode(s) are present 
    // and none of them contain allow_injection="yes", discontinue
    if ( dpsp_has_save_this_shortcode() ) {
        if ( strpos( $content, 'allow_injection="yes"' ) === false ) {
            return $content;
        }
    }

    $tool_container = \Mediavine\Grow\Tools\Toolkit::get_instance();
    $tool_instance  = $tool_container->get( 'email_save_this' );
    if ( $tool_instance->has_rendered() ) {
        error_log( 'Hubbub info: Save This had already rendered elsewhere.' );
        return  $content;
    }
    $tool_instance->render();

    $settings               = \Mediavine\Grow\Tools\Email_Save_This::get_prepared_settings();

    $email_save_this_form   = dpsp_email_save_this_get_form();

    switch( $settings['display']['position'] ) {
        case 'top':
            $newcontent = $email_save_this_form . $content;
            break;
        case 'after-first-image': // Find the first image, insert the form after it
        case 'after-first-image-middle':

            $all_blocks = array_values( array_filter( parse_blocks( $post->post_content ), function( $item ) { return ( empty( $item['blockName'] ) ) ? false : true; } ) ) ;
     
            $number_of_blocks   = count( $all_blocks );
            
            if ( $number_of_blocks > 1 ) { // Block editor
            
                $is_wp_gallery      = false;
                $is_kadence_gallery = false;
                $is_first_image_a_gallery = false;
				$is_ultimate_addons_image_block = false;
                
                $array_of_images    = explode( '</figure>', $content );

                if ( is_array( $array_of_images ) && count( $array_of_images ) > 1 ) {

                    // Determine if first image is a gallery, if it is, insert Save This after the first gallery
                    $check_for_galleries = array_map( function( $item, $index ) { 
                        if ( $index == 0 && strpos( $item, 'wp-block-gallery' ) !== false ) {
                            return array( true, 'wp' );
                        }
                        if ( $index == 0 && strpos( $item, 'wp-block-kadence-advancedgallery' ) !== false ) {
                            return array( true, 'kadence');
                        }

						if ( $index == 0 && strpos( $item, 'uagb-image' ) !== false ) {
							return array( true, 'ultimate-addons-image-block' );
						}
                        if ( $index > 0 && ( empty( $item ) || $item == "\n" || strpos( $item, '</ul>' ) > 0 ) ) return 'end-of-gallery';
                    }, $array_of_images, array_keys( $array_of_images ) );

                    if ( is_array( $check_for_galleries[0] ) ) {
                        $is_first_image_a_gallery               = ( $check_for_galleries[0][0] ) ? true : false;
                        $is_wp_gallery                          = ( $check_for_galleries[0][1] == 'wp' ) ? true : false;
                        $is_kadence_gallery                     = ( $check_for_galleries[0][1] == 'kadence' ) ? true : false;
						$is_ultimate_addons_image_block = ( $check_for_galleries[0][1] == 'ultimate-addons-image-block' ) ? true : false;
                    } else {
                        $is_first_image_a_gallery               = false;
                    }

                    if ( $is_first_image_a_gallery ) {

                        if ( $is_wp_gallery ) {
                        
                            $insert_after = 0;
                            foreach( $check_for_galleries as $index=>$item ) {
                                if ( $item == 'end-of-gallery' && $insert_after == 0 ) {
                                    $insert_after = $index;
                                }
                            }

                            array_splice( $array_of_images, $insert_after, 0, $email_save_this_form );
                            $newcontent = implode( '</figure>', $array_of_images );

                        } elseif ( $is_kadence_gallery ) {

                            // Resplit since Kadence uses ULs
                            $array_of_images    = explode( '</ul>', $content );
                            // Insert after the first </ul> but keep the wrapping </div> intact
                            $array_of_images[1] = substr_replace( $array_of_images[1], '</div>' . $email_save_this_form, 0, 6 );
                            $newcontent = implode( '</ul>', $array_of_images );
                        }

						elseif ( $is_ultimate_addons_image_block ) {
							foreach ( $check_for_galleries as $index => $item ) {
								if ( $item[1] == 'ultimate-addons-image-block' ) {
									// Remove the closing div from the next array of images
                                    // Add the closing div and then the form to the current array of images.
									$array_of_images[ $index + 1 ] = substr_replace($array_of_images[ $index + 1 ], '', 0, 6);
									$array_of_images[ $index ]    .= '</div>' . $email_save_this_form;
									$newcontent                    = implode('</figure>', $array_of_images);
								}
							}
						}

                        break;
                    
                    }

                    // No longer dealing with a gallery

                    if ( !$is_first_image_a_gallery && ( is_array( $array_of_images ) || count( $array_of_images ) > 1 ) ) {
                        
                        array_splice( $array_of_images, 1, 0, $email_save_this_form );
                        
                        $newcontent = implode( '</figure>', $array_of_images );
                        
                        break;
                        
                    } else { // If no images

                        if ( $settings['display']['position'] == 'after-first-image' ) { // bottom of the post
                            
                            $newcontent = $content . $email_save_this_form;
                        
                        } else { // Or, middle

                            $newcontent = dpsp_email_save_this_helper_add_to_middle( $content, $email_save_this_form );
                            
                            // Adds the form in the "middle" based on the mumber
                            // of paragraphs found in the_content
                            // array_splice( $array_of_paragraphs, $middle_paragraph, 1, $email_save_this_form );
                            // $newcontent = implode( '</p>', $array_of_paragraphs );
                        }

                        break;
                    }
                
                } else { // Block editor, no images
                    if ( $settings['display']['position'] == 'after-first-image' ) {
                        $newcontent = $content . $email_save_this_form;
                    } else { // Or, middle
                        $newcontent = dpsp_email_save_this_helper_add_to_middle( $content, $email_save_this_form );
                    }
                }
            } elseif ( $number_of_blocks == 1 ) { // Only one block, put it on the bottom
                $newcontent = $content . $email_save_this_form;
            } else { // Maybe Classic Post
                
                if ( strpos( $content, '</p>' ) === false && ( function_exists( '\Feast\Layouts\feast_layout_exists' ) || function_exists('genesis') ) ) { // Feast or Genesis
                    $content = wpautop( $content );
                }
                
                preg_match_all( "#<img(.*?)\\/?>#", $content, $images );
                
                if ( !empty( $images ) && count($images[0]) > 0 ) {
                    $first_image = $images[0][0];
                    $replace_again = true;

                    if ( strpos( $content, $first_image . '</p>' ) !== false ) {
                        // Could be an unwrapped content from the classic post editor
                        
                        // Wrapped in a link?
                        if ( strpos( $content, $first_image . '</a>' ) !== false ) {
                            
                            $newcontent = str_replace( $first_image . '</a>', $first_image . '</a>' . $email_save_this_form, $content ); // If img is just wrapped in a P    
                            $replace_again = false;
                        }

                        // If not, image only
                        if ( $replace_again ) {
                            
                            $newcontent = str_replace( $first_image, $first_image . $email_save_this_form, $content ); // If img is just wrapped in a P
                            $replace_again = false;
                        }
                    }

                    if ( $replace_again ) { // Classic Post but has been wrapped with autop, maybe?
                        
                        $newcontent = str_replace( $first_image . '</p>', $first_image . '</p>' . $email_save_this_form, $content ); // If img is just wrapped in a P
                        $newcontent = str_replace( $first_image . '</a></p>', $first_image . '</a></p>' . $email_save_this_form, $content ); // If img is wrapped in A and P

                        $replace_again = false;
                    }

                    if ( $replace_again ) { // This is if all other conditions were not met (Still likely a classic post)
                        $newcontent = $content . '<!-- Conditions not met -->' . $email_save_this_form;
                    }

                    break;
                } else { // No images
                    if ( $settings['display']['position'] == 'after-first-image' ) {
                        $newcontent = $content . $email_save_this_form;
                    } else { // Or, middle
                        $newcontent = dpsp_email_save_this_helper_add_to_middle( $content, $email_save_this_form );
                    }
                }
            }

            break;
        case 'middle': // Find the middle paragraph, inserts the form after it.

            
            $newcontent = dpsp_email_save_this_helper_add_to_middle( $content, $email_save_this_form );

            // Adds the form in the "middle" based on the mumber
            // of paragraphs found in the_content
            // array_splice( $array_of_paragraphs, $middle_paragraph, 1, $email_save_this_form );
            // $newcontent = implode( '</p>', $array_of_paragraphs );

            break;
        case 'bottom':
        default:
            $newcontent = $content . $email_save_this_form;
            break;
    }
    
    
    return $newcontent;
}

/**
 * Finds all the occurences of a string
 * @return array, empty array
 */
function dpsp_strpos_all($haystack, $needle) {
    $offset = 0;
    $allpos = array();
    if ( strlen( $needle ) < 1 ) return $allpos;
    while ( ($pos = strpos($haystack, $needle, $offset)) !== FALSE ) {
        $offset   = $pos + 1;
        $allpos[] = $pos;
    }
    return $allpos;
}

/**
 * Adds hubbub_save_this_debug as an available querystring variable
 */
function dpsp_add_query_vars_email_save_this( $vars ){
    $vars[] = "hubbub_save_this_debug";
    return $vars;
}

/**
 * 
 * Runs all Core filters for the_content without any third-party code
 * 
 */
function dpsp_filter_the_content_email_save_this( $content ) {
    // Default Core filters for the_content as of WP 6.5.5 / 06/25/2024
    //$filtered_content = apply_filters( 'do_blocks', $content );
    $filtered_content = apply_filters( 'wptexturize', $content );
    $filtered_content = apply_filters( 'convert_smilies', $filtered_content );
    $filtered_content = apply_filters( 'wpautop', $filtered_content );
    $filtered_content = apply_filters( 'shortcode_unautop', $filtered_content );
    $filtered_content = apply_filters( 'prepend_attachment', $filtered_content );
    $filtered_content = apply_filters( 'wp_replace_insecure_home_url', $filtered_content );
    $filtered_content = apply_filters( 'do_shortcode', $filtered_content );
    $filtered_content = apply_filters( 'wp_filter_content_tags', $filtered_content );
    return $filtered_content;
}

/**
 * 
 * Determines if the current posts content includes the Save This shortcode
 * @return boolean
 */
function dpsp_has_save_this_shortcode() {
    global $post;
    return ( strpos( $post->post_content, '[hubbub_save_this' ) !== FALSE ) ? true : false;
}

/**
 * 
 * Builds the Save This form into a variable
 * @return string html
 */
function dpsp_email_save_this_get_form( $attrs = [] ) {

    if ( ! dpsp_is_tool_active( 'email_save_this' ) ) {
        return '';
    }
    
    global $post;

    // // Get saved settings
	$settings                   = \Mediavine\Grow\Tools\Email_Save_This::get_prepared_settings();
    $connection                 = $settings['connection'];
    $display                    = $settings['display'];
    $is_shortcode               = false;

    // Find all images in the message and disable Image Hover
    $pattern_find_images        = '/<img([^>]*)(?<!data-pin-nopin)>/i';
    $replacement_find_images    = '<img$1 data-pin-nopin="true">';
    $display['message']         = preg_replace( $pattern_find_images, $replacement_find_images, $display['message'] );

    if ( ! empty( $attrs ) ) {
        $is_shortcode = true;
        $display = array_merge( $display, $attrs );
    }

    $customCSS              = ( ! empty($display['custom_css']) ) ? '<style type="text/css">' . strip_tags( $display['custom_css'] ) . '</style>' : '';
    
    $postURL 		        = get_the_permalink( $post->ID );
    $postTitle 		        = get_the_title( $post->ID );

    $email_save_this_form = "\n" . $customCSS . '
    <div class="dpsp-email-save-this-tool ' . ( ( $is_shortcode ) ? 'dpsp-email-save-this-shortcode' : '' ) . '" ' . ( ( !empty($display['custom_background_color']) ) ? 'style="background-color: ' . esc_attr( $display['custom_background_color'] . ';' ) : '' ) . '">
        <div class="hubbub-save-this-form-wrapper">
            <h3 class="hubbub-save-this-heading">' . esc_html( $display['heading'] ) . '</h3>
            <div class="hubbub-save-this-message">' . wp_kses_post( wpautop( $display['message'] ) ) . '</div>
            <div class="hubbub-save-this-form-only-wrapper">
                <form name="hubbub-save-this-form" method="post" action="">
                    <input type="text" name="hubbub-save-this-snare" class="hubbub-save-this-snare hubbub-block-save-this-snare" />';
                    
                    if ( isset( $display['name_field'] ) && $display['name_field'] == 'yes' ) {
                        $email_save_this_form .= '<p class="hubbub-save-this-name-paragraph-wrapper"><input aria-label="First Name" type="text" placeholder="First Name" name="hubbub-save-this-name" value="' . ( isset( $_COOKIE["hubbub-save-this-name"] ) ? $_COOKIE["hubbub-save-this-name"] : '' ) . '" class="hubbub-block-save-this-text-control hubbub-save-this-name" required /></p>';
                    }

                    $email_save_this_form .= '<p class="hubbub-save-this-emailaddress-paragraph-wrapper"><input aria-label="Email Address" type="email" placeholder="Email Address" name="hubbub-save-this-emailaddress" value="' . (isset($_COOKIE["hubbub-save-this-email-address"]) ? $_COOKIE["hubbub-save-this-email-address"] : '') . '" class="hubbub-block-save-this-text-control hubbub-save-this-emailaddress" required /></p>';
                    
                    if ( isset( $display['consent'] ) && $display['consent'] != '' ) {
                        $email_save_this_form .= '<p class="hubbub-save-this-consent-paragraph-wrapper"><input type="checkbox" name="hubbub-save-this-consent" class="hubbub-save-this-consent" value="1" required /> <label for="hubbub-save-this-consent">' . $display['consent_text'] . '</label></p>';
                    }

                    $email_save_this_form .= '<p class="hubbub-save-this-submit-button-paragraph-wrapper"><input type="submit" style="' . ( ( !empty($display['custom_button_color']) ) ? 'background-color:' . esc_attr( $display['custom_button_color'] ) . ';' : '' ) . ( ( !empty($display['custom_button_text_color']) ) ? 'color:' . esc_attr( $display['custom_button_text_color'] ) . ';' : '' ) . '" value="' . ( $display['button_text'] != '' ? esc_attr( $display['button_text'] ) : __( 'Save This', 'social-pug' ) ) . '" class="hubbub-block-save-this-submit-button" name="hubbub-block-save-this-submit-button" /></p>
                    <input type="hidden" name="hubbub-save-this-postid" class="hubbub-save-this-postid" value="' . esc_attr( $post->ID ) . '" />
                    <input type="hidden" name="hubbub-save-this-posturl" class="hubbub-save-this-posturl" value="' . esc_attr( $postURL ) . '" />
                    <input type="hidden" name="hubbub-save-this-posttitle" class="hubbub-save-this-posttitle" value="' . esc_attr( $postTitle ) . '" />';
                    $email_save_this_form .= ( ( $is_shortcode ) ? '<input type="hidden" name="hubbub-save-this-is-shortcode" class="hubbub-save-this-is-shortcode" value="true" />' : '' );
                $email_save_this_form .= '</form>
            </div>';
            if ( ! empty( $display['after_form'] ) ) {
                $email_save_this_form .= '<div class="hubbub-save-this-afterform">
                    <p class="hubbub-save-this-afterform-paragraph-wrapper">' . esc_html( $display['after_form'] ) . '</p>
                </div>';
            }
        $email_save_this_form .= '</div>
    </div>'."\n";

    return str_replace( array( "\r", "\n" ), '', $email_save_this_form );
}

/**
 * 
 * Injects Save This form (or any HTML) into the "middle" of a post
 * @return string
 * 
 */
function dpsp_email_save_this_helper_add_to_middle( $rendered_post_content, $html ) {
    global $post;

    $inj_debug = ( get_query_var( 'hubbub_save_this_debug' ) ) ? true : false;
    $inj_debug_info = '<ul>';
    $inj_debug_blocks_searched_for = array();

    $all_blocks = array_values( array_filter( parse_blocks( $post->post_content ), function( $item ) { return ( empty( $item['blockName'] ) ) ? false : true; } ) ) ;
     
    $number_of_blocks   = count( $all_blocks );

    if ( $number_of_blocks > 0 ) { // Block editor post

        if ( $number_of_blocks == 1 ) { // Single block, insert into bottom
            $newcontent = $rendered_post_content . $html;
        } else {
            $middle_block       = ( round( $number_of_blocks/2, 0, PHP_ROUND_HALF_DOWN ) < 2 ) ? 1 : round( $number_of_blocks/2, 0, PHP_ROUND_HALF_DOWN );
            $middle_block--;    // Rather than proceeding the middle block, we'll insert before it, to appear as though it is in the middle 

            $inj_debug_info .= '<li>Number of blocks: ' . $number_of_blocks . ' Middle block assumed: ' . $middle_block . '</li>';

            $pos = array();
            $inj_debug_did_loop = false; // If finding the middle block fails the first time (used for debugging only)

            while ( count($pos) == 0 && $middle_block < $number_of_blocks ) { // If middle block is not found in the rendered content, continue to move block by block until one is found

                if ( $inj_debug_did_loop ) $inj_debug_info .= '<li>Middle block not found in rendered HTML</li>';

                $inj_debug_info .= '<li>Looking for: ' . $all_blocks[ $middle_block ]['blockName'] . '</li>';

                if ( $all_blocks[ $middle_block ]['blockName'] == 'core/heading' ) {
                    $middle_block++; // If the middle block is a heading, add 1
                    $inj_debug_info .= '<li>Heading targetted, middle block moving to next block</li>';
                    $inj_debug_info .= '<li>Looking for: ' . $all_blocks[ $middle_block ]['blockName'] . '</li>';
                }

                $middle_block_rendered = apply_filters( 'hubbub_save_this_the_content', render_block( $all_blocks[ $middle_block ] ) );
                $pos = dpsp_strpos_all($rendered_post_content, $middle_block_rendered);

                if ( ! empty($pos) && count($pos) > 0 ) {
                    $inj_debug_info .= '<li>Middle block found in content</li>';
                } else {
                    $inj_debug_info .= '<li>Middle block not found in content</li>';

                    $inj_debug_blocks_searched_for[] = $middle_block_rendered;
                }

                $middle_block++;
                $inj_debug_did_loop = true;
            }

            if ( $inj_debug ) { // Used for debugging purposes, append ?hubbub_save_this_debug=anything
                print "\n\n" . '<h2>Position point(s):</h2>' . "\n";
                var_dump( $pos );

                print "\n\n" . '<h2>Injection notes:</h2>' . "\n";
                print $inj_debug_info . '</ul>';

                if ( count( $inj_debug_blocks_searched_for ) > 0 ) {
                    print "\n\n" . '<h2>Middle blocks searched for:</h2>' . "\n";
                    foreach( $inj_debug_blocks_searched_for as $searched_block ) {
                        print "\n\n" . '<!-- BEGIN SEARCHED FOR BLOCK -->' . "\n";
                        var_dump( $searched_block );
                        print "\n\n" . '<!-- END SEARCHED FOR BLOCK -->' . "\n";
                        print "\n\n";
                    }
                }

                if ( count( $inj_debug_blocks_searched_for ) == 0 ) {
                    print "\n\n" . '<h2>Middle block HTML:</h2>' . "\n";
                    print "\n\n" . '<!-- BEGIN MIDDLE BLOCK -->' . "\n";
                    var_dump( $middle_block_rendered );
                    print "\n\n" . '<!-- END MIDDLE BLOCK -->' . "\n";
                }
                
                print "\n\n" . '<h2>Post content HTML string:</h2>';

                var_dump( $rendered_post_content );

                exit;
            }

            if (! empty($pos) && count($pos) > 0 ) {
                $pos_count = count($pos);
                $middle_block_pos_index = (int) ($pos_count / 2);                
                $newcontent = substr_replace($rendered_post_content, $middle_block_rendered . $html, $pos[$middle_block_pos_index], strlen($middle_block_rendered));
            } else {
                $newcontent = $rendered_post_content . '<!-- Conditions not met -->' . $html;
            }
        }

    } else { // Likely a classic post

        if ( strpos( $rendered_post_content, '</p>' ) === false && ( function_exists( '\Feast\Layouts\feast_layout_exists' ) || function_exists('genesis') ) ) { // Feast or Genesis
            $rendered_post_content = wpautop( $rendered_post_content );
        }
        
        $array_of_paragraphs    = explode( '</p>', $rendered_post_content );
        
        if ( count ( $array_of_paragraphs ) < 1 ) {
            $array_of_paragraphs = explode( "\n", $rendered_post_content ); // Classic editor, with no autop!
        }

        if ( empty( $array_of_paragraphs ) || count( $array_of_paragraphs ) < 2 ) { // No blocks or a single block
            $newcontent = $rendered_post_content . $html;
        } else {

            $number_of_paragraphs   = count( $array_of_paragraphs );
            $middle_paragraph       = ( round( $number_of_paragraphs/2, 0, PHP_ROUND_HALF_DOWN ) < 2 ) ? 1 : round( $number_of_paragraphs/2, 0, PHP_ROUND_HALF_DOWN );
            array_splice( $array_of_paragraphs, $middle_paragraph, 1, $html . $array_of_paragraphs[ $middle_paragraph ] );
            $newcontent = implode( '</p>', $array_of_paragraphs );
        } 
        
    }

    return $newcontent;
}
