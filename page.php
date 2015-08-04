<?php get_header(); ?>
<section id="om">
	<div class="wrap-960">
    <div id="first-news">
    <article class="lcp_full">
    	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <h1 class="lcp_full_title"><?php the_title(); ?></h1>
        <?php if(has_post_thumbnail(get_the_ID())):?>
        <div class="lcp_full_img"><?php the_post_thumbnail();?></div>
        <?php endif; ?>
        <p class="lcp_content"><?php the_content();?></p>        
        <?php endwhile; endif; ?>
    </article>
    </div>
    <div id="next-3-news">
    	<?php echo do_shortcode('[catlist name=Nyheder numberposts=3 offset=0 excludeposts=this template=ktf-side excerpt=yes excerpt_size=25 thumbnail=yes thumbnail_size=full instance=2]') ?>
    </div>
    <?php if(is_front_page() ) : ?>
	<a id="more-news">Alle nyheder</a>
	<?php else: ?>
    <div id="all-news">
    	<?php echo do_shortcode('[catlist name=Nyheder numberposts=100 offset=3 excludeposts=this template=ktf-bottom excerpt=yes excerpt_size=20 thumbnail=yes thumbnail_size=full instance=3]') ?>
    </div>
	<?php endif; ?>
    </div>
</section>
<?php get_template_part('section','kontakt');?>
<?php get_footer(); ?>