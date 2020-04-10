<?php
/*
 * Setup
 */

if ( ! defined( 'BASIC_APP_NAME' ) ) {
	$theme_name = sanitize_key( '' . wp_get_theme() );
	define( 'BASIC_APP_NAME', $theme_name );
}

define( 'BASIC_OPTION_NAME', 'basic_theme_options_' . BASIC_APP_NAME );


if ( ! function_exists( 'bs_get_theme_option' ) ) :
	function bs_get_theme_option( $key, $default = false ) {

		$cache = wp_cache_get( BASIC_OPTION_NAME );
		if ( $cache ) {
			return ( isset( $cache[ $key ] ) ) ? $cache[ $key ] : $default;
		}

		$opt = get_option( BASIC_OPTION_NAME );

		wp_cache_add( BASIC_OPTION_NAME, $opt );

		return ( isset( $opt[ $key ] ) ) ? $opt[ $key ] : $default;
	}
endif;

if ( ! function_exists('b4st_setup') ) {
	function b4st_setup() {

		// Gutenberg
		add_theme_support( 'wp-block-styles' );

		// b4st cannot support extra-wide blocks
		//add_theme_support( 'align-wide' );

		add_theme_support( 'editor-styles' );
		add_editor_style('theme/css/editor.css');

		// Theme
		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');

		update_option('thumbnail_size_w', 285); /* internal max-width of col-3 */
		update_option('small_size_w', 350); /* internal max-width of col-4 */
		update_option('medium_size_w', 730); /* internal max-width of col-8 */
		update_option('large_size_w', 1110); /* internal max-width of col-12 */

		if ( ! isset($content_width) ) {
			$content_width = 1100;
		}

		add_theme_support( 'post-formats', array(
			'aside',
			'gallery',
			'link',
			'image',
			'quote',
			'status',
			'video',
			'audio',
			'chat'
		) );

		add_theme_support('automatic-feed-links');
	}
}
add_action('init', 'b4st_setup');

if ( ! function_exists( 'b4st_avatar_attributes' ) ) {
	function b4st_avatar_attributes($avatar_attributes) {
		$display_name = get_the_author_meta( 'display_name' );
		$avatar_attributes = str_replace('alt=\'\'', 'alt=\'Avatar for '.$display_name.'\' title=\'Gravatar for '.$display_name.'\'',$avatar_attributes);
		return $avatar_attributes;
	}
}
add_filter('get_avatar','b4st_avatar_attributes');

if ( ! function_exists( 'b4st_author_avatar' ) ) {
	function b4st_author_avatar() {

		echo get_avatar('', $size = '96');
	}
}

if ( ! function_exists( 'b4st_author_description' ) ) {
	function b4st_author_description() {
		echo get_the_author_meta('user_description');
	}
}

if ( ! function_exists( 'b4st_post_date' ) ) {
	function b4st_post_date() {
		if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time> <time class="updated" datetime="%3$s">(updated %4$s)</time>';
			}

			$time_string = sprintf( $time_string,
				esc_attr( get_the_date( 'c' ) ),
				get_the_date(),
				esc_attr( get_the_modified_date( 'c' ) ),
				get_the_modified_date()
			);

			echo $time_string;
		}
	}
}

if ( ! function_exists( 'basic_add_social' ) ) :
	function basic_add_social( $content ) {
		global $post;

		if ( is_singular() && bs_get_theme_option( 'add_social_meta' ) ) {

			$aiod  = get_post_meta( $post->ID, '_aioseop_description', true );
			$descr = ( isset( $aiod ) ) ? esc_html( $aiod ) : $post->post_excerpt;

			$title    = get_the_title();
			$url      = get_the_permalink();
			$blogname = get_bloginfo( 'name' );
			$img      = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail', false );

			echo <<<EOT
		
<!-- BEGIN social meta -->
<meta property="og:type" content="article"/>
<meta property="og:title" content="$title"/>
<meta property="og:description" content="$descr" />
<meta property="og:image" content="$img[0]"/>
<meta property="og:url" content="$url"/>
<meta property="og:site_name" content="$blogname"/>
<link rel="image_src" href="$img[0]" />
<!-- END social meta -->


EOT;
		}
	}
endif;
add_action( 'wp_head', 'basic_add_social' );
