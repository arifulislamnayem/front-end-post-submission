<?php
/*
Plugin Name: Front-end Post Submission
Plugin URI: http://ainayem.com/
Description: It can be used for add wordpress post from frontend.
Author: Ariful Islam Nayem
Version: 1.0
Author URI: http://ainayem.com
Requires at least: 3.8
Tested up to: 5.4.2
Text Domain: fps
Domain Path: /languages/
*/

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

require "inc/enqueue.php";
require "inc/content.php";