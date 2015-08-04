<?php
header('Access-Control-Allow-Origin: *');  
define('WP_USE_THEMES', false); require('../../../wp-blog-header.php');

?>
		
             <?php $i = 0; $query_u = new WP_Query('post_type=Undervisere&posts_per_page=-1');
		  		while ($query_u->have_posts()) : $i++; $query_u->the_post(); if($i == 3){$third = ' third'; $i = 0;}else{$third = '';}?>
                <a href="<?php the_permalink(); ?>" title="<?php the_title();?>" class="u-cont <?php echo $third ?>">
                    <div class="u-pic"><?php the_post_thumbnail('medium'); ?></div>
                    <div class="u-name"><?php the_title(); ?></div>
                    <div class="u-desc"><?php the_excerpt(); ?></div>
                </a>
           	<?php endwhile;  wp_reset_query(); ?> 