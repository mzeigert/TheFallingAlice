<!DOCTYPE html>
<html <?php language_attributes('html'); ?>>
<head>

    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="alternate" hreflang="de-de" href="<?php echo esc_url(home_url()) ?>">

    <title><?php wp_title('|', true, 'right'); ?></title>
    <?php
    if (is_singular()) wp_enqueue_script('comment-reply');
    wp_head();
    ?>
    <link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri() ?>/touch-icon-iphone.png"/>
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_stylesheet_directory_uri() ?>/touch-icon-ipad.png"/>
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_stylesheet_directory_uri() ?>/touch-icon-iphone-retina.png"/>
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_stylesheet_directory_uri() ?>/touch-icon-ipad-retina.png"/>
    <link rel="apple-touch-icon" sizes="167x167" href="<?php echo get_stylesheet_directory_uri() ?>/touch-icon-ipad-pro.png"/>
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri() ?>/touch-icon-iphone-retina-3x.png"/>
</head>
<body <?php body_class($class); ?> >
<header class="nav-bar">
    <div class="header-navigation fluid-container">
        <div class="nav-header">
            <button class="menu-button pull-left">
                <span class="button-bar"></span>
                <span class="button-bar"></span>
                <span class="button-bar"></span>
            </button>
            <a class='logo' href="<?php echo esc_url(home_url()) ?>"><span class="helper"></span><img class="align-middle" src="<?php echo get_stylesheet_directory_uri() ?>/images/thefallingalice_logo_blog.png" alt="<?php  bloginfo('name')?>"></a>
        </div>
        <div class="nav-content">
            <div class="social-container">
                <a class="social-link facebook" href="https://www.facebook.com/pages/TheFallingAlice/236140569766034" target="_blank" rel="noopener"><span class="sr-only">Facebook</span></a>
                <a class="social-link youtube" href="https://www.youtube.com/channel/UCbX21szpqh_gMMM2HQE4xwg" target="_blank" rel="noopener"><span class="sr-only">Youtube</span></a>
                <a class="social-link instagram" href="http://instagram.com/thefallingalice/" target="_blank" rel="noopener"><span class="sr-only">Instagram</span></a>
            </div>
            <?php if (is_active_sidebar('sidebar-header')) : ?>
                <div class="sidebar">
                    <?php dynamic_sidebar('sidebar-header'); ?>
                </div>
            <?php endif; ?>
            <div class="menu-container">
                <?php wp_nav_menu(array(
	                'theme_location' => 'header-menu',
                    'container' => false,
                    'link_before' => '<div class="link-wrapper">',
                    'link_after' => '<span class="arrow"></span></div>')); ?>
            </div>

        </div>
    </div>
</header>