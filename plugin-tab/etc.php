<?php


defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


if ( ! function_exists ( 'oxsn_featured_video_plugin_nav_item' ) ) {

	add_action('admin_menu', 'oxsn_featured_video_plugin_nav_item', 99);
	function oxsn_featured_video_plugin_nav_item() {

		add_submenu_page('oxsn-dashboard', 'OXSN Featured Video', 'Featured Video', 'manage_options', 'oxsn-featured-video', 'oxsn_featured_video_plugin');

	}

}

if ( !function_exists('oxsn_featured_video_plugin') ) {

	function oxsn_featured_video_plugin() {

		if (!current_user_can('manage_options')) {

			wp_die( __('You do not have sufficient permissions to access this page.') );

		}

	?>

		<?php if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y') : ?>

			<div id="message" class="updated">

				<p><strong><?php _e('Settings saved.') ?></strong></p>

			</div>

		<?php endif; ?>
		
		<div class="wrap oxsn_settings_page">
		
			<h2>OXSN Featured Video Plugin</h2>

			<div id="poststuff">

				<div class="oxsn_xs_float_left oxsn_xs_width_100pr">

					<div class="oxsn_xs_float_left oxsn_xs_width_100pr oxsn_sm_width_60pr oxsn_xs_padding_right_0px oxsn_sm_padding_right_10px">

						<div class="postbox">

							<h3 class="hndle cursor_initial">Information</h3>

							<div class="inside">

								<p></p>

							</div>
							
						</div>

					</div>

					<div class="oxsn_xs_float_left oxsn_xs_width_100pr oxsn_sm_width_40pr oxsn_xs_padding_left_0px oxsn_sm_padding_left_10px">

						<div class="postbox">

							<h3 class="hndle cursor_initial">Custom Project</h3>

							<div class="inside">

								<p>Want us to build you a custom project?</p>

								<p><a href="mailto:brief@oxsn.com?Subject=Custom%20Project%20Request%21&Body=Please%20answer%20the%20following%20questions%20to%20help%20us%20better%20understand%20your%20needs..%0A%0A1.%20What%20is%20the%20name%20of%20your%20company%3F%0A%0A2.%20What%20are%20the%20concepts%20and%20goals%20of%20your%20project%3F%0A%0A3.%20What%20is%20the%20proposed%20budget%20of%20this%20project%3F" class="button button-primary button-large">Email Us</a></p>

							</div>
							
						</div>

						<div class="postbox">

							<h3 class="hndle cursor_initial">Support</h3>

							<div class="inside">

								<p>Need help with this plugin? Visit the Wordpress plugin page for support..</p>

								<p><a href="https://wordpress.org/support/plugin/oxsn-featured-video" target="_blank" class="button button-primary button-large">Support</a></p>

							</div>
							
						</div>

					</div>

				</div>

			</div>

		</div>

	<?php 

	}

}


?>