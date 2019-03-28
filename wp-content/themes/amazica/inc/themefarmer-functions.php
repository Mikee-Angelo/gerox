<?php

function amazica_is_wc() {

	if (class_exists('WooCommerce')) {
		return true;
	} else {
		return false;
	}

}

function amazica_get_social_block() {
	$new_tab = get_theme_mod('themefarmer_social_new_tab', true);
	$socials = get_theme_mod('themefarmer_socials');
	?>
    <ul class="header-topbar-links">
        <?php if ($socials): foreach ($socials as $key => $social): ?>
            <?php if (!empty($social['link']) && !empty($social['icon'])): ?>
            <li><a href="<?php echo esc_url($social['link']); ?>"  <?php echo absint($new_tab) ? 'target="_blank"' : ''; ?>><i class="fa <?php echo esc_attr($social['icon']); ?>"></i></a></li>
            <?php endif;?>
        <?php endforeach;endif;?>
    </ul>
    <?php
}

function amazica_get_contact_block() {
	$top_phone = get_theme_mod('amazica_top_phone');if (!empty($top_phone)): ?>
    <span class="contact-item contact-mobile"><span class="contact-link"><a href="tel:<?php echo esc_attr($top_phone); ?>"><i class="fa fa-phone"></i> <?php echo esc_html($top_phone); ?></a></span></span>
    <?php endif;?>
    <?php $top_email = get_theme_mod('amazica_top_email');if (!empty($top_email)): ?>
    <span class="contact-item contact-email"><span class="contact-link"><a href="mailto:<?php echo esc_attr($top_email); ?>"><i class="fa fa-envelope"></i> <?php echo esc_html($top_email); ?></a></span></span>
    <?php endif;
}

function themefarmer_get_header_topbar(){
	if(get_theme_mod('themefarmer_header_topbar_enable', false)){
		?>
		<div class="header-topbar">
			<div class="container">
				<div class="row">
					<div class="col-md-6 text-small-center text-left"><?php amazica_get_contact_block(); ?></div>
					<div class="col-md-6 text-small-center text-right"><?php amazica_get_social_block(); ?></div>
				</div>
			</div>
		</div>
		<?php
	}
}
add_action('themefarmer_before_header_main', 'themefarmer_get_header_topbar');

function amazica_get_page_links_html() {
	if (amazica_is_wc()) {

		global $woocommerce;

		$myaccount_page_id = get_option('woocommerce_myaccount_page_id');
		$links = array();
		$account_link = '#';
		if ($myaccount_page_id) {
			$account_link = get_permalink($myaccount_page_id);
		}

		if (is_user_logged_in()) {
			$links['myaccount'] = $account_link;
		} else {
			$links['login'] = $account_link;
			$links['register'] = $account_link;
		}

		$links['cart'] = wc_get_cart_url();
		$links['checkout'] = wc_get_checkout_url();

		if (is_user_logged_in()) {
			$links['logout'] = wp_logout_url(esc_url(home_url('/')));

			if (get_option('woocommerce_force_ssl_checkout') == 'yes') {
				$links['logout'] = str_replace('http:', 'https:', $links['logout']);
			}
		}

		$links = apply_filters('amazica_page_links', $links);
		$lables = amazica_get_page_labels();
		$html = '';

		foreach ($links as $key => $link) {
			$html .= sprintf('<li><a class="top-bl-%1$s" href="%2$s"> %3$s </a></li>',
				esc_attr($key),
				esc_url($link),
				wp_kses_post($lables[$key])
			);
		}
		$html = '<ul class="account-links">' . $html . '</ul>';
		return $html;
	}
}

function amazica_get_page_labels() {
	$lables = array(
		'myaccount' => '<i class="fa fa-user"></i> ' . esc_html__('My Account', 'amazica'),
		'login' => '<i class="fa fa-sign-in"></i> ' . esc_html__('Login', 'amazica'),
		'register' => '<i class="fa fa-user-plus"></i> ' . esc_html__('Register', 'amazica'),
		'cart' => '<i class="fa fa-shopping-basket"></i> ' . esc_html__('Cart', 'amazica'),
		'checkout' => '<i class="fa fa-check-circle-o"></i> ' . esc_html__('Checkout', 'amazica'),
		'wishlist' => '<i class="fa fa-heart"></i> ' . esc_html__('Wishlist', 'amazica'),
		'logout' => '<i class="fa fa-sign-out"></i> ' . esc_html__('Logout', 'amazica'),
	);

	$lables = apply_filters('amazica_page_labels', $lables);
	return $lables;
}

