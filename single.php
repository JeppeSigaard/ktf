<?php get_header(); 

$current_id = $wp_query->post->ID;
$breaking_IDS = array();
// hent breaking nyhed
$breaking = '';
$breaking_args = array(
'posts_per_page'   => -1,
'offset'           => 0,
'category'         => '10',
'orderby'          => 'post_date',
'order'            => 'DESC',
'include'          => '',
'exclude'          => $current_id,
'meta_key'         => '',
'meta_value'       => '',
'post_type'        => 'post',
'post_mime_type'   => '',
'post_parent'      => '',
'post_status'      => 'publish',
'suppress_filters' => true );
        
global $br_post;
$myposts = get_posts( $breaking_args );
foreach ( $myposts as $br_post ) :
	
	// opret billede
	$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($br_post->ID), 'feed-size');

	// tæl artikler
	$i ++;
	if($i == 4){
		$breaking .='</div><div id="all-news">';
		}
	
	// saml artikler
	$breaking .='<li class="bottom-entry entry-'.$br_post->ID.'">
		<h4 class="lcp_bottom_title"><a href="/'.$br_post->post_name.'">'.$br_post->post_title.'</a></h4>
		<div class="lcp_bottom_img"><img src="'.$image_url[0].'" title="'.$br_post->post_title.'"/></div>
		<p class="lcp_bottom_excerpt">'.substr($br_post->post_content,0,200).'...</p>
	
	</li>';
	
	// tilføj ID til array (så de ikke gentages i nyhedsoversigten)
	array_push($breaking_IDS, $br_post->ID);

endforeach;

$exclude = '';
foreach ($breaking_IDS as $x=>$val){
	$exclude .= $val.',';
	}
// Hent artikler

$news_pages = '';
$news_args = array(
'posts_per_page'   => -1,
'offset'           => 0,
'category'         => '9,10',
'orderby'          => 'post_date',
'order'            => 'DESC',
'include'          => '',
'exclude'          => $exclude.','.$current_id,
'meta_key'         => '',
'meta_value'       => '',
'post_type'        => 'post',
'post_mime_type'   => '',
'post_parent'      => '',
'post_status'      => 'publish',
'suppress_filters' => true );
        
global $news_post;
$myposts = get_posts( $news_args );
foreach ( $myposts as $news_post ) : 

	// opret billede
	$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($news_post->ID), 'feed-size');
	
	$i ++;
	if($i == 4){
		$news_pages .='</div><div id="all-news">';
		}
	
	$news_pages .='<li class="bottom-entry entry-'.$news_post->ID.'">
		<h4 class="lcp_bottom_title"><a href="/'.$news_post->post_name.'">'.$news_post->post_title.'</a></h4>
		<div class="lcp_bottom_img"><img src="'.$image_url[0].'" title="'.$news_post->post_title.'"/></div>
		<p class="lcp_bottom_excerpt">'.substr($news_post->post_content,0,200).'...</p>
	
	</li>';

endforeach;

if($i > 3){echo '</div>';}
?>



?>




<section id="om">
	<div class="wrap-960">
    <div id="first-news">
    <article class="lcp_full">
    	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <h1 class="lcp_full_title"><?php the_title(); ?></h1>
        <?php if(has_post_thumbnail(get_the_ID())):?>
        <div class="lcp_full_img"><?php the_post_thumbnail('article-size');?></div>
        <?php endif; ?>
        <p class="lcp_content"><?php the_content();?></p>
			
            
        <?php endwhile; endif; ?>
    </article>
    </div>
    <div id="next-3-news">
    	<?php echo $breaking; ?>
        <?php echo $news_pages; ?>
    </div>
    </div>
</section>
<?php get_template_part('section','kontakt');?>
<?php get_footer(); ?>