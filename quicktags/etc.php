<?php


defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


if ( ! function_exists ( 'oxsn_featured_video_quicktags' ) ) {

	add_action( 'admin_print_footer_scripts', 'oxsn_featured_video_quicktags' );
	function oxsn_featured_video_quicktags() {

		if ( wp_script_is( 'quicktags' ) ) {

		?>

			<script type="text/javascript">
				QTags.addButton( 'oxsn_featured_video_quicktag', '[oxsn_featured_video]', '[oxsn_featured_video page_id="" class=""]', '[/oxsn_featured_video]', 'oxsn_featured_video', 'Featured Video', 201 );
			</script>

		<?php

		}

	}

}


?>