function amazica_excerpt_more($more) {
	if (is_admin()) {
		return $more;
	}

	return '...';
}
add_filter('excerpt_more', 'amazica_excerpt_more');
function amazica_excerpt_length( $length ) {
        
    if (is_admin()) {
		return $length;
	}
	return 20;
}
add_filter( 'excerpt_length', 'amazica_excerpt_length', 999 );

function amazica_comment_form_fields($fields) {

	$fields['author'] = '<div class="form-group col-md-4 cmt-f"><label  for="name">' . esc_html__('NAME', 'amazica') . ':</label><input type="text" class="form-control" id="name" name="author" placeholder="' . esc_attr__('Full Name', 'amazica') . '"></div>';
	$fields['email'] = '<div class="form-group col-md-4"><label for="email">' . esc_html__('EMAIL', 'amazica') . ':</label><input type="email" class="form-control" id="email" name="email" placeholder="' . esc_attr__('Your Email Address', 'amazica') . '"></div>';
	$fields['url'] = '<div class="form-group col-md-4 cmt-l"><label  for="url">' . esc_html__('WEBSITE', 'amazica') . ':</label><input type="text" class="form-control" id="url" name="url" placeholder="' . esc_attr__('Website', 'amazica') . '"></div>';
	return $fields;
}
add_filter('comment_form_fields', 'amazica_comment_form_fields');

function amazica_comment_form_defaults($defaults){
	$defaults['submit_field'] = '<div class="form-group col-12">%1$s %2$s</div>';
	$defaults['comment_field'] = '<div class="form-group col-12"><label  for="message">' . esc_html__('COMMENT', 'amazica') . ':</label><textarea class="form-control" rows="5" id="comment" name="comment" placeholder="' . esc_attr__('Message', 'amazica') . '"></textarea></div>';
	$defaults['title_reply_to'] = esc_html__('Post Your Reply Here To %s', 'amazica');
	$defaults['class_submit'] = 'btn btn-theme';
	$defaults['label_submit'] = esc_html__('SUBMIT COMMENT', 'amazica');
	$defaults['title_reply'] = '<h3 class="post-comments">' . esc_html__('Leave A Comment', 'amazica') . '</h3>';
	$defaults['role_form'] = 'form';
	
	return $defaults;

}
add_filter('comment_form_defaults', 'amazica_comment_form_defaults');

function amazica_comment($comment, $args, $depth) {
	// get theme data.
	global $comment_data;
	// translations.
	$leave_reply = $comment_data['translation_reply_to_coment'] ? $comment_data['translation_reply_to_coment'] : __('Reply', 'amazica');?>
        <div class="row the-comment">
            <div class="col-2">
            <?php echo get_avatar($comment, $size = '80'); ?>
            </div>
            <div class="col-10">
                <div class="comment-items">
                    <h4 class="comment-item comment-author"><?php comment_author();?></h4>
                    <h5 class="comment-item comment-date">
                        <?php if (('d M  y') == get_option('date_format')): ?>
                        <?php comment_date('F j, Y');?>
                        <?php else: ?>
                        <?php comment_date();?>
                        <?php endif;?>
                        <?php esc_html_e('at', 'amazica');?>&nbsp;<?php comment_time('g:i a');?>
                    </h5>
                    <?php comment_reply_link(array_merge($args, array('reply_text' => $leave_reply, 'depth' => $depth, 'max_depth' => $args['max_depth'])))?>
                    <?php if ($comment->comment_approved == '0'): ?>
                    <em class="comment-item comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'amazica');?></em>
                    <?php endif;?>
                </div>
                <div class="comment-text"><?php comment_text();?></div>
            </div>
        </div>
        <?php
}

