<?php

if (!defined('ABSPATH')) exit;

// Redirect For Empty Pages
if( !function_exists('BaseRedirectHome') ){
	function BaseRedirectHome() {
		if(!is_admin() && is_404() ) {
			wp_redirect(home_url());
			exit();
		}
	}
	add_action('template_redirect', 'BaseRedirectHome');
}

// Unregister Scripts
if( !function_exists('BaseUnregisterScripts') ){
	function BaseUnregisterScripts(){
		wp_dequeue_script( 'wp-embed' );
	}
	if( is_front_page() || is_home() ){
		add_action( 'wp_footer', 'BaseUnregisterScripts' );
	}
}

// Undefined Index Check
if( ! function_exists('baseCheck') ){
    function baseCheck( $val, $default = '' ) {
		$value = ( isset($val) || !(empty($val)) ? $val : $default);
		return wp_kses_post( $value );
    }
}

// Translate
if( ! function_exists('baseLang') ){
    function baseLang( $ltr, $rtl ) {
		if(is_rtl()){
			return $rtl;
		}else{
			return $ltr;
		}
    }
}

// Translate Rtl
if( ! function_exists('baseLangRtl') ){
	function baseLangRtl( $rtl, $ltr ) {
		if(is_rtl()){
			return $rtl;
		}else{
			return $ltr;
		}
	}
}

// Get Theme Options
if( !function_exists('getOption')){
	function getOption( $en, $ar ){

		if( is_rtl() ){

			$val   = !(empty( $ar )) ? baseCheck(get_theme_mod( $ar, '')) : '';
			$value = ( $val || isset($val) || !(empty($val)) ? $val : '' );

		}else{

			$val   = !(empty( $en )) ? baseCheck(get_theme_mod( $en, '')) : '';
			$value = ( $val || isset($val) || !(empty($val)) ? $val : '' );

		}

		return wp_kses_post( $value );

	}
}

// Get Image Url
if( !function_exists('getImageUrl') ){
	function getImageUrl ( $option, $size = 'full' ) {

		$image = !(empty( $option )) ? get_theme_mod( $option, '') : '';

		if ( is_array( $image ) ){

			$imageOpt   = $image['id'];
			if( ! empty( $imageOpt ) ) {
				$attachment = wp_get_attachment_image_src( $imageOpt , $size );
				$url = $attachment[0];
			}else{
				$url = '';
			}

		}elseif( is_int($image) ){
			if( ! empty( $image ) ) {
				$attachment = wp_get_attachment_image_src( $image , $size );
				$url = $attachment[0];
			}else{
				$url = '';
			}
		}else{
			$url = $image;
		}

		return $url;
	}
}

// Social Media
if( ! function_exists( 'BaseSocialMedia' ) ){
    function BaseSocialMedia() {

		$options = get_option( 'baseOption' );
		$socials = $options['socials'];

        if( ! empty( $socials ) ) {
            echo '<ul class="list-unstyled base-footer-socials mb-5">';
            foreach ( $socials as $social ) {
                echo '
                    <li>
                        <a target="_blank" href="'.$social['social_url'].'">
                            <i class="'.$social['social_icon'].'"></i>
                        </a>
                    </li>
                ';
            }
            echo '</ul>';
		}

    }
}

// Wpml Lang Switcher
if( ! function_exists('BaseLangSwitcher' ) ){
    function BaseLangSwitcher($skip_missing = 0, $div_id = "langselector") {
        if (function_exists('icl_get_languages')) {
            $languages = icl_get_languages('skip_missing=' . intval($skip_missing));

            if (!empty($languages)) {
                foreach ($languages as $l) {
                    if (!$l['active']) {

                        echo '<li><a href="' . $l['url'] . '" data-ajaxify-url="true"> <span class="icon-lang"></span><span>';
                        if ($l['language_code'] == 'en') {
                            echo 'English';
                        } else {
                            echo 'العربية';
                        }
						echo '</span></a></li>';

                    }
                }
			}

        }
    }
}

// Aniamte
if(! function_exists('baseAnimate') ){
	function baseAnimate($value = '-'){

		if($value === '-'){
			$newVal = '';
		}else{
			$newVal = '-';
		}

		if(is_rtl()){
			echo $newVal;
		}else{
			echo $value;
		}

	}
}

// Customizer Link
if( ! function_exists('baseCustomizeBtn') ){
    function baseCustomizeBtn( $url = '' ) {

		global $wp_customize;

		if ( ! current_user_can( 'customize' ) || is_admin() ) {
			return;
		}

		if ( is_customize_preview() && $wp_customize->changeset_post_id() && ! current_user_can( get_post_type_object( 'customize_changeset' )->cap->edit_post, $wp_customize->changeset_post_id() ) ) {
			return;
		}

		$current_url = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		if ( is_customize_preview() && $wp_customize->changeset_uuid() ) {
			$current_url = remove_query_arg( 'customize_changeset_uuid', $current_url );
		}

		$customize_url = add_query_arg( 'url', urlencode( $current_url ), wp_customize_url() );
		if ( is_customize_preview() ) {
			$customize_url = add_query_arg( array( 'changeset_uuid' => $wp_customize->changeset_uuid() ), $customize_url );
		}

		$val = $customize_url;
		//'customize.php?autofocus[section]='.$url;

		?>
			<a class="theCustomizer" href="<?php echo $val; ?>">
				<i> <?php echo BaseGetIconSvg('cog', 20); ?> </i>
			</a>
		<?php

    }
}



add_filter( 'wp_title', function ( $title, $sep, $seplocation ) {

    if ( is_tax() ) {

        $term_title = single_term_title( '', false );
        if ( 'right' == $seplocation ) {
            $title = $term_title . " $sep ";
        } else {
            $title = " $sep " . $term_title;
		}

    }
	return $title;

}, 10, 3 );

// Thumbnail
if( ! function_exists( 'BaseThumb' ) ) {
	function BaseThumb($size){
		ob_start();

		$id = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
		if ( has_post_thumbnail() && ! empty( $id ) ) {
			?>
				<img alt="<?php echo get_the_title( get_the_ID() )?>" data-src="<?php the_post_thumbnail_url($size); ?>">
			<?php
		}else{
			?>
			<div class="re-image-notFound">
				<img class="is-hidden-image" alt="" data-src="">
				<?php echo BaseGetIconSvg('crack', 50); ?>
			</div>
			<?php
		}

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
}

// Date
if( ! function_exists( 'BaseDate' ) ) {
    function BaseDate(){
		ob_start();

		// November 10, 2020
		echo get_the_date(' F j, Y ');
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
}

// Excerpt
if( ! function_exists( 'BaseExcerpt' ) ){
    function BaseExcerpt($num , $dots = false ) {

		if( $num  !== false ){
			$limit = $num + 1;
			$excerpt = explode(' ', get_the_excerpt(get_the_ID()), $limit);
			array_pop( $excerpt );
			$excerpt = implode(" ",$excerpt);
			if( $dots === true ){
				$getExcerpt = $excerpt;
			}else{
				$getExcerpt = $excerpt;
			}
		}else{
			$getExcerpt = get_the_excerpt(get_the_ID());
		}
		echo $getExcerpt;

    }
}

// Svg Icons
if (!function_exists('baseGetIconSvg')) {
	function baseGetIconSvg( $icon, $width = 20, $height = 'unset'){
		if( baseSvgIcons::getSvg('icons', $icon, $width, $height )){
			return baseSvgIcons::getSvg('icons', $icon, $width, $height );
		}else{
			return '';
		}
	}
}

// Author
if( ! function_exists( 'BaseGetAuthor' ) ){
    function BaseGetAuthor() {
		ob_start();
		?>
			<p class="card-author">
				<span>
					كتب بواسطة
				</span>
				<?php  the_author(); ?>
			</p>
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
    }
}

// Limit Words
if (!function_exists('limit_words')) {
	function limit_words($string, $word_limit)
	{
		$words = explode(" ", $string);
		return implode(" ", array_splice($words, 0, $word_limit)) . '...';
	}
}

// Gravity Forms
if (class_exists('GFAPI') && !function_exists('baseGvFormsArr') ) {
	function baseGvFormsArr()
	{
		$forms = GFAPI::get_forms();
		$list  = [];
		foreach ($forms as $form) {
			$list[$form['title']] = $form['id'];
		}
		return $list;
	}
}

// Get Query Vc
if (!function_exists('baseQueryVc')) {
	function baseQueryVc($loop)
	{
		$args = [];

		$query_post_type = $query_posts_per_page = $query_orderby = $query_order = $paged = $query_by_id_in = $query_by_id_not_in = $query_cat_in = $query_cat_not_in = $query_tags_in = $query_tags_not_in = $query_author_in = $query_author_not_in = $query_tax_query = '';

		$query = explode('|', $loop);

		foreach ($query as $query_part) {
			$q_part = explode(':', $query_part);
			switch ($q_part[0]) {

				case 'post_type':
					$query_post_type = explode(',', $q_part[1]);
					break;

				case 'size':
					$query_posts_per_page = ($q_part[1] == 'All' ? -1 : $q_part[1]);
					break;

				case 'order_by':

					$query_meta_key = '';
					$query_orderby = '';

					$public_orders_array = array('ID', 'date', 'author', 'title', 'modified', 'rand', 'comment_count', 'menu_order');
					if (in_array($q_part[1], $public_orders_array)) {
						$query_orderby = $q_part[1];
					} else {
						$query_meta_key = $q_part[1];
						$query_orderby = 'meta_value_num';
					}

					break;

				case 'order':
					$query_order = $q_part[1];
					break;

				case 'by_id':
					$query_by_id = explode(',', $q_part[1]);
					$query_by_id_not_in = array();
					$query_by_id_in = array();
					foreach ($query_by_id as $ids) {
						if ($ids < 0) {
							$query_by_id_not_in[] = $ids;
						} else {
							$query_by_id_in[] = $ids;
						}
					}
					break;

				case 'categories':
					$query_categories = explode(',', $q_part[1]);
					$query_cat_not_in = array();
					$query_cat_in = array();
					foreach ($query_categories as $cat) {
						if ($cat < 0) {
							$query_cat_not_in[] = $cat;
						} else {
							$query_cat_in[] = $cat;
						}
					}
					break;

				case 'tags':
					$query_tags = explode(',', $q_part[1]);
					$query_tags_not_in = array();
					$query_tags_in = array();
					foreach ($query_tags as $tags) {
						if ($tags < 0) {
							$query_tags_not_in[] = $tags;
						} else {
							$query_tags_in[] = $tags;
						}
					}
					break;

				case 'authors':
					$query_author = explode(',', $q_part[1]);
					$query_author_not_in = array();
					$query_author_in = array();
					foreach ($query_author as $author) {
						if ($tags < 0) {
							$query_author_not_in[] = $author;
						} else {
							$query_author_in[] = $author;
						}
					}

					break;

				case 'tax_query':
					$all_tax = get_object_taxonomies($query_post_type);

					$tax_query = array();
					$query_tax_query = array('relation' => 'AND');
					foreach ($all_tax as $tax) {
						$values = $tax;
						$query_taxs_in = array();
						$query_taxs_not_in = array();

						$query_taxs = explode(',', $q_part[1]);
						foreach ($query_taxs as $taxs) {
							if (term_exists(absint($taxs), $tax)) {
								if ($taxs < 0) {
									$query_taxs_not_in[] = absint($taxs);
								} else {
									$query_taxs_in[] = $taxs;
								}
							}
						}
						if (count($query_taxs_not_in) > 0) {
							$query_tax_query[] = array(
								'taxonomy' => $tax,
								'field' => 'id',
								'terms' => $query_taxs_not_in,
								'operator' => 'NOT IN',
							);
						} else if (count($query_taxs_in) > 0) {
							$query_tax_query[] = array(
								'taxonomy' => $tax,
								'field' => 'id',
								'terms' => $query_taxs_in,
								'operator' => 'IN',
							);
						}
					}
					break;
			}
		}

		$args = array(
			'post_type' => $query_post_type,
			'post_status' => 'publish',
			'posts_per_page' => $query_posts_per_page,
			'orderby' => $query_orderby,
			'order' => $query_order,
			'paged' => $paged,
			'post__in' => $query_by_id_in,
			'post__not_in' => $query_by_id_not_in,
			'category__in' => $query_cat_in,
			'category__not_in' => $query_cat_not_in,
			'tag__in' => $query_tags_in,
			'tag__not_in' => $query_tags_not_in,
			'author__in' => $query_author_in,
			'author__not_in' => $query_author_not_in,
			'tax_query' => $query_tax_query
		);

		return $args;
	}
}

// Get Query Number
if (!function_exists('baseQueryVcNum')) {
	function baseQueryVcNum($loop)
	{

		$query = explode('|', $loop);

		foreach ($query as $query_part) {
			$q_part = explode(':', $query_part);
			switch ($q_part[0]) {

				case 'size':
					$query_posts_per_page = ($q_part[1] == 'All' ? -1 : $q_part[1]);
					break;

			}
		}

		return $query_posts_per_page;
	}
}

// Get Query Type
if (!function_exists('baseQueryVcType')) {
	function baseQueryVcType($loop)
	{

		$query = explode('|', $loop);

		foreach ($query as $query_part) {
			$q_part = explode(':', $query_part);
			switch ($q_part[0]) {

				case 'post_type':
					$query_post_type = explode(',', $q_part[1]);
					break;

			}
		}

		return $query_post_type;
	}
}

// Get Views
if (!function_exists('BaseGetViews')) {
	function BaseGetViews($id)
	{
		$key = 'views';
		$count = get_post_meta($id, $key, true);
		if ($count == '') {
			delete_post_meta($id, $key);
			add_post_meta($id, $key, '0');
			$view = 1;
			return $view;
		}
		return (int)$count;
	}
}

// Set Views
if (!function_exists('BaseSetViews')) {
	function BaseSetViews($id)
	{
		session_start();
		$key = 'views';
		$count = get_post_meta($id, $key, true);
		if ($count == '') {
			$count = 0;
			delete_post_meta($id, $key);
			add_post_meta($id, $key, '0');
		} else {
			if (!isset($_SESSION['views-' . $id])) {
				$_SESSION['views-' . $id] = "si";
				$count++;
				update_post_meta($id, $key, $count);
			}
		}
	}
}

// Favicons
if (!function_exists('BaseGetFavicons')) {
	function BaseGetFavicons(){
		ob_start();
		?>
			<link rel="apple-touch-icon" sizes="180x180" href="<?php echo THIMG . 'favicon'?>/apple-touch-icon.png">
			<link rel="icon" type="image/x-icon" href="<?php echo THIMG . 'favicon'?>/favicon.ico">
			<link rel="icon" type="image/png" sizes="32x32" href="<?php echo THIMG . 'favicon'?>/favicon-32x32.png">
			<link rel="icon" type="image/png" sizes="16x16" href="<?php echo THIMG . 'favicon'?>/favicon-16x16.png">
			<link rel="manifest" href="<?php echo THIMG . 'favicon'?>/site.webmanifest">
			<link rel="mask-icon" href="<?php echo THIMG . 'favicon'?>/safari-pinned-tab.svg" color="#75be60">
			<meta name="msapplication-TileColor" content="#75be60">
			<meta name="theme-color" content="#ffffff">
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
}

// Title
if(!function_exists('BaseGetTitle')){
	function BaseGetTitle(){
		if(is_front_page() || is_home()){
			if( !empty( get_bloginfo('description') ) ){
				$dec = esc_html(' | ').get_bloginfo('description');
				echo NAME.$dec;
			}else{
				echo NAME;
			}
		} else{
			wp_title('');
		}
	}
}

// Meta Graph
if (!function_exists('BaseMetaGraph')) {
	function BaseMetaGraph(){
		ob_start();

		$id       = get_the_ID();
		$url      = get_the_permalink($id);
		$title    = get_the_title($id);
		$excerpt  = '';
		if (has_excerpt($id)) {
			$excerpt = wp_strip_all_tags(get_the_excerpt($id));
		}
		$site_name = NAME;
		$name = NAME;
		$image = get_the_post_thumbnail_url($id, 'full');
		if( !empty( get_post_meta( $id, 'og_image', true) ) ){
			$image = get_post_meta( $id, 'og_image', true );
		}

		if( is_singular() ) {
			$author = get_the_author();
		}else{
			$author = NAME;
		}

		$locale = get_locale();
		if( is_singular() ) {
		?>
		<meta property="og:locale" content="<?php echo baseCheck( esc_attr($locale), ''); ?>" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="<?php echo baseCheck(esc_attr(get_the_title($id)), ''); ?>" />
		<meta property="og:description" content="<?php echo baseCheck(BaseExcerpt(30,true), ''); ?>" />
		<meta property="og:url" content="<?php echo baseCheck(esc_url($url), ''); ?>" />
		<meta property="og:site_name" content="<?php echo baseCheck(esc_attr($site_name), ''); ?>" />
		<?php if($image){ ?>
		<meta property="og:image" content="<?php echo baseCheck(esc_url($image), ''); ?>" />
		<?php } ?>
		<meta name="twitter:card" content="<?php echo baseCheck(BaseExcerpt(30,true), ''); ?>" />
		<meta name="twitter:site" content="@<?php echo baseCheck($name, ''); ?>" />
		<meta name="twitter:creator" content="@<?php echo get_the_author(); ?>" />
		<?php }else{ ?>

		<meta property="og:locale" content="<?php echo baseCheck( esc_attr($locale), ''); ?>" />
		<meta property="og:title" content="<?php echo baseCheck(NAME, ''); ?>" />
		<meta property="og:description" content="<?php echo baseCheck(get_bloginfo('description'), ''); ?>" />
		<meta property="og:url" content="<?php echo baseCheck(esc_url(get_page_link($id)), ''); ?>" />
		<meta property="og:site_name" content="<?php echo baseCheck(NAME, ''); ?>" />
		<?php if($image){ ?>
		<meta property="og:image" content="<?php echo baseCheck(esc_url($image), ''); ?>" />
		<?php } ?>
		<meta name="twitter:card" content="<?php echo baseCheck(get_bloginfo('description'), ''); ?>" />
		<meta name="twitter:site" content="@<?php echo baseCheck($name, ''); ?>" />
		<meta name="twitter:creator" content="@<?php echo baseCheck($author, ''); ?>" />

		<?php } ?>
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
}

// All Categories
if( !function_exists('BaseGetCategories') ){
	function BaseGetCategories(){

		if( defined( 'ICL_LANGUAGE_CODE' ) ) {

			global $sitepress;

			$current_lang = $sitepress->get_current_language();
			$default_lang = $sitepress->get_default_language();

			$sitepress->switch_lang($default_lang);

			$categories = array();
			$cats = get_categories(array(
				'hide_empty' => 0,
			));

			$sitepress->switch_lang($current_lang);

		}else{

			$categories = array();
			$cats = get_categories(array(
				'hide_empty' => 0,
			));

		}

		foreach ($cats as $cat) {
			$categories += [ $cat->term_id => $cat->name ];
		}

		return $categories;

	}
}

// All Pages
if( !function_exists('BaseGetPages') ){
	function BaseGetPages(){

		if( defined( 'ICL_LANGUAGE_CODE' ) ) {

			// global $sitepress;
			// $current_lang = $sitepress->get_current_language();
			// $default_lang = $sitepress->get_default_language();
			// $sitepress->switch_lang($default_lang);
			// $sitepress->switch_lang($current_lang);

			$pages_array = array( 'Choose A Page' );
			$get_pages   = get_pages( 'hide_empty=0' );

		}else{

			$pages_array = array( 'Choose A Page' );
			$get_pages   = get_pages( 'hide_empty=0' );

		}

		foreach ( $get_pages as $page ) {
			$pages_array[$page->ID] = esc_attr( $page->post_title );
		}

		return $pages_array;

	}
}

// Menu Name
if( !function_exists('BaseMenuNameByLocation') ){
	function BaseMenuNameByLocation( $location ) {
		if( empty($location) ) return false;

		$locations = get_nav_menu_locations();
		if( ! isset( $locations[$location] ) ) return false;

		$menu_obj = get_term( $locations[$location], 'nav_menu' );

		return $menu_obj;
	}
}

// Vc Frontend Check
if( !function_exists('is_vc_build') ){
	function is_vc_build() {
		return function_exists( 'vc_is_inline' ) && vc_is_inline() ? true : false;
	}
}

// Check if WooCommerce is activated
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {

		if ( class_exists( 'woocommerce' ) ) {

			$active_plugins = (array) get_option('active_plugins', array());
			if(is_multisite()){
				$active_plugins = array_merge($active_plugins, get_site_option('active_sitewide_plugins', array()));
			}

			return in_array('woocommerce/woocommerce.php', $active_plugins) || array_key_exists('woocommerce/woocommerce.php', $active_plugins) || class_exists('WooCommerce');

		}else{
			return false;
		}

	}
}


// Get Image Url
if( !function_exists('baseGetImageUrl') ){
	function baseGetImageUrl ( $image ) {
		if ( is_array( $image ) ){

			$imageOpt   = $image['id'];
			if( ! empty( $imageOpt ) ) {
				$attachment = wp_get_attachment_image_src( $imageOpt ,'full' );
				$url = $attachment[0];
			}else{
				$url = '';
			}

		}elseif( is_int($image) ){
			if( ! empty( $image ) ) {
				$attachment = wp_get_attachment_image_src( $image ,'full' );
				$url = $attachment[0];
			}else{
				$url = '';
			}
		}else{
			$url   = $image;
		}

		return $url;
	}
}

// Get Link
if( !function_exists('baseGetLink') ){
	function baseGetLink ( $slug ) {

		if( !empty($slug) ){
			if(is_rtl()){
				$slug = $slug.'Ar';
				$link = baseCheck(get_theme_mod( $slug, ''));
			}else{
				$link = baseCheck(get_theme_mod( $slug, ''));
			}
		}else{
			$link = '';
		}

		return $link;

	}
}

// Related Posts
if( ! function_exists('BaseRelatedPosts' ) ){
    function BaseRelatedPosts($id, $type)
    {

		if( $type === "event" ){
		}elseif( $type == "course" ){

			global $post;

			$allCategories  = [];
			$categories     = get_the_category($post->ID);

			if ( ! empty( $categories ) ) {
				foreach( $categories as $categoryOne ) {
					$category = (int)($categoryOne->cat_ID);
					array_push( $allCategories, $category );
				}
			}

			$args = array(
				'post_type' => 'post',
				'cat' => $newsCat,
				'posts_per_page' => 5,
				'post__not_in' => array($id),
				'ignore_sticky_posts' => 1
			);

			$query = new WP_Query($args);
			if ($query->have_posts()) {
				?>
					<?php
						$query = new WP_Query( $args );

						if ( $query->have_posts() ) {
							while ( $query->have_posts() ) {
								$query->the_post();
							}
						}

						wp_reset_postdata();
					?>
				<?php
			}
			wp_reset_postdata();

		}elseif( $type == "post" ){

			global $post;

			$allCategories  = [];
			$categories     = get_the_category($post->ID);

			if ( ! empty( $categories ) ) {
				foreach( $categories as $categoryOne ) {
					$category = (int)($categoryOne->cat_ID);
					array_push( $allCategories, $category );
				}
			}

			$args = array(
				'post_type' => 'post',
				'category__in' => $allCategories,
				'posts_per_page' => 3,
				'post__not_in' => array($id),
				'ignore_sticky_posts' => 1
			);

			$query = new WP_Query($args);
			if ($query->have_posts()) {

			}
			wp_reset_postdata();

		}

    }
}

// Get Posts
if( !function_exists('baseGetPostsView') ){
	function baseGetPostsView ( $type, $query ) {
		ob_start();

		if( !empty($type) ){

			if( $type[0] === 'sfwd-courses' ){
				?>
					<div class="col-sm-6 mb-col">
						<?php get_template_part('template-parts/card/template', 'course'); ?>
					</div>
				<?php
			} elseif( $type[0] === 'solution' ){
				?>
					<?php
						if( 3 == $query->current_post || 4 == $query->current_post){
							?>
							<div class="col-sm-6 mb-col sal-animate colored-card" data-sal="slide-up" data-sal-delay="200" data-sal-duration="500" data-sal-easing="ease-out-back">
							<?php
						}else{
							?>
							<div class="col-lg-4 col-sm-6 mb-col colored-card" data-sal="slide-up" data-sal-delay="200" data-sal-duration="500" data-sal-easing="ease-out-back">
							<?php
						}
					?>

						<?php get_template_part('template-parts/card/template', 'solution'); ?>
					</div>
				<?php
			} elseif( $type[0] === 'career' ){
				get_template_part('template-parts/card/template','career');
			}else{
				?>
					<div class="col-sm-6 mb-col" data-sal="slide-up" data-sal-delay="250" data-sal-duration="500" data-sal-easing="ease-out-back">
						<?php get_template_part('template-parts/card/template', 'default'); ?>
					</div>
				<?php
			}

		}else{
			?>
				<div class="col-sm-6 mb-col" data-sal="slide-up" data-sal-delay="250" data-sal-duration="500" data-sal-easing="ease-out-back">
					<?php get_template_part('template-parts/card/template', 'default'); ?>
                </div>
			<?php
		}

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
}


// Get Avatar
if (!function_exists('baseGetAvatar')) {
	function baseGetAvatar(){

		$current_user = wp_get_current_user();
		// $url          = get_avatar_url($current_user->ID, ['size' => '100']);
		$imgId        = carbon_get_user_meta( $current_user->ID, 're_user_profile' );
		$attachment   = wp_get_attachment_image_src( $imgId  );

		if( !empty($attachment[0]) ){

			if ( $current_user && ($current_user instanceof WP_User)) {
				?>
					<img src="<?php echo $attachment[0]; ?>" alt="<?php echo baseGetAvatarDefault();?>">
				<?php
			}

		}else{

			if ( $current_user && ($current_user instanceof WP_User)) {

				if ( !empty($current_user->user_firstname) && !empty($current_user->user_lastname) ) {

			?>

				<p class="avatar-name">
					<?php echo substr($current_user->user_firstname, 0, 1).substr($current_user->user_lastname, 0, 1); ?>
				</p>

			<?php
				} else {
			?>

				<p class="avatar-name">
					<?php echo substr($current_user->display_name, 0, 2); ?>
				</p>

			<?php
				}
			}

		}

	}
}

// https://wordpress.org/support/topic/override-get_avatar_url/

//https://codepen.io/slyka85/pen/QvBQPb

if (!function_exists('baseGetAvatarDefault')) {
	function baseGetAvatarDefault(){

		$current_user = wp_get_current_user();
		if (($current_user instanceof WP_User)) {

			$imgId        = carbon_get_user_meta( $current_user->ID, 're_user_profile' );
			$attachment   = wp_get_attachment_image_src( $imgId  );

			if( $attachment[0] ){

				$data = $attachment[0];

			}else{
				if ( !empty($current_user->user_firstname) && !empty($current_user->user_lastname) ) {

					$data = substr($current_user->user_firstname, 0, 1) . substr($current_user->user_lastname, 0, 1);

				} else {

					$data = substr($current_user->display_name, 0, 2);

				}
			}



		}

		return $data;
		// --------------

	}
}

if (!function_exists('baseGetAvatarName')) {
	function baseGetAvatarName(){

		$current_user = wp_get_current_user();
		if (($current_user instanceof WP_User)) {

			if ( !empty($current_user->user_firstname) && !empty($current_user->user_lastname) ) {

				$data = $current_user->user_firstname. ' '.$current_user->user_lastname;

			} else {

				$data = $current_user->display_name;

			}

		}

		return $data;
		// --------------

	}
}

// Get governorates
if (!function_exists('baseGetGovernorates')) {
	function baseGetGovernorates( $url ){

		$request       = wp_remote_get( $url );

		if( is_wp_error( $request ) ) {
			return false;
		}

		$body           = wp_remote_retrieve_body( $request );
		$data           = json_decode( $body, true );

		return $data;

	}
}



add_filter( 'get_the_archive_title', function ($title) {
	if ( is_category() ) {
	$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
	$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
	$title = '<span class="vcard">' . get_the_author() . '</span>' ;
	}

	return $title;
   });


