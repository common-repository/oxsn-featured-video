<?php


defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


if ( ! function_exists ( 'oxsn_dashboard_css_inc' ) ) {

	add_action( 'admin_enqueue_scripts', 'oxsn_dashboard_css_inc' );
	function oxsn_dashboard_css_inc() {

		wp_enqueue_style( 'oxsn_dashboard_admin_css', oxsn_featured_video_plugin_dir_url . '/main-tab/css/admin.css', array(), '1.0.0', 'all' ); 

	}

}

if ( !function_exists('oxsn_dashboard_nav_item') ) {

	add_action('admin_menu', 'oxsn_dashboard_nav_item');
	function oxsn_dashboard_nav_item() {

		add_menu_page('OXSN', 'OXSN', 'manage_options', 'oxsn-dashboard', 'oxsn_dashboard' );

	}

}

if ( !function_exists('oxsn_dashboard') ) {

	function oxsn_dashboard() {

		if (!current_user_can('manage_options')) {

			wp_die( __('You do not have sufficient permissions to access this page.') );

		}

	?>

		<?php if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y') : ?>

			<div id="message" class="updated">

				<p><strong><?php _e('Settings saved.') ?></strong></p>

			</div>

		<?php endif; ?>
		
		<div class="wrap">
		
			<h2>OXSN Themes & Plugins</h2>

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

							<h3 class="hndle cursor_initial">Coming Soon</h3>

							<div class="inside">

								<p></p>

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