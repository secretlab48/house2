<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!--<meta name="description" content="<?php bloginfo('description'); ?>">-->

        <script>(function(w,d,u){w.readyQ=[];w.bindReadyQ=[];function p(x,y){if(x=="ready"){w.bindReadyQ.push(y);}else{w.readyQ.push(x);}};var a={ready:p,bind:p};w.$=w.jQuery=function(f){if(f===d||f===u){return a}else{p(f)}}})(window,document)</script>

		<?php

            wp_head();

        ?>

	</head>
	<body <?php body_class(); ?>>

		<div class="site-wrapper">

            <header class="header clear" role="banner">
                <div class="header-box">
                    <div class="header-content container">
                        <div class="logo-box"><a href="<?php echo site_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/top-logo1.svg"></a></div>
                        <?php wp_nav_menu( array( 'menu' => 'top-menu', 'container_class' => 'top-menu-box', 'menu_class' => 'top-menu' ) ); ?>
                        <div class="menu-manage"><span></span><span></span><span></span></div>
                    </div>
                </div>


            </header>