function amazica_get_standard_fonts() {
	return apply_filters(
		'themefarmer_standard_fonts_array', array(
			'Arial, Helvetica, sans-serif',
			'Arial Black, Gadget, sans-serif',
			'Bookman Old Style, serif',
			'Comic Sans MS, cursive',
			'Courier, monospace',
			'Georgia, serif',
			'Garamond, serif',
			'Impact, Charcoal, sans-serif',
			'Lucida Console, Monaco, monospace',
			'Lucida Sans Unicode, Lucida Grande, sans-serif',
			'MS Sans Serif, Geneva, sans-serif',
			'MS Serif, New York, sans-serif',
			'Palatino Linotype, Book Antiqua, Palatino, serif',
			'Tahoma, Geneva, sans-serif',
			'Times New Roman, Times, serif',
			'Trebuchet MS, Helvetica, sans-serif',
			'Verdana, Geneva, sans-serif',
			'Paratina Linotype',
			'Trebuchet MS',
		)
	);
}

function amazica_get_google_fonts() {
	return apply_filters('themefarmer_google_fonts_array',
		array('Lato', 'Work Sans', 'ABeeZee', 'Abel', 'Abhaya Libre', 'Abril Fatface', 'Alfa Slab One', 'Alice', 'Alike', 'Average', 'Average Sans', 'Averia Gruesa Libre', 'Averia Libre', 'Averia Sans Libre', 'Averia Serif Libre', 'Bad Script', 'Bahiana', 'Baloo', 'Baloo Bhai', 'Baloo Bhaijaan', 'Baloo Bhaina', 'Baloo Chettan', 'Baloo Da', 'Baloo Paaji', 'Baloo Tamma', 'Baloo Tammudu', 'Baloo Thambi', 'Balthazar', 'Black Ops One', 'Bokor', 'Bonbon', 'Boogaloo', 'Bowlby One', 'Bowlby One SC', 'Brawler', 'Bree Serif', 'Bubblegum Sans', 'Bubbler One', 'Buda', 'Buenard', 'Bungee', 'Bungee Hairline', 'Bungee Inline', 'Bungee Outline', 'Bungee Shade', 'Butcherman', 'Butterfly Kids', 'Cabin', 'Cabin Condensed', 'Coda', 'Cormorant SC', 'Cormorant Unicase', 'Cormorant Upright', 'Courgette', 'Cousine', 'Coustard', 'Covered By Your Grace', 'Crafty Girls', 'Creepster', 'Crete Round', 'Damion', 'Dancing Script', 'Dangrek', 'Diplomata', 'Diplomata SC', 'Domine', 'Donegal One', 'Doppio One', 'Dosis', 'EB Garamond', 'Englebert', 'Enriqueta', 'Erica One', 'Expletus Sans', 'Fondamento', 'Fontdiner Swanky', 'Forum', 'Francois One', 'Frank Ruhl Libre', 'Freckle Face', 'Fredericka the Great', 'Fredoka One', 'Freehand', 'Fresca', 'Frijole', 'Fruktur', 'Fugaz One', 'GFS Didot', 'GFS Neohellenic', 'Gabriela', 'Gafata', 'Galada', 'Galdeano', 'Galindo', 'Gentium Basic', 'Gentium Book Basic', 'Geo', 'Geostar', 'Geostar Fill', 'Germania One', 'Gidugu', 'Gilda Display', 'Give You Glory', 'Habibi', 'Halant', 'Hammersmith One', 'Hanalei', 'Hanalei Fill', 'Handlee', 'Hanuman', 'Happy Monkey', 'Harmattan', 'IBM Plex Mono', 'IBM Plex Sans', 'IBM Plex Sans Condensed', 'IBM Plex Serif', 'Istok Web', 'Italiana', 'Italianno', 'Itim', 'Jacques Francois', 'Jacques Francois Shadow', 'Jaldi', 'Jim Nightshade', 'Jockey One', 'Jolly Lodger', 'Jomhuria', 'Kumar One Outline', 'Kurale', 'La Belle Aurore', 'Laila', 'Lakki Reddy', 'Lalezar', 'Limelight', 'Linden Hill', 'Lobster', 'Lobster Two', 'Londrina Outline', 'Londrina Shadow', 'Londrina Sketch', 'Londrina Solid', 'Lora', 'Love Ya Like A Sister', 'Marcellus', 'Marcellus SC', 'Marck Script', 'Margarine', 'Marko One', 'Marmelad', 'Nova Cut', 'Nova Flat', 'Nova Mono', 'Nova Oval', 'Nova Round', 'Nova Script', 'Nova Slim', 'Nova Square', 'Numans', 'Nunito', 'Nunito Sans', 'Odor Mean Chey', 'Offside', 'Old Standard TT', 'Oldenburg', 'Oswald', 'Oleo Script', 'Oleo Script Swash Caps', 'Open Sans', 'Pangolin', 'Paprika', 'Parisienne', 'Passero One', 'Passion One', 'Pathway Gothic One', 'Playfair Display SC', 'Podkova', 'Poiret One', 'Poller One', 'Poly', 'Pompiere', 'Pontano Sans', 'Poppins', 'Port Lligat Sans', 'Port Lligat Slab', 'Pragati Narrow', 'Quattrocento Sans', 'Questrial', 'Quicksand', 'Quintessential', 'Qwigley', 'Racing Sans One', 'Roboto', 'Roboto Slab', 'Rochester', 'Rock Salt', 'Rokkitt', 'Romanesco', 'Ropa Sans', 'Rosario', 'Sarpanch', 'Satisfy', 'Scada', 'Scheherazade', 'Schoolbell', 'Amazica  One', 'Snippet', 'Snowburst One', 'Sofadi One', 'Sofia', 'Sonsie One', 'Sorts Mill Goudy', 'Suez One', 'Sumana', 'Sunshiney', 'Supermercado One', 'Sura', 'Suranna', 'Suravaram', 'Suwannaphum', 'Swanky and Moo Moo', 'Syncopate', 'Tangerine', 'Taprom', 'Ubuntu Condensed', 'Ubuntu Mono', 'Ultra', 'Uncial Antiqua', 'Underdog', 'Unica One', 'Voces', 'Volkhov', 'Vollkorn', 'Vollkorn SC', 'Voltaire', 'Waiting for the Sunrise', 'Yanone Kaffeesatz', 'Yantramanav', 'Yatra One', 'Yellowtail', 'Zeyada', 'Zilla Slab')
	);
}

function amazica_get_font_url($fonts = array()) {
	$default_body_font = apply_filters('amazica_default_body_font', 'Lato');
	$body_font = get_theme_mod('amazica_body_font_family', $default_body_font);
	if(empty($body_font)){
		$body_font = $default_body_font;
	}
	$body_font_weight = array(400,700,900);
	$fonts[$body_font] = $body_font_weight;
	$fonts = apply_filters('amazica_fonts', $fonts);

	if (empty($fonts)) {
		return;
	}

	$google_fonts = amazica_get_google_fonts();
	$font_families = array();
	if (!empty($google_fonts) && !empty($fonts)) {
		foreach ($fonts as $font => $weights) {
			if (in_array($font, $google_fonts)) {
				if (!empty($weights)) {
					$font_families[] = $font . ':' . implode(',', $weights);
				} else {
					$font_families[] = $font;
				}
			}
		}
	} else {
		return;
	}

	if (!empty($font_families)) {
		$query_args = array(
			'family' => urlencode(implode('|', $font_families)),
		);

		$fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');

		return esc_url_raw($fonts_url);
	}
	return;
}



function amazica_add_custom_styles() {
	$style = '';
	$default_body_font = apply_filters('amazica_default_body_font', 'Lato');
	$body_font_family = get_theme_mod('amazica_body_font_family', $default_body_font);
	$body_font_family = !empty($body_font_family) ? $body_font_family : 'Lato';
	$body_font_size = get_theme_mod('themefarmer_body_font_size', 10);
	if (is_array($body_font_size)) {
		$desk_fs = $body_font_size['desktop'] + 4;
		$tabl_fs = $body_font_size['tablet'];
		$mobl_fs = $body_font_size['mobile'];
	} else {
		$desk_fs = $body_font_size + 4;
	}

	$style .= "
        body{
            font-family:'{$body_font_family}', sans-serif;
            font-size:{$desk_fs}px !important;
        }
    ";
	$style = apply_filters('amazica_inline_style', $style);
	wp_add_inline_style('amazica-style', $style);
}
add_action('wp_enqueue_scripts', 'amazica_add_custom_styles', 31);

function amazica_blog_layout() {
	if (is_page_template()) {
		return;
	}

	if (is_page()) {
		$layout = get_theme_mod('amazica_blog_single_page_layout', 'full');
	} elseif (is_single()) {
		$layout = get_theme_mod('amazica_blog_single_post_layout', 'right');
	} else {
		$layout = get_theme_mod('amazica_blog_post_index_layout', 'right');
	}
	return amazica_get_layout_class($layout);
}

function amazica_woocommerce_layout(){
    $layout = 'left';
    if(amazica_is_wc()){
        if(is_shop()){
            $layout = get_theme_mod('amazica_wc_shop_page_layout', 'left');
        } elseif(is_product()){
            $layout = get_theme_mod('amazica_wc_product_single_layout', 'full');
        }
    }
    return amazica_get_layout_class($layout);
}


function amazica_get_layout_class($layout = 'right') {
	$class = 'col-md-9';
	switch ($layout) {
	case 'right':
		$class = 'col-md-9';
		break;
	case 'left':
		$class = 'col-md-9 order-last';
		break;
	case 'full':
		$class = 'col-md-12';
		break;
	default:
		$class = 'col-md-9';
		break;
	}
	return $class;
}

function amazica_home_sections_init() {
	$default_sections =  apply_filters('amazica_home_page_default_sections', array('slider', 'services', 'about', 'callout', 'products-latest', 'team', 'testimonials', 'brands',  'subscribe', 'blog',   'contact'));
	$home_sections = get_theme_mod('amazica_home_layout', $default_sections);
	$home_sections = apply_filters('amazica_home_page_sections', $home_sections);
	$priority = 30;
	foreach ($home_sections as $key => $section) {
		$section_name = str_replace('-', '_', $section);
		$section_name = str_replace(' ', '_', $section_name);
		if(get_theme_mod('amazica_is_enable_section_'.$section_name, true )){
			if (function_exists('amazica_homepage_section_' . $section_name)) {
				add_action('amazica_print_home_page_sections', 'amazica_homepage_section_' . $section_name, $priority);
			}
			elseif (function_exists('themefarmer_homepage_section_' . $section_name)) {
				add_action('amazica_print_home_page_sections', 'themefarmer_homepage_section_' . $section_name, $priority);
			}
		}
		$priority += 10;
	}
}
add_action('amazica_befor_print_home_page_sections', 'amazica_home_sections_init', 30);

function amazica_homepage_section_products_latest() {
	get_template_part('template-parts/home', 'products-latest');
}

function amazica_homepage_section_callout(){
	get_template_part('template-parts/home', 'callout');
}

function amazica_homepage_section_subscribe(){
	get_template_part('template-parts/home', 'subscribe');
}

function amazica_homepage_section_blog() {
	get_template_part('template-parts/home', 'blog');
}

function amazica_homepage_section_about() {
	get_template_part('template-parts/home', 'about');
}

function amazica_homepage_section_slider(){
	get_template_part('template-parts/home', 'slider');
}

function amazica_homepage_section_services(){
	get_template_part('template-parts/home', 'services');
}

function amazica_homepage_section_testimonials(){
	get_template_part('template-parts/home', 'testimonials');
}

function amazica_homepage_section_team(){
	get_template_part('template-parts/home', 'team');
}

function amazica_set_theme_primary_color($custom_css){
	$primary_color = get_theme_mod('amazica_theme_primary_color');
	if($primary_color == '#0186f0'){
		return;
	}

	if(!empty($primary_color)){
		$custom_css.= "
a,
a:hover,
a:focus {
    color: {$primary_color};
}

a,
a:hover,
a:focus {
    color: {$primary_color};
}

.btn-theme-border {
    border: 1px solid {$primary_color};
}
button,
input[type='button'],
input[type='reset'],
input[type='submit'] {
    background-color: {$primary_color};
}
.widget ul li:hover a,
.widget ul li:hover:before {
    color: {$primary_color};
}
.tagcloud a {
    border: 1px solid {$primary_color};
    background-color: {$primary_color};
}
.calendar_wrap caption {
    background-color: {$primary_color};
}
.widget-heading:before {
    border-bottom: 1px solid {$primary_color};
}
.pagination .page-numbers.current,
.pagination .page-numbers:hover {
    border-color: {$primary_color};
    color: {$primary_color};
}
.sweep-to-left:before {
    background: {$primary_color};
}
.sweep-to-right:before {
    background: {$primary_color};
}
.sweep-to-bottom:before {
    background: {$primary_color};
}
.sweep-to-top:before {
    background: {$primary_color};
}
.fill-to-top:before {
    background-color: {$primary_color};
}
.home-section .owl-next,
.home-section .owl-prev {
    background-color: {$primary_color};
}
.slider-heading {
    border-left: 6px solid {$primary_color}e0;
    border-right: 6px solid {$primary_color}e0;
    border-top: 6px solid {$primary_color}e0;

}
.slider-desc {
    background-color: {$primary_color}e0;
}
.home-slider .owl-prev,
.home-slider .owl-next {
    background-color: {$primary_color}6e;
    border-color: {$primary_color};
}
.slide-bt-2:hover {
    border-color: {$primary_color};
}
.service-item-inner {
    border-bottom: 2px solid {$primary_color};
}
.service-icon {
    border: 1px solid {$primary_color};
    color: {$primary_color};
}
.service-title {
    color: {$primary_color};
}

.service-icon:before {
    background-color: {$primary_color};
}
.meamber-info {
    background-color: {$primary_color}c2;
}
.member-designation {
    background-color: {$primary_color};
}

.testimonial-item-inner:hover .testimonial-img {
    border-color: {$primary_color};
}
.section-subscribe {
    background-color: {$primary_color};
}
.home-post-inner {
    border-bottom: 4px solid {$primary_color};
}

.post-qk-link:hover {
    border-color: {$primary_color};
}
.blog-avtar {
    border: 1px solid {$primary_color};
}
.sticky.post .content-index-inner {
    border-color: {$primary_color};
}

.sticky.post .content-index-inner .row.post-index-bottom {
    background-color: {$primary_color};
}
.amz-singuler .post-navigation .nav-links a {
    border: 1px solid {$primary_color};
}

.amz-singuler .post-navigation .nav-links a:hover {
    background-color: {$primary_color};
}
#scroll-top {
    background-color: {$primary_color}9c;
    border: 1px solid {$primary_color};
}
.button {
    background-color: {$primary_color};
}
.btn-read-more {
    font-size: 14px;
    border: 1px solid {$primary_color};
}
.calendar_wrap tfoot td:hover,
.calendar_wrap tfoot td:hover a,
.calendar_wrap tbody td:hover {
    color: {$primary_color};
}

.calendar_wrap td a:hover {
    color: {$primary_color};
}

#TF-Navbar > ul >li>a:before, .sticky-head #TF-Navbar > ul >li>a:before {
    background-color: {$primary_color};
}
.dropdown-item:focus, 
.dropdown-item:hover, 
.dropdown-item:active {
    color: {$primary_color};
}

@media (min-width: 768px) {
    #TF-Navbar > ul  .dropdown-menu {
        background-color: {$primary_color}de;
    }
    #TF-Navbar > ul .dropdown-menu > li:hover {
	    background-color: {$primary_color};
	}
}
span.onsale {
    background-color: {$primary_color};
}
.widget_price_filter .ui-slider .ui-slider-range {
    background: {$primary_color};
}
.widget_price_filter .ui-slider .ui-slider-handle {
    background: {$primary_color};
}
.woocommerce-error, .woocommerce-info, .woocommerce-message {
    border-top: 3px solid {$primary_color};
}";

}
	return $custom_css;
}
add_filter('amazica_inline_style', 'amazica_set_theme_primary_color', 30);
