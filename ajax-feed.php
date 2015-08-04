<?php 
header('Access-Control-Allow-Origin: *');  
define('WP_USE_THEMES', false); require('../../../wp-blog-header.php');


function html2txt($document){ 
$search = array('@<script[^>]*?>.*?</script>@si',  // Strip out javascript 
               '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags 
               '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly 
               '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments including CDATA 
); 
$text = preg_replace($search, '', $document); 
return $text; 
} 


$i = 0;
$breaking_IDS = array();

// hent breaking nyhed
$breaking = '';
$breaking_args = array(
'posts_per_page'   => 1,
'offset'           => 0,
'category'         => '10',
'orderby'          => 'post_date',
'order'            => 'DESC',
'include'          => '',
'exclude'          => '',
'meta_key'         => '',
'meta_value'       => '',
'post_type'        => 'post',
'post_mime_type'   => '',
'post_parent'      => '',
'post_status'      => 'publish',
'suppress_filters' => true );
        
global $breaking;
$myposts = get_posts( $breaking_args );
foreach ( $myposts as $post ) :
	
	// opret billede
	$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'feed-size');

	// tæl artikler
	$i ++;
	if($i == 4){
		$breaking .='<div id="more-news">Gamle artikler</div><div id="hidden-news">';
		}
	
	$content = wp_trim_words( $post->post_content, $num_words = 40, $more = null );
	
	// saml artikler
	$breaking .='<li class="bottom-entry breaking-entry entry-'.$post->ID.'">
		<h4 class="lcp_bottom_title"><a href="/'.$post->post_name.'">'.$post->post_title.'</a></h4>
		<div class="lcp_bottom_img"><img src="'.$image_url[0].'" title="'.$post->post_title.'"/></div>
		<p class="lcp_bottom_excerpt">'.$content.'...</p>
	
	</li>';
	
	// tilføj ID til array (så de ikke gentages i nyhedsoversigten)
	array_push($breaking_IDS, $post->ID);

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
'exclude'          => $exclude,
'meta_key'         => '',
'meta_value'       => '',
'post_type'        => 'post',
'post_mime_type'   => '',
'post_parent'      => '',
'post_status'      => 'publish',
'suppress_filters' => true );
        
global $news;
$myposts = get_posts( $news_args );
foreach ( $myposts as $post ) : 

	// opret billede
	$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'feed-size');
	
	$i ++;
	if($i == 4){
		$news_pages .='<div id="more-news">Gamle artikler</div><div id="hidden-news">';
		}
	$content = wp_trim_words( $post->post_content, $num_words = 40, $more = null );
	$news_pages .='<li class="bottom-entry entry-'.$post->ID.'">
		<h4 class="lcp_bottom_title"><a href="/'.$post->post_name.'">'.$post->post_title.'</a></h4>
		<div class="lcp_bottom_img"><img src="'.$image_url[0].'" title="'.$post->post_title.'"/></div>
		<p class="lcp_bottom_excerpt">'.$content.'</p>
		
		</li>';

endforeach;

if($i > 3){echo '</div>';}
?>

            <ul class="lcp_bottom">
                 <?php echo $breaking; // Indsæt breaking ?> 
                 <?php echo $news_pages; // Indsæt andet ?> 
            </ul>