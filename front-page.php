<?php get_header(); ?>
<section id="content" role="main">
	<section id="front-page">
        <div id="roll-nav">
        	<?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
            <div id="roll-nav-title">
            	Klar tilfilm
            </div>
             <div id="roll-nav-description">
            	<?php echo bloginfo('description'); ?>
            </div>
        </div>
	</section>
    
    <!-- Om -->
    <?php get_template_part('section','feed');?>
   
   <!-- Filmgalleri fra section template-->
   <?php get_template_part('section','youtube-2') ?>
    
   <!-- Billeder fra section template-->
   <?php get_template_part('section','billeder') ?>
    
   <!-- kalender -->
   <?php get_template_part('section','kalender') ?>
    
   <!-- Undervisere -->
   <?php get_template_part('section','undervisere') ?>
   
   <!-- Formular -->
   <?php get_template_part('section','kontaktformular'); ?>
    
   <!-- Kontakt -->
   <?php get_template_part('section','kontakt'); ?>
   
   
   
</section>
<?php get_footer(); ?>