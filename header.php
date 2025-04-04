<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>

    <!-- Favicon -->
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/images/apple-touch-icon.png">

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header>
    <div class="container">
        <div class="logo">
            <h1>BetTips<span>Pro</span></h1>
        </div>
        <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-expanded="false">
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
        </button>
        <!-- Desktop Navigation -->
        <nav class="desktop-nav">
            <ul>
                <li><a href="<?php echo home_url(); ?>"><?php _e('Home', 'bettingtips'); ?></a></li>
                <li><a href="#"><?php _e("Today's Tips", 'bettingtips'); ?></a></li>
                <li><a href="#" ><?php _e("Upcoming Matches", 'bettingtips'); ?></a></li>
                <li><a href="#"><?php _e("Results", 'bettingtips'); ?></a></li>
                <li><a href="#"><?php _e("About Us", 'bettingtips'); ?></a></li>
            </ul>
        </nav>

        <!-- Mobile Navigation -->
        <nav class="mobile-nav" id="mobileNavWrapper">
            <ul>
                <li><a href="<?php echo home_url(); ?>"><?php _e('Home', 'bettingtips'); ?></a></li>
                <li><a href="#"><?php _e("Today's Tips", 'bettingtips'); ?></a></li>
                <li><a href="#"><?php _e("Upcoming Matches", 'bettingtips'); ?></a></li>
                <li><a href="#"><?php _e("Results", 'bettingtips'); ?></a></li>
                <li><a href="#"><?php _e("About Us", 'bettingtips'); ?></a></li>
            </ul>
        </nav>

    </div>
</header>