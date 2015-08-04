<?php

/*
Tema: vis breaking nyhed
*/

$args = array(
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
        
global $post;
$myposts = get_posts( $args );
foreach ( $myposts as $post ) : 
$link = $post->post_name;
$content = $post->post_title;
if(strlen($content) > 80){$content = substr($content,0,77).'...';}
?>

<div class="breaking-news">
	<div class="breaking-ctrl breaking-close"></div>    
    <a title='<?php echo $post->post_title; ?> - Klik for at læse artiklen.' href="./<?php echo $link; ?>" class="breaking-ctrl breaking-read"></a>
	<span class="exclm"> Sidste nyt: </span>
		<span class="news-title">
			<span>
				<a title='<?php echo $post->post_title; ?> - Klik for at læse artiklen.' href="./<?php echo $link; ?>"><h3><?php echo $content ?></h3></a>
			</span>
		</span>
</div>

<?php endforeach;?>