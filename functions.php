<?php
/*
All the functions are in the PHP files in the `functions/` folder.
*/

if ( ! defined('ABSPATH') ) {
  exit;
}
require get_template_directory() . '/functions/helper.php';
require get_template_directory() . '/functions/cleanup.php';
require get_template_directory() . '/functions/setup.php';
require get_template_directory() . '/functions/enqueues.php';
require get_template_directory() . '/functions/hooks.php';
require get_template_directory() . '/functions/navbar.php';
require get_template_directory() . '/functions/widgets.php';
require get_template_directory() . '/functions/search-widget.php';
require get_template_directory() . '/functions/index-pagination.php';
require get_template_directory() . '/functions/single-split-pagination.php';
require get_template_directory() . '/functions/post-type.php';
require get_template_directory() . '/functions/testimonials.php';


// theme options with Customizer API
require_once( get_template_directory() . '/functions/admin/options.php' );
require_once( get_template_directory() . '/functions/customizer/customizer-controls.php' );
require_once( get_template_directory() . '/functions/customizer/customizer-settings.php' );
require_once( get_template_directory() . '/functions/customizer/customizer.php' );


if ( is_admin() ) :

	// meta-box for layout control
	require_once( get_template_directory() . '/functions/admin/meta-boxes.php' );

endif;