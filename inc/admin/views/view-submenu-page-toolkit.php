<div class="dpsp-page-wrapper dpsp-page-toolkit wrap <?php echo Social_Pug::is_free() ? 'dpsp-page-free' : 'dpsp-page-pro'; ?>">

	<?php wp_nonce_field( 'dpsptkn', 'dpsptkn' ); ?>

	<!-- Share Tools -->
	<h1 class="dpsp-page-title"><?php esc_html_e( 'Social Share Tools', 'social-pug' ); ?></h1>

	<div class="dpsp-row dpsp-m-padding">
	<?php
		$tools = dpsp_get_tools( 'share_tool' );

		foreach ( $tools as $tool_slug => $tool ) {
			dpsp_output_tool_box( $tool_slug, $tool );
		}
	?>
	</div><!-- End of Share Tools -->

	<?php do_action( 'dpsp_page_toolkit_after_share_tools' ); ?>

	<!-- Email Tools -->
	<?php $tools = dpsp_get_tools( 'email_tool' ); ?>
	<?php if ( count( $tools ) ) : ?>
	<h1 class="dpsp-page-title"><?php esc_html_e( 'Email Tools', 'social-pug' ); ?></h1>

	<div class="dpsp-row dpsp-m-padding">
	<?php
		foreach ( $tools as $tool_slug => $tool ) {
			dpsp_output_tool_box( $tool_slug, $tool );
		}
	?>
	</div><?php endif; ?><!-- End of Email Tools -->

	<?php do_action( 'dpsp_page_toolkit_after_email_tools' ); ?>

	<!-- Follow Tools -->
	<?php $tools = dpsp_get_tools( 'follow_tool' ); ?>
	<?php if ( count( $tools ) ) : ?>
	<h1 class="dpsp-page-title"><?php esc_html_e( 'Social Follow Tools', 'social-pug' ); ?></h1>
	<div class="dpsp-row dpsp-m-padding">
	<?php
		foreach ( $tools as $tool_slug => $tool ) {
			dpsp_output_tool_box( $tool_slug, $tool );
		}
	?>
	</div><?php endif; ?><!-- End of Follow Tools -->

	<?php do_action( 'dpsp_page_toolkit_after_follow_tools' ); ?>

	<!-- Misc Tools -->
	<?php $tools = dpsp_get_tools( 'misc_tool' ); ?>
	<?php if ( count( $tools ) ) : ?>
	<h1 class="dpsp-page-title"><?php esc_html_e( 'Misc Tools', 'social-pug' ); ?></h1>

	<div class="dpsp-row dpsp-m-padding">
	<?php
		foreach ( $tools as $tool_slug => $tool ) {
			dpsp_output_tool_box( $tool_slug, $tool );
		}
	?>
	</div><?php endif; ?><!-- End of Misc Tools -->

	<?php do_action( 'dpsp_page_toolkit_after_misc_tools' ); ?>

	<p>Made with ❤️ and ☕ by <a href="https://www.nerdpress.net/" title="NerdPress - WordPress support that feels like family">NerdPress</a>.</p>
	<p>⭐ Love Hubbub? Please <a href="https://wordpress.org/support/plugin/social-pug/reviews/?filter=5#new-post" title="Rate Hubbub on WordPress.org">rate Hubbub 5-stars on WordPress.org</a>. Thank you!</p>
</div>

<?php do_action( 'dpsp_submenu_page_bottom' ); ?>

