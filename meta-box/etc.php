<?php


defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


class oxsn_featured_video_custom_fields {

	public function __construct() {

		if ( is_admin() ) {
			add_action( 'load-post.php',     array( $this, 'init_metabox' ) );
			add_action( 'load-post-new.php', array( $this, 'init_metabox' ) );
		}

	}

	public function init_metabox() {

		add_action( 'add_meta_boxes', array( $this, 'add_metabox'  )        );
		add_action( 'save_post',      array( $this, 'save_metabox' ), 10, 2 );

	}

	public function add_metabox() {

		$post_types = get_post_types();

		foreach ( $post_types as $post_type ) {

			add_meta_box(
				'oxsn_featured_video_options',
				__( 'OXSN Featured Video', 'text_domain' ),
				array( $this, 'render_metabox' ),
				'',
				'normal',
				'default'
			);

		}

	}

	public function render_metabox( $post ) {

		// Add nonce for security and authentication.
		wp_nonce_field( 'oxsn_featured_video_nonce_action', 'oxsn_featured_video_nonce' );

		// Retrieve an existing value from the database.
		$oxsn_featured_video_url = get_post_meta( $post->ID, 'oxsn_featured_video_url', true );

		// Set default values.
		if( empty( $oxsn_featured_video_url ) ) $oxsn_featured_video_url = '';

		// Form fields.
		echo '<table class="form-table">';

		echo '	<tr>';
		echo '		<th><label for="oxsn_featured_video_url" class="oxsn_featured_video_url_label">' . __( 'URL', 'text_domain' ) . '</label></th>';
		echo '		<td>';
		echo '			<input type="text" id="oxsn_featured_video_url" name="oxsn_featured_video_url" class="oxsn_featured_video_url_field oxsn_xs_width_100pr" placeholder="' . esc_attr__( '', 'text_domain' ) . '" value="' . esc_attr( $oxsn_featured_video_url ) . '">';
		echo '			<p class="description">' . __( 'Place the URL for your video here.', 'text_domain' ) . '</p>';
		echo '		</td>';
		echo '	</tr>';

		echo '</table>';

	}

	public function save_metabox( $post_id, $post ) {

		// Add nonce for security and authentication.
		$nonce_name   = isset( $_POST['oxsn_featured_video_nonce'] ) ? $_POST['oxsn_featured_video_nonce'] : '';
		$nonce_action = 'oxsn_featured_video_nonce_action';

		// Check if a nonce is set.
		if ( ! isset( $nonce_name ) )
			return;

		// Check if a nonce is valid.
		if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) )
			return;

		// Sanitize user input.
		$oxsn_featured_video_url_new = isset( $_POST[ 'oxsn_featured_video_url' ] ) ? sanitize_text_field( $_POST[ 'oxsn_featured_video_url' ] ) : '';

		// Update the meta field in the database.
		update_post_meta( $post_id, 'oxsn_featured_video_url', $oxsn_featured_video_url_new );

	}

}

new oxsn_featured_video_custom_fields;


?>