<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title> <?php global $page, $paged; wp_title('|', true, 'right'); bloginfo('name'); ?> </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="author" content="hunters.co.jp"/>
<?php
if (is_singular()):
global $post;
setup_postdata($post);
?>
<meta name="description" content="<?php the_excerpt_rss(); ?>" />
<?php endif; ?>
<?php
if (is_singular()):
global $post;
setup_postdata($post);
?>
<?php endif; ?>
<link rel="icon" href="http://hunters.co.jp/favicon.ico" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_head();?>
</head>
<body <?php body_class(); ?>>
<div id="wrapper">
	<div id="header">
		<div id="logo">
			<a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>" id="logos">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>" width="220" height="auto"/>
				<span><?php $blog_title = get_bloginfo(); ?></span>
			</a>
		</div>
		<div id="nav">
				<?php $walker = new Menu_With_Description; ?>
				<?php
				wp_nav_menu(array(
						'theme_location'	=> 'Main-menu',
						'container'			=> '',
						'menu_id'			=> 'nav-menu',
						'fallback_cb'		=> 'default_main_menu',
						'depth'				=> '5',
						'walker' => $walker
					));?>
			</div>
	</div>
	