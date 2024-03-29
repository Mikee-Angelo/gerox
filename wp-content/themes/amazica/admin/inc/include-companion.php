<?php
/**
 * This file implements custom requirements for the ThemeFarmer Companion plugin.
 * It can be used as-is in themes (drop-in).
 *
 */

$hide_install = get_option('amazica_hide_customizer_companion_notice', false);
if (!function_exists('themefarmer_companion') && !$hide_install) {
	if (class_exists('WP_Customize_Section') && !class_exists('Amazica_Companion_Installer_Section')) {
		/**
		 * Recommend the installation of Amazica  Companion using a custom section.
		 *
		 * @see WP_Customize_Section
		 */
		class Amazica_Companion_Installer_Section extends WP_Customize_Section {
			/**
			 * Customize section type.
			 *
			 * @access public
			 * @var string
			 */
			public $type = 'amazica_companion_installer';

			public function __construct($manager, $id, $args = array()) {
				parent::__construct($manager, $id, $args);

				add_action('customize_controls_enqueue_scripts', 'Amazica_Companion_Installer_Section::enqueue');
			}

			/**
			 * enqueue styles and scripts
			 *
			 *
			 **/
			public static function enqueue() {
				wp_enqueue_script('plugin-install');
				wp_enqueue_script('updates');
				wp_enqueue_script('amazica-companion-install', AMAZICA_ADMIN_URI . '/assets/js/plugin-install.js', array('jquery'));
				wp_localize_script('amazica-companion-install', 'amazica_companion_install',
					array(
						'installing' => esc_html__('Installing', 'amazica'),
						'activating' => esc_html__('Activating', 'amazica'),
						'error'      => esc_html__('Error', 'amazica'),
						'ajax_url'   => esc_url_raw(admin_url('admin-ajax.php')),
					)
				);
			}
			/**
			 * Render the section.
			 *
			 * @access protected
			 */
			protected function render() {
				// Determine if the plugin is not installed, or just inactive.
				$plugins   = get_plugins();
				$installed = false;
				foreach ($plugins as $plugin) {
					if ('ThemeFarmer Companion' === $plugin['Name']) {
						$installed = true;
					}
				}
				$slug = 'themefarmer-companion';
				// Get the plugin-installation URL.
				$classes            = 'cannot-expand accordion-section control-section-companion control-section control-section-themes control-section-' . $this->type;
				?>
				<li id="accordion-section-<?php echo esc_attr($this->id); ?>" class="<?php echo esc_attr($classes); ?>">
					<span class="themefarmer-customizer-notification-dismiss" id="companion-install-dismiss" href="#companion-install-dismiss"> <i class="fa fa-times"></i></span>
					<?php if (!$installed): ?>
					<?php 
						$plugin_install_url = add_query_arg(
							array(
								'action' => 'install-plugin',
								'plugin' => $slug,
							),
							self_admin_url('update.php')
						);
						$plugin_install_url = wp_nonce_url($plugin_install_url, 'install-plugin_themefarmer-companion');
					 ?>
						<p><?php esc_html_e('ThemeFarmer Companion plugin is required to take advantage of this theme\'s features in the customizer.', 'amazica');?></p>
						<a class="themefarmer-plugin-install install-now button-secondary button" data-slug="themefarmer-companion" href="<?php echo esc_url_raw($plugin_install_url); ?>" aria-label="<?php esc_attr_e('Install Amazica  Companion Now', 'amazica');?>" data-name="<?php esc_attr_e('Amazica  Companion', 'amazica'); ?>">
							<?php esc_html_e('Install & Activate', 'amazica');?>
						</a>
					<?php else: ?>
						<?php 
							$plugin_link_suffix = $slug . '/' . $slug . '.php';
							$plugin_activate_link = add_query_arg(
								array(
									'action'        => 'activate',
									'plugin'        => rawurlencode( $plugin_link_suffix ),
									'plugin_status' => 'all',
									'paged'         => '1',
									'_wpnonce'      => wp_create_nonce( 'activate-plugin_' . $plugin_link_suffix ),
								), self_admin_url( 'plugins.php' )
							);
						?>
						<p><?php esc_html_e('You have installed ThemeFarmer Companion. Activate it to take advantage of this theme\'s features in the customizer.', 'amazica');?></p>
						<a class="themefarmer-plugin-activate activate-now button-primary button" data-slug="themefarmer-companion" href="<?php echo esc_url_raw($plugin_activate_link); ?>" aria-label="<?php esc_attr_e('Activate ThemeFarmer Companion now', 'amazica');?>" data-name="<?php esc_attr_e('ThemeFarmer Companion', 'amazica'); ?>">
							<?php esc_html_e('Activate Now', 'amazica');?>
						</a>
					<?php endif;?>
				</li>
				<?php
			}
		}
	}
	if (!function_exists('amazica_companion_installer_register')) {
		/**
		 * Registers the section, setting & control for the ThemeFarmer Companion installer.
		 *
		 * @param object $wp_customize The main customizer object.
		 */
		function amazica_companion_installer_register($wp_customize) {
			$wp_customize->add_section(new Amazica_Companion_Installer_Section($wp_customize, 'amazica_companion_installer', array(
				'title'      => '',
				'capability' => 'install_plugins',
				'priority'   => 0,
			)));

		}
		add_action('customize_register', 'amazica_companion_installer_register');
	}
}

function amazica_hide_customizer_companion_notice(){
	update_option('amazica_hide_customizer_companion_notice', true);
	echo true;
	wp_die();
}
add_action('wp_ajax_amazica_hide_customizer_companion_notice', 'amazica_hide_customizer_companion_notice');