<?php
//require_once get_template_directory() . '/inc/demo_debug.php'; // demo debug

// Init
require_once get_template_directory() . '/inc/init/theme.php'; // theme init
require_once get_template_directory() . '/inc/init/customizer.php'; // customizer
require_once get_template_directory() . '/inc/init/custom-header.php'; // custom header feature
require_once get_template_directory() . '/inc/init/extras.php'; // extras

// Norebro helper framework
require_once get_template_directory() . '/inc/framework/bootstrap.php'; // Norebro framework

// Include TGMPA and set up plugins
require_once get_template_directory() . '/inc/tgmpa/class-tgm-plugin-activation.php';
require_once get_template_directory() . '/inc/tgmpa/register_plugins.php';
require_once get_template_directory() . '/inc/tgmpa/vc_setup.php';
require_once get_template_directory() . '/inc/tgmpa/acf_setup.php';
require_once get_template_directory() . '/inc/tgmpa/woocommerce_setup.php';
require_once get_template_directory() . '/inc/tgmpa/ocdi_setup.php';

// Parts
require_once get_template_directory() . '/inc/template-tags.php'; // custom tags template
require_once get_template_directory() . '/inc/sidebars.php'; // sidebars register
require_once get_template_directory() . '/inc/menu.php'; // mega menu
require_once get_template_directory() . '/inc/wp_overrides.php'; // WP features overrides (posts, comments, auth, ...)

// CSS and JS includes
require_once get_template_directory() . '/inc/enqueue.php';