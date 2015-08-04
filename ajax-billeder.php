<?php
header('Access-Control-Allow-Origin: *');  
define('WP_USE_THEMES', false); require('../../../wp-blog-header.php');

/*
Tema: vis billedsektion
*/
$fb_albums_result = '';
$args = array(
'posts_per_page'   => -1,
'offset'           => 0,
'category'         => '',
'orderby'          => 'post_date',
'order'            => 'DESC',
'include'          => '',
'exclude'          => '',
'meta_key'         => '',
'meta_value'       => '',
'post_type'        => 'album',
'post_mime_type'   => '',
'post_parent'      => '',
'post_status'      => 'publish',
'suppress_filters' => true );
        
        global $post;
        $myposts = get_posts( $args );
        foreach ( $myposts as $post ) : 
		$url = $post->post_title;
		$fb_albums_result .= do_shortcode('[fbalbum url='.$url.' limit=200]');        
		       
        endforeach;

		print $fb_albums_result;
		
	
	?>       