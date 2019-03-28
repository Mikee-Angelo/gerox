<?php
/**
 * Elementor Compatibility File.
 *
 * @package Amazica 
 */

namespace Elementor;

// If plugin - 'Elementor' not exist then return.
if ( ! class_exists( '\Elementor\Plugin' ) ) {
	return;
}

/**
 * Amazica  Elementor Compatibility
 */
if ( ! class_exists( 'ThemeFarmer_Elementor' ) ) :

	/**
	 * Amazica  Elementor Compatibility
	 *
	 * @since 1.0.0
	 */
	class ThemeFarmer_Elementor {

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
			add_action( 'wp', array( $this, 'elementor_default_setting' ), 20 );
			add_action( 'elementor/preview/init', array( $this, 'elementor_default_setting' ) );
		}

		/**
		 * Elementor Content layout set as Page Builder
		 *
		 * @return void
		 * @since  1.0.2
		 */
		function elementor_default_setting() {
			if ( false == apply_filters( 'themefarmer_enable_page_builder_compatibility', true ) ||  'post' == get_post_type()) {
				return;
			}

			// don't modify post meta settings if we are not on Elementor's edit page.
			if ( ! $this->is_elementor_editor() ) {
				return;
			}

			global $post;
			$id = get_the_ID();

			$page_builder_flag = get_post_meta( $id, '_themefarmer_content_layout_flag', true );
			if ( isset( $post ) && empty( $page_builder_flag ) && ( is_admin() || is_singular() ) ) {

				if ($this->is_elementor_activated( $id ) ) {
			
					$content_layout = get_post_meta( $id, 'themefarmer-page-content-layout', true);
					if ( empty( $content_layout ) || 'default' == $content_layout ) {
						update_post_meta( $id, 'themefarmer-page-content-layout', 'page-builder' );
					}
					
					add_filter('themefarmer_page_layout', array($this, 'return_full'));
					add_filter('themefarmer_page_builder_editing', '__return_true');
				}
			}
		}

		public function return_full(){
			return 'full';
		}

		/**
		 * Check is elementor activated.
		 *
		 * @param int $id Post/Page Id.
		 * @return boolean
		 */
		function is_elementor_activated( $id ) {
			if ( version_compare( ELEMENTOR_VERSION, '1.5.0', '<' ) ) {
				return ( 'builder' === Plugin::$instance->db->get_edit_mode( $id ) );
			} else {
				return Plugin::$instance->db->is_built_with_elementor( $id );
			}
		}

		/**
		 * Check if Elementor Editor is open.
		 *
		 * @since  1.2.7
		 *
		 * @return boolean True IF Elementor Editor is loaded, False If Elementor Editor is not loaded.
		 */
		private function is_elementor_editor() {
			if ( ( isset( $_REQUEST['action'] ) && 'elementor' == $_REQUEST['action'] ) ||
				isset( $_REQUEST['elementor-preview'] )
			) {
				return true;
			}

			return false;
		}

	}

endif;

/**
 * Kicking this off by calling 'get_instance()' method
 */
ThemeFarmer_Elementor::get_instance();
