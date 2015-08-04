<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, minimal-ui" />
    <link rel="icon" href="ktf.ico" type="image/x-icon"> 
	<link rel="shortcut icon" href="ktf.ico" type="image/x-icon"> 
    <title><?php wp_title( ' | ', true, 'right' ); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
    <?php wp_head(); ?>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="<?php echo bloginfo('template_directory'); ?>/js/main.js"></script>
    <script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	
	  ga('create', 'UA-49550223-1', 'klartilfilm.dk');
	  ga('send', 'pageview');
	</script>
    <link rel="stylesheet" href="<?php echo bloginfo('template_directory'); ?>/font/font.css"/>
</head>
<body <?php body_class(); ?>>
	<svg version="1.1" xmlns="http://www.w3.org/2000/svg" height="0" width="0">
	  <defs>
		 <filter id="blur" x="0" y="0">
		   <feGaussianBlur stdDeviation="5" />
		 </filter>
	  </defs>
	</svg> 
    <div id="background-cover"></div>
    <div id="video-container">
         <video id="background-video" autoplay loop muted preload="metadata">
            <source src="http://www.klartilfilm.dk/demofilm/jonathan-teaser-480.webm" type="video/webm" />
            <source src="http://www.klartilfilm.dk/demofilm/jonathan-teaser-480.ogv" type="video/ogg" />
            <source src="http://www.klartilfilm.dk/demofilm/jonathan-teaser-480.mp4" type="video/mp4" />
        </video>
        </div>
    <div id="wrapper" class="hfeed">
        <header id="header" role="banner">
            <section id="branding" class="wrap-960">
                <a href="<?php bloginfo('url'); ?>">
                	<h1 id="site-title">Klartilfilm</h1>
               	</a>
                <a href="<?php bloginfo('url'); ?>">
                	<h2 id="sub-title"><?php echo bloginfo('description'); ?></h2>
                </a>
             	<div id="top-menu-expand"></div>
             	<nav id="top-menu" role="navigation">
            		<?php wp_nav_menu( array( 'theme_location' => 'top-menu' ) ); ?>
                </nav>
            </section>
        </header>
        <div id="container">