<?php
/**
 * Amazica Theme Customizer
 *
 * @package Amazica
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function amazica_customize_register($wp_customize) {

	/*Panels Start*/
	$wp_customize->add_panel('themefarmer_fontpage_panel', array(
		'title'    => __('Frontpage Sections', 'amazica'),
		'priority' => 20,
	));

	$wp_customize->add_panel('amazica_header_options_panel', array(
		'title'    => __('Header Options', 'amazica'),
		'priority' => 55,
	));
	/*Panel End*/

/* Contact */

	$wp_customize->add_section('amazica_header_topbar_section', array(
		'title'    => __('Header Topbar', 'amazica'),
		'panel'	   => 'amazica_header_options_panel',
	));

	$wp_customize->add_setting('themefarmer_header_topbar_enable', array(
		'sanitize_callback' => 'amazica_sanitize_checkbox',
		'default' => false,
	));

	$wp_customize->add_control('themefarmer_header_topbar_enable', array(
		'type'     => 'checkbox',
		'section'  => 'amazica_header_topbar_section',
		'label'    => __('Enable/Disable Topbar', 'amazica'),
	));

	$wp_customize->add_setting('amazica_top_email', array(
		'sanitize_callback' => 'amazica_sanitize_email',
		'default' => 'email@example.com'
	));

	$wp_customize->add_control('amazica_top_email', array(
		'type'     => 'email',
		'priority' => 200,
		'section'  => 'amazica_header_topbar_section',
		'label'    => __('Email', 'amazica'),
	));

	$wp_customize->add_setting('amazica_top_phone', array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => '0123456789',
	));

	$wp_customize->add_control('amazica_top_phone', array(
		'type'     => 'text',
		'priority' => 200,
		'section'  => 'amazica_header_topbar_section',
		'label'    => __('Phone', 'amazica'),
	));
/* Contact */

