<?php
define('AMAZICA_ADMIN_DIR', trailingslashit(get_template_directory()) . 'admin');
define('AMAZICA_ADMIN_URI', trailingslashit(get_template_directory_uri()) . 'admin');

if (!function_exists('amazica_is_front_page_setup_done')) {
	
	function amazica_is_front_page_setup_done() {

		if(get_option('show_on_front') == 'page'){
			$front_page_id = absint(get_option('page_on_front'));
			if($front_page_id > 0){
				$pageTemplate = get_post_meta($front_page_id, '_wp_page_template', true);
				if ($pageTemplate == 'templates/homepage.php') {
					return true;
				}
			}
		}

		return false;
	}
}

if(is_admin()){
	require AMAZICA_ADMIN_DIR . '/inc/class-themefarmer-about-page.php';
}

require AMAZICA_ADMIN_DIR . '/inc/plugin-include-control.php';
require AMAZICA_ADMIN_DIR . '/inc/include-companion.php';


