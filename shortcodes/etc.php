<?php


defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


//[oxsn_featured_video page_id="" class=""]
if ( ! function_exists ( 'oxsn_featured_video_shortcode' ) ) {

	add_shortcode('oxsn_featured_video', 'oxsn_featured_video_shortcode');
	function oxsn_featured_video_shortcode( $atts, $content = null ) {
		$content = shortcode_unautop(trim($content));
		$a = shortcode_atts( array(
			'class' => '',
			'page_id' => '',
		), $atts );

		$oxsn_featured_video_class = esc_attr($a['class']);

		$oxsn_featured_video_page_id = esc_attr($a['page_id']);

		if ($oxsn_featured_video_page_id != "") :

			$ID = $oxsn_featured_video_page_id;

		else :

			$ID = get_the_id();

		endif;

		$oxsn_featured_video_url = get_post_meta( $ID, 'oxsn_featured_video_url', true );
		$oxsn_featured_video_parent_id = array_pop(get_post_ancestors($ID));
		$oxsn_featured_video_parent_url = get_post_meta( $oxsn_featured_video_parent_id, 'oxsn_featured_video_url', true );

		$oxsn_featured_video_default_url = esc_url( get_theme_mod( 'oxsn_featured_video_default_control' ) );
		$oxsn_featured_video_blog_url = esc_url( get_theme_mod( 'oxsn_featured_video_blog_control' ) );
		$oxsn_featured_video_search_url = esc_url( get_theme_mod( 'oxsn_featured_video_search_control' ) );
		$oxsn_featured_video_error_url = esc_url( get_theme_mod( 'oxsn_featured_video_error_control' ) );

		if ( !empty($oxsn_featured_video_url) ) :

			if (strpos($oxsn_featured_video_url, '.mp4') > 0 || strpos($oxsn_featured_video_url, '.webm') > 0 || strpos($oxsn_featured_video_url, '.ogv') > 0 || strpos($oxsn_featured_video_url, '.ogg') > 0) :

				if (strpos($oxsn_featured_video_url, '.mp4') > 0) :

					$oxsn_featured_video_url_mp4 = '<source src="' . $oxsn_featured_video_url . '" type="video/mp4">';

				elseif (strpos($oxsn_featured_video_url, '.webm') > 0) :

					$oxsn_featured_video_url_webm = '<source src="' . $oxsn_featured_video_url . '" type="video/webm">';

				elseif (strpos($oxsn_featured_video_url, '.ogv') > 0 || strpos($oxsn_featured_video_url, '.ogg') > 0) :

					$oxsn_featured_video_url_ogg = '<source src="' . $oxsn_featured_video_url . '" type="video/ogg">';

				endif;

				$option .=
				'<div class="oxsn_featured_video ' . $oxsn_featured_video_class . '">' .
					do_shortcode($content) .
					'<video class="oxsn_featured_video_video_bg" poster="">' .
						$oxsn_featured_video_url_mp4 .
						$oxsn_featured_video_url_webm .
						$oxsn_featured_video_url_ogg .
					'</video>' .
				'</div>';

			elseif (strpos($oxsn_featured_video_url, 'youtube') > 0) :

				parse_str( parse_url( $oxsn_featured_video_url, PHP_URL_QUERY ), $my_array_of_vars );
				$oxsn_youtube_video_code =  $my_array_of_vars['v'];

				$option .=
				'<div class="oxsn_featured_video ' . $oxsn_youtube_video_class . '">' .
					do_shortcode($content) .
					'<iframe width="560" height="315" class="oxsn_featured_video_video_bg" src="https://www.youtube.com/embed/' . $oxsn_youtube_video_code . '" frameborder="0" allowfullscreen></iframe>' .
				'</div>';

			elseif (strpos($oxsn_featured_video_url, 'vimeo') > 0) :

				preg_match("/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/", $oxsn_featured_video_url, $output_id);
				$oxsn_vimeo_video_code = $output_id[5];

				$option .=
				'<div class="oxsn_featured_video ' . $oxsn_vimeo_video_class . '">' .
					do_shortcode($content) .
					'<iframe class="oxsn_featured_video_video_bg" src="https://player.vimeo.com/video/' . $oxsn_vimeo_video_code . '" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>' .
				'</div>';

			endif;

		elseif ( !empty($oxsn_featured_video_parent_id) && !empty($oxsn_featured_video_parent_url) ) :

			if (strpos($oxsn_featured_video_parent_url, '.mp4') > 0 || strpos($oxsn_featured_video_parent_url, '.webm') > 0 || strpos($oxsn_featured_video_parent_url, '.ogv') > 0 || strpos($oxsn_featured_video_parent_url, '.ogg') > 0) :

				if (strpos($oxsn_featured_video_parent_url, '.mp4') > 0) :

					$oxsn_featured_video_parent_url_mp4 = '<source src="' . $oxsn_featured_video_parent_url . '" type="video/mp4">';

				elseif (strpos($oxsn_featured_video_parent_url, '.webm') > 0) :

					$oxsn_featured_video_parent_url_webm = '<source src="' . $oxsn_featured_video_parent_url . '" type="video/webm">';

				elseif (strpos($oxsn_featured_video_parent_url, '.ogv') > 0 || strpos($oxsn_featured_video_parent_url, '.ogg') > 0) :

					$oxsn_featured_video_parent_url_ogg = '<source src="' . $oxsn_featured_video_parent_url . '" type="video/ogg">';

				endif;

				$option .=
				'<div class="oxsn_featured_video ' . $oxsn_featured_video_class . '">' .
					do_shortcode($content) .
					'<video class="oxsn_featured_video_video_bg" autoplay loop poster="" muted>' .
						$oxsn_featured_video_url_mp4 .
						$oxsn_featured_video_url_webm .
						$oxsn_featured_video_url_ogg .
					'</video>' .
				'</div>';

			elseif (strpos($oxsn_featured_video_parent_url, 'youtube') > 0) :

				parse_str( parse_url( $oxsn_featured_video_parent_url, PHP_URL_QUERY ), $my_array_of_vars );
				$oxsn_youtube_video_code =  $my_array_of_vars['v'];

				$option .=
				'<div class="oxsn_featured_video ' . $oxsn_youtube_video_class . '">' .
					do_shortcode($content) .
					'<div id="ytplayer" class="oxsn_featured_video_video_bg" youtubeid="' . $oxsn_youtube_video_code . '"></div>' .
					'<script>var tag = document.createElement(\'script\'); tag.src = "https://www.youtube.com/player_api"; var firstScriptTag = document.getElementsByTagName(\'script\')[0]; firstScriptTag.parentNode.insertBefore(tag, firstScriptTag); var player; function onYouTubePlayerAPIReady() { player = new YT.Player(\'ytplayer\', { playerVars: { \'autoplay\': 1, \'controls\': 0, \'autohide\': 1, \'wmode\': \'opaque\', \'showinfo\': 0, \'loop\': 1, \'mute\': 1, \'playlist\': \'' . $oxsn_youtube_video_code . '\' }, videoId: \'' . $oxsn_youtube_video_code . '\', events: { \'onReady\': onPlayerReady } }); } function onPlayerReady(event) { event.target.mute().setLoop(true); }</script>' .
				'</div>';

			elseif (strpos($oxsn_featured_video_parent_url, 'vimeo') > 0) :

				preg_match("/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/", $oxsn_featured_video_parent_url, $output_id);
				$oxsn_vimeo_video_code = $output_id[5];

				$option .=
				'<div class="oxsn_featured_video ' . $oxsn_vimeo_video_class . '">' .
					do_shortcode($content) .
					'<iframe id="vmplayer" class="video-bg" src="//player.vimeo.com/video/' . $oxsn_vimeo_video_code . '?badge=0&byline=0&title=0&portrait=0&autoplay=1&loop=1&background=1&api=1&player_id=vmplayer" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>' .
					'<script>(function($) { $(document).ready(function(){ var froogaloop = \'https://f.vimeocdn.com/js/froogaloop2.min.js\'; $.getScript(froogaloop, function() { var vimeo_iframe = $(\'#vmplayer\')[0]; var player = $f(vimeo_iframe); player.addEvent(\'ready\', function() { player.api(\'setVolume\', 0); }); }); }); })(jQuery);</script>' .
				'</div>';
				
			endif;

		endif;

		return $option;

	}

}


?>