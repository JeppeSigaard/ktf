<?php 

function html2txt($document){ 
$search = array('@<script[^>]*?>.*?</script>@si',  // Strip out javascript 
               '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags 
               '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly 
               '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments including CDATA 
); 
$text = preg_replace($search, '', $document); 
return $text; 
} 

// hent info - artikel
$info_page = '';
$info_args = array(
'posts_per_page'   => 1,
'offset'           => 0,
'category'         => '',
'orderby'          => 'post_date',
'order'            => 'DESC',
'include'          => '',
'exclude'          => '',
'meta_key'         => '',
'meta_value'       => '',
'post_type'        => 'about',
'post_mime_type'   => '',
'post_parent'      => '',
'post_status'      => 'publish',
'suppress_filters' => true );
        
global $post;
$myposts = get_posts( $info_args );
foreach ( $myposts as $post ) : 
	$title = $post->post_title;
	$content = $post->post_content;
	$right_content = $post->post_excerpt;
	$info_page .='<div class="about-main">
		<h2>'.$title.'</h2>
		<div class="about-main-left">'.$content.'</div>
		<div class="about-main-right">'.$right_content.'</div>
	</div>';

endforeach;
?>
<section id="om">
	<div class="wrap-920">
    	<h3>Om os</h3>	
		<?php echo $info_page; // Indsæt om-side ?> 
        <div id="all-news">
        </div>
    </div>
</section>