/** Recent Posts **/

	$wp_customize->add_section('themefarmer_home_blog_section', array(
		'title' => __('Blog', 'amazica'),
		'panel' => 'themefarmer_fontpage_panel',
	));

	$wp_customize->add_setting('themefarmer_home_blog_heading', array(
		'default'           => __('Latest Posts', 'amazica'),
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('themefarmer_home_blog_heading', array(
		'type'    => 'text',
		'label'   => __('Heading', 'amazica'),
		'section' => 'themefarmer_home_blog_section',
	));

	$wp_customize->add_setting('themefarmer_home_blog_desc', array(
		'default'           => __('Description Latest Posts', 'amazica'),
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('themefarmer_home_blog_desc', array(
		'type'    => 'text',
		'label'   => __('Description', 'amazica'),
		'section' => 'themefarmer_home_blog_section',
	));

	$wp_customize->add_setting('themefarmer_home_blog_count', array(
		'default'           => 10,
		'sanitize_callback' => 'absint',
	));

	$wp_customize->add_control('themefarmer_home_blog_count', array(
		'type'    => 'number',
		'section' => 'themefarmer_home_blog_section',
		'label'   => __('Post Count', 'amazica'),
	));

/** Recent Posts **/

/* callout */

	$wp_customize->add_section('themefarmer_home_callout_section', array(
		'title' => __('Callout', 'amazica'),
		'panel' => 'themefarmer_fontpage_panel',
	));

	$wp_customize->add_setting('themefarmer_home_callout_heading', array(
		'default'           => __('Enter your text here', 'amazica'),
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('themefarmer_home_callout_heading', array(
		'type'    => 'text',
		'section' => 'themefarmer_home_callout_section',
		'label'   => __('Text', 'amazica'),
	));

	$wp_customize->add_setting('themefarmer_home_callout_desc', array(
		'default'           => __('some description text here', 'amazica'),
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('themefarmer_home_callout_desc', array(
		'type'    => 'text',
		'section' => 'themefarmer_home_callout_section',
		'label'   => __('Description', 'amazica'),
	));
	

	$wp_customize->add_setting('themefarmer_home_callout_label', array(
		'default'           => __('Learn More', 'amazica'),
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('themefarmer_home_callout_label', array(
		'type'    => 'text',
		'section' => 'themefarmer_home_callout_section',
		'label'   => __('Button Label', 'amazica'),
	));

	$wp_customize->add_setting('themefarmer_home_callout_link', array(
		'sanitize_callback' => 'esc_url_raw',
		'default'           => '#link',
	));
	
	$wp_customize->add_control('themefarmer_home_callout_link', array(
		'type'    => 'text',
		'section' => 'themefarmer_home_callout_section',
		'label'   => __('Button Link', 'amazica'),
	));

/* callout */

/*home subscribe*/

	$wp_customize->add_section('themefarmer_home_subscribe_section', array(
		'title' => esc_html__('Subscribe', 'amazica'),
		'panel' => 'themefarmer_fontpage_panel',
	));

	$wp_customize->add_setting('themefarmer_home_subscribe_heading', array(
		'default'           => __('Newsletter', 'amazica'),
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('themefarmer_home_subscribe_heading', array(
		'type'    => 'text',
		'label'   => __('Heading', 'amazica'),
		'section' => 'themefarmer_home_subscribe_section',
	));

	$wp_customize->add_setting('themefarmer_home_subscribe_desc', array(
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('themefarmer_home_subscribe_desc', array(
		'type'    => 'text',
		'label'   => __('Description', 'amazica'),
		'section' => 'themefarmer_home_subscribe_section',
	));

	$wp_customize->add_setting('amazica_plugin_needed_ultimate_subscribe', array(
		'sanitize_callback' => 'amazica_sanitize_html',
		'capability'        => 'administrator',
	));

	$wp_customize->add_control(new Amazica_Plugin_Install_Control($wp_customize, 'amazica_plugin_needed_ultimate_subscribe', array(
		'label'       => __('Install Ultimate Subscribe', 'amazica'),
		'description' => __('This plugin will show subscribe form section. Please install and Activate Ultimate Subscribe plugin to use this section.', 'amazica'),
		'section'     => 'themefarmer_home_subscribe_section',
		'name'        => __('Ultimate Subscribe', 'amazica'),
		'slug'        => 'ultimate-subscribe',
	)));
/*home subscribe*/

/** Recent Products **/

	$wp_customize->add_section('themefarmer_home_products_latest_section', array(
		'title' => __('Products', 'amazica'),
		'panel' => 'themefarmer_fontpage_panel',
	));

	if (!amazica_is_wc()) {
		$wp_customize->add_setting('amazica_woocommerce_needed', array(
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'amazica_sanitize_html',
		));

		$wp_customize->add_control(new Amazica_Info_Text($wp_customize, 'amazica_woocommerce_needed', array(
			'label'       => __('Install WooCommerce', 'amazica'),
			'description' => __('This section show products from WooCommerce. Please install and Activate WooCommerce plugin to use this section.', 'amazica'),
			'priority'    => 1,
			'section'     => 'themefarmer_home_products_latest_section',
		)));
	}

	$wp_customize->add_setting('amazica_home_products_latest_heading', array(
		'default'           => __('Latest Products', 'amazica'),
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('amazica_home_products_latest_heading', array(
		'type'    => 'text',
		'section' => 'themefarmer_home_products_latest_section',
		'label'   => __('Heading', 'amazica'),
	));

	$wp_customize->add_setting('amazica_home_products_latest_desc', array(
		'default'           => __('Description Latest Product', 'amazica'),
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('amazica_home_products_latest_desc', array(
		'type'    => 'text',
		'section' => 'themefarmer_home_products_latest_section',
		'label'   => __('Description', 'amazica'),
	));

	$wp_customize->add_setting('amazica_home_products_latest_count', array(
		'default'           => 15,
		'sanitize_callback' => 'absint',
	));

	$wp_customize->add_control('amazica_home_products_latest_count', array(
		'type'    => 'number',
		'section' => 'themefarmer_home_products_latest_section',
		'label'   => __('Product Count', 'amazica'),
	));

/** Recent Products **/

/* theme color*/
	$wp_customize->add_setting('amazica_theme_primary_color', array(
		'sanitize_callback' => 'sanitize_hex_color',
		'default'           => '#0186f0',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'amazica_theme_primary_color', array(
		'label'    => __('Primary Color', 'amazica'),
		'section'  => 'colors',
		'priority' => 1,
	)));
/* theme color*/

/* typography start*/
	if (class_exists('ThemeFarmer_Field_Font_Selector')) {

		$wp_customize->add_panel('amazica_typography_panel', array(
			'title'    => __('Typography Options', 'amazica'),
			'priority' => 30,
		));

		$wp_customize->add_section('amazica_body_typography', array(
			'title'    => __('Body Typography', 'amazica'),
			'panel'    => 'amazica_typography_panel',
			'priority' => 10,
		));

		$wp_customize->add_setting('themefarmer_body_font_family', array(
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		));

		$wp_customize->add_control(new ThemeFarmer_Field_Font_Selector($wp_customize, 'themefarmer_body_font_family', array(
			'label'    => esc_html__('Body Font', 'amazica'),
			'section'  => 'amazica_body_typography',
			'priority' => 30,
		)));
	}

	if (class_exists('ThemeFarmer_Field_Range')) {
		$wp_customize->add_setting('themefarmer_body_font_size', array(
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
			'default'           => 10,
		));

		$wp_customize->add_control(new ThemeFarmer_Field_Range($wp_customize, 'themefarmer_body_font_size', array(
			'section'    => 'amazica_body_typography',
			'label'      => esc_html__('Font Size', 'amazica'),
			'responsive' => false,
		)));
	}

	if (class_exists('ThemeFarmer_Field_Tabs')) {

		$wp_customize->add_setting('amazica_body_typography_tabs', array(
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		));

		$wp_customize->add_control(new ThemeFarmer_Field_Tabs($wp_customize, 'amazica_body_typography_tabs', array(
			'section' => 'amazica_body_typography',
			'tabs'    => array(
				'body_font_family' => array(
					'icon'     => 'fa-font',
					'name'     => esc_html__('Body Font', 'amazica'),
					'controls' => array('themefarmer_body_font_family'),
				),
				'body_font_size'   => array(
					'icon'     => 'fa-text-height',
					'name'     => esc_html__('Body Font Size', 'amazica'),
					'controls' => array('themefarmer_body_font_size'),
				),
			),
		)));
	}
/* typography end */

/* page layout*/
	if (class_exists('ThemeFarmer_Field_Image_Select')) {
		$wp_customize->add_panel('amazica_appearance_panel', array(
			'title'    => __('Page Layouts', 'amazica'),
			'priority' => 30,
		));

		$wp_customize->add_section('amazica_blog_page_layouts_section', array(
			'title'    => __('Blog Layout', 'amazica'),
			'panel'    => 'amazica_appearance_panel',
			'priority' => 10,
		));

		$wp_customize->add_setting('amazica_blog_post_index_layout', array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => 'right',
		));

		$wp_customize->add_control(new ThemeFarmer_Field_Image_Select($wp_customize, 'amazica_blog_post_index_layout', array(
			'label'   => __('All Posts Page Layout', 'amazica'),
			'section' => 'amazica_blog_page_layouts_section',
			'choices' => array(
				'left'  => esc_url(get_template_directory_uri() . '/images/layout/2cleft.png'),
				'full'  => esc_url(get_template_directory_uri() . '/images/layout/full.png'),
				'right' => esc_url(get_template_directory_uri() . '/images/layout/2cright.png'),
			),
		)));

		$wp_customize->add_setting('amazica_blog_single_post_layout', array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => 'right',
		));

		$wp_customize->add_control(new ThemeFarmer_Field_Image_Select($wp_customize, 'amazica_blog_single_post_layout', array(
			'label'   => __('Single Post Layout', 'amazica'),
			'section' => 'amazica_blog_page_layouts_section',
			'choices' => array(
				'left'  => esc_url(get_template_directory_uri() . '/images/layout/2cleft.png'),
				'full'  => esc_url(get_template_directory_uri() . '/images/layout/full.png'),
				'right' => esc_url(get_template_directory_uri() . '/images/layout/2cright.png'),
			),
		)));

		$wp_customize->add_setting('amazica_blog_single_page_layout', array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => 'right',
		));

		$wp_customize->add_control(new ThemeFarmer_Field_Image_Select($wp_customize, 'amazica_blog_single_page_layout', array(
			'label'   => __('Single Page Layout', 'amazica'),
			'section' => 'amazica_blog_page_layouts_section',
			'choices' => array(
				'left'  => esc_url(get_template_directory_uri() . '/images/layout/2cleft.png'),
				'full'  => esc_url(get_template_directory_uri() . '/images/layout/full.png'),
				'right' => esc_url(get_template_directory_uri() . '/images/layout/2cright.png'),
			),
		)));
	}
/* page layout end */	

	$wp_customize->add_section('amazica_pro_features_section', array(
		'title'    => __('View PRO Features', 'amazica'),
		'priority' => 1,
	));

	$wp_customize->add_setting('amazica_upsale_control', array(
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control(new Amazica_Upsale_Customize_Control($wp_customize, 'amazica_upsale_control', array(
		'section' => 'amazica_pro_features_section',
		'link'    => 'https://www.themefarmer.com/product/amazica-pro/?utm_source=customizer&utm_medium=amazica-pro-link&utm_campaign=upgrade-to-pro',
	)));

	$wp_customize->get_section('title_tagline')->priority = 10;
	if (function_exists('themefarmer_companion')) {
		$wp_customize->get_section('themefarmer_home_products_latest_section')->priority = 40;
		$wp_customize->get_section('themefarmer_home_callout_section')->priority         = 60;
		$wp_customize->get_section('themefarmer_home_subscribe_section')->priority       = 90;
		$wp_customize->get_section('themefarmer_home_blog_section')->priority            = 100;
	}

	$wp_customize->get_setting('blogname')->transport                           = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport                    = 'postMessage';
	$wp_customize->get_setting('header_textcolor')->transport                   = 'postMessage';
	$wp_customize->get_setting('themefarmer_home_blog_heading')->transport      = 'postMessage';
	$wp_customize->get_setting('themefarmer_home_blog_desc')->transport         = 'postMessage';
	$wp_customize->get_setting('amazica_home_products_latest_heading')->transport = 'postMessage';
	$wp_customize->get_setting('amazica_home_products_latest_desc')->transport    = 'postMessage';
	$wp_customize->get_setting('themefarmer_home_callout_heading')->transport            = 'postMessage';
	$wp_customize->get_setting('themefarmer_home_callout_label')->transport           = 'postMessage';
	$wp_customize->get_setting('themefarmer_home_subscribe_heading')->transport = 'postMessage';
	$wp_customize->get_setting('themefarmer_home_subscribe_desc')->transport    = 'postMessage';

	if (isset($wp_customize->selective_refresh)) {
		$wp_customize->selective_refresh->add_partial('blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'amazica_customize_partial_blogname',
		));

		$wp_customize->selective_refresh->add_partial('blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'amazica_customize_partial_blogdescription',
		));

		$wp_customize->selective_refresh->add_partial('themefarmer_home_blog_heading', array(
			'selector'        => '.section-blog .section-title',
			'render_callback' => 'amazica_home_blog_heading_partial',
		));

		$wp_customize->selective_refresh->add_partial('themefarmer_home_blog_desc', array(
			'selector'        => '.section-blog .section-description',
			'render_callback' => 'amazica_home_blog_desc_partial',
		));

		$wp_customize->selective_refresh->add_partial('amazica_home_products_latest_desc', array(
			'selector'        => '.section-products-latest .section-description',
			'render_callback' => 'amazica_home_products_latest_desc_partial',
		));

		$wp_customize->selective_refresh->add_partial('amazica_home_products_latest_heading', array(
			'selector'        => '.section-products-latest .section-title',
			'render_callback' => 'amazica_home_products_latest_heading_partial',
		));

		$wp_customize->selective_refresh->add_partial('themefarmer_home_callout_heading', array(
			'selector'        => '.section-callout .section-title',
			'render_callback' => 'themefarmer_home_callout_heading_partial',
		));

		$wp_customize->selective_refresh->add_partial('themefarmer_home_callout_label', array(
			'selector'        => '.section-callout a.btn-read-more',
			'render_callback' => 'themefarmer_home_callout_label_partial',
		));

		$wp_customize->selective_refresh->add_partial('themefarmer_home_subscribe_heading', array(
			'selector'        => '.section-subscribe .section-title',
			'render_callback' => 'themefarmer_home_subscribe_heading_partial',
		));

		$wp_customize->selective_refresh->add_partial('themefarmer_home_subscribe_desc', array(
			'selector'        => '.section-subscribe .section-description',
			'render_callback' => 'themefarmer_home_subscribe_desc_partial',
		));
	}
}
add_action('customize_register', 'amazica_customize_register');

function amazica_customize_register_last($wp_customize){

	$home_sectionss = array('services', 'about', 'products-latest', 'team', 'callout', 'testimonials', 'brands', 'subscribe', 'blog');
	foreach ($home_sectionss as $key => $section) {
		$section_name = str_replace('-', '_', $section);
		$section_name = str_replace(' ', '_', $section_name);
		$scph_section = $wp_customize->get_section('themefarmer_home_' . $section_name . '_section');
		if($scph_section){
			$wp_customize->add_setting('amazica_is_enable_section_' . $section_name, array(
				'default'           => true,
				'sanitize_callback' => 'amazica_sanitize_checkbox',
			));

			$wp_customize->add_control('amazica_is_enable_section_' . $section_name, array(
				'type'     => 'checkbox',
				'label'    => __('Enable/Disable Section', 'amazica'),
				'section'  => 'themefarmer_home_' . $section_name . '_section',
				'priority' => 5,
			));
		}
	}
}
add_action('customize_register', 'amazica_customize_register_last', 999);

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function amazica_customize_partial_blogname() {
	bloginfo('name');
}

function amazica_customize_partial_blogdescription() {
	bloginfo('description');
}

function amazica_home_blog_heading_partial() {
	return esc_html(get_theme_mod('themefarmer_home_blog_heading'));
}

function amazica_home_blog_desc_partial() {
	return esc_html(get_theme_mod('themefarmer_home_blog_desc'));
}

function amazica_home_products_latest_desc_partial() {
	return esc_html(get_theme_mod('amazica_home_products_latest_desc'));
}

function amazica_home_products_latest_heading_partial() {
	return esc_html(get_theme_mod('amazica_home_products_latest_heading'));
}

function themefarmer_home_callout_heading_partial() {
	return esc_html(get_theme_mod('themefarmer_home_callout_heading'));
}

function themefarmer_home_callout_label_partial() {
	return esc_html(get_theme_mod('themefarmer_home_callout_label'));
}

function themefarmer_home_subscribe_heading_partial() {
	return esc_html(get_theme_mod('themefarmer_home_subscribe_heading'));
}
function themefarmer_home_subscribe_desc_partial() {
	return esc_html(get_theme_mod('themefarmer_home_subscribe_desc'));
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function amazica_customize_preview_js() {
	wp_enqueue_script('amazica-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), '20151215', true);
}
add_action('customize_preview_init', 'amazica_customize_preview_js');

if (class_exists('WP_Customize_Control')):
	class Amazica_Info_Text extends WP_Customize_Control {

		public function render_content() {
			?>
		    <span class="customize-control-title">
				<?php echo esc_html($this->label); ?>
			</span>

			<?php if ($this->description):?>
				<span class="description customize-control-description">
				<?php echo wp_kses_post($this->description); ?>
				</span>
			<?php endif;
		}
	}

	class Amazica_Upsale_Customize_Control extends WP_Customize_Control {
		public $type = 'themefarmer-upsale';
		public $link = '';
		protected function render_content() {
			?>
			<div class="themefarmer-upsale-control">
				<ul class="themefarmer-pro-features">
					<li><span class="tf-pro-upsale-label">PRO</span> <span class="tf-pro-upsale-text"><?php esc_html_e('Advance Slider for Mobile & tablet device', 'amazica');?></span></li>
					<li><span class="tf-pro-upsale-label">PRO</span> <span class="tf-pro-upsale-text"><?php esc_html_e('FrontPage Section Reorder ', 'amazica');?></span></li>
					<li><span class="tf-pro-upsale-label">PRO</span> <span class="tf-pro-upsale-text"><?php esc_html_e('Portfolio ', 'amazica');?></span></li>
					<li><span class="tf-pro-upsale-label">PRO</span> <span class="tf-pro-upsale-text"><?php esc_html_e('Pricing Plan Section (one click add, reorder)', 'amazica');?></span></li>
					<li><span class="tf-pro-upsale-label">PRO</span> <span class="tf-pro-upsale-text"><?php esc_html_e('FrontPage Sections 17+(Pre Built) and Unlimited Section by Shortcode and widgets ', 'amazica');?></span></li>
					<li><span class="tf-pro-upsale-label">PRO</span> <span class="tf-pro-upsale-text"><?php esc_html_e('15+ Page Templates for (Contact, About, Portfolio etc..)  Page', 'amazica');?></span></li>
					<li><span class="tf-pro-upsale-label">PRO</span> <span class="tf-pro-upsale-text"><?php esc_html_e('Live Chat Support', 'amazica');?></span></li>
				</ul>
				<a href="<?php echo esc_url($this->link); ?>" target="_blank" class="button button-primary themefarmer-upsale-bt" id="themefarmer-pro-button"><?php esc_html_e('Get The PRO Version! ', 'amazica');?></a>
				<hr>
				<ul class="themefarmer-pro-more">
					<li><?php esc_html_e('Advance Slider -> select different version of images  for mobile, tablet and desktop devices', 'amazica');?></li>
					<li><?php esc_html_e('Reorder, enable/disable FrontPage sections by drag and drop.', 'amazica');?></li>
					<li><?php esc_html_e('Advance Portfolio to show your Projects. set Project link, images, start date, end date, client link', 'amazica');?></li>
					<li><?php esc_html_e('Advance Live Pricing Plan Section with Custom HTML block for button or enter link', 'amazica');?></li>
					<li><?php esc_html_e('Automatic Updates right in your Dashboard.', 'amazica');?></li>
					<li><?php esc_html_e('17+ Front Page Section (products, brands, pricing, shortcode, widgets etc..)', 'amazica');?></li>
					<li><?php esc_html_e('Just create a page and select template for page. 15+ Page Templates for (Contact, About, Portfolio etc..)  Page.', 'amazica');?></li>
					<li><?php esc_html_e('Live Chat Support provide you very quick solution to your issue', 'amazica');?></li>
				</ul>
			</div>
			<?php
		}

	}

endif;