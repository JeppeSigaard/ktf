<?php 
/*
template name: Billedgalleri
*/
?>

<?php get_header(); ?>
<section id="content" role="main">
	<div class="page-content">
        <div class="wrap-960">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header>
                <section class="entry-content">
					<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
                    <?php the_content(); ?>
                <div class="entry-links"><?php wp_link_pages(); ?></div>
                </section>
            </article>
            <?php if ( ! post_password_required() ) comments_template( '', true ); ?>
            <?php endwhile; endif; ?>
        </div>
    </div>
	<div class="included-content">
		<?php get_template_part('section','billeder');?>
    </div>
</section>
<?php get_footer(); ?>