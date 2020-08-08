<?php
/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

include "fps-script.php";

wp_enqueue_style('fps-style', plugins_url("front-end-post-submission/assets/fps-style.css"));
	
add_action( 'wp_enqueue_scripts', 'fps_wp_media' );
if ( ! function_exists( 'fps_wp_media' ) ) {
function fps_wp_media() {
	wp_enqueue_media();
}
}

