<?php
if ( ! isset( $content_width ) )
add_theme_support('post-thumbnails');
add_theme_support( 'automatic-feed-links' );
add_theme_support('menus');
add_filter('widget_text', 'do_shortcode');
register_nav_menus(array(
	'Main-menu'	=>'Main menu'
));
$headxs = array(
	'width'         => 980,
	'height'        => 175,
	'default-image' => get_template_directory_uri() . '/images/header.png',
	'uploads'       => true,
);
add_theme_support( 'custom-header', $headxs );
if(!function_exists('defalut_menu')):
	function default_menu(){ ?>
		<ul class="main-menu">
				<?php wp_list_pages('title_li='); ?>
		</ul>
	<?php };
	do_action('default_menu');
endif;
function hunters_widget(){
	register_sidebar(array(
		'name' => 'sidebar',
		'id' => 'sidebar',
		'before_title' => '<div class="boxes-title"><h2>',
		'after_title' => '</h2></div>',
		'before_widget' => '<div class=\'boxes\'>',
		'after_widget' => '</div>'
	));		
	register_sidebar(array(		
		'name' => 'search',		
		'id' => 'search',		
		'before_title' => '<div class="boxes-title"><h2>',		
		'after_title' => '</h2></div>',		
		'before_widget' => '<div class=\'boxes\'>',		
		'after_widget' => '</div>'	));		
	register_sidebar(array(
		'name' => 'ab-footer-hunters',
		'id' => 'ab-footer-hunters',
		'before_title' => '<div class="boxes-title"><h2>',
		'after_title' => '</h2></div>',
		'before_widget' => '',
		'after_widget' => ''
	));
	register_sidebar(array(
		'name' => 'bl-footer-hunters',
		'id' => 'bl-footer-hunters',
		'before_title' => '<div class="boxes-title"><h2>',
		'after_title' => '</h2></div>',
		'before_widget' => '<div class="footer-content">',
		'after_widget' => '</div>'
	));
};
add_action('widgets_init','hunters_widget');
function new_excerpt_more($more) {
	//global $post;
	return 'もっと読む...';
};
add_filter('excerpt_more', 'new_excerpt_more');
function custom_excerpt_length( $length )
 {	return 110;}
 add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


function dimox_breadcrumbs() {
 
	$delimiter = '&raquo;';
	$home = 'Home';
	$before = '<span class="current">'; 
	$after = '</span>'; 
 
	if ( !is_home() && !is_front_page() || is_paged() ) {
 
		echo '<div id="crumbs">';
 
		global $post;
		$homeLink = home_url();
		echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
 
		if ( is_category() ) {
			global $wp_query;
			$cat_obj = $wp_query->get_queried_object();
			$thisCat = $cat_obj->term_id;
			$thisCat = get_category($thisCat);
			$parentCat = get_category($thisCat->parent);
			if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
			echo $before . '' . single_cat_title('', false) . '' . $after;
			 
		} elseif ( is_day() ) {
			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('d') . $after;
			 
		} elseif ( is_month() ) {
			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('F') . $after;
 
	} elseif ( is_year() ) {
		echo $before . get_the_time('Y') . $after;
 
	} elseif ( is_single() && !is_attachment() ) {
	 if ( get_post_type() != 'post' ) {
	 $post_type = get_post_type_object(get_post_type());
	 $slug = $post_type->rewrite;
	 echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
	 echo $before . get_the_title() . $after;
	 } else {
	 $cat = get_the_category(); $cat = $cat[0];
	 echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
	 echo $before . get_the_title() . $after;
	 }
 
	 } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
	 $post_type = get_post_type_object(get_post_type());
	 echo $before . $post_type->labels->singular_name . $after;
	 
	 } elseif ( is_attachment() ) {
	 $parent = get_post($post->post_parent);
	 $cat = get_the_category($parent->ID); $cat = $cat[0];
	 echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
	 echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
	 echo $before . get_the_title() . $after;
	 
	 } elseif ( is_page() && !$post->post_parent ) {
	 echo $before . get_the_title() . $after;
	 
	 } elseif ( is_page() && $post->post_parent ) {
	 $parent_id = $post->post_parent;
	 $breadcrumbs = array();
	 while ($parent_id) {
	 $page = get_page($parent_id);
	 $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
	 $parent_id = $page->post_parent;
	 }
	 $breadcrumbs = array_reverse($breadcrumbs);
	 foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
	 echo $before . get_the_title() . $after;
	 
	 } elseif ( is_search() ) {
	 echo $before . 'Search results for "' . get_search_query() . '"' . $after;
	 
	 } elseif ( is_tag() ) {
	 echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
	 
	 } elseif ( is_author() ) {
	 global $author;
	 $userdata = get_userdata($author);
	 echo $before . 'Articles posted by ' . $userdata->display_name . $after;
	 
	 } elseif ( is_404() ) {
	 echo $before . 'Error 404' . $after;
	 }
	 
	 if ( get_query_var('paged') ) {
	 if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
	 echo __('Page') . ' ' . get_query_var('paged');
	 if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
	 }
	 
	 echo '</div>';
	 
	}
}; // end dimox_breadcrumbs()

class Menu_With_Description extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth, $args) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		
		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '<br /><span class="sub">' . $item->description . '</span>';
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

?>