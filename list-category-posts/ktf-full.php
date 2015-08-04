<?php
/*
Plugin Name: List Category Posts - Template "ktf-full"
*/

$lcp_display_output = '';

//Add 'starting' tag.
$lcp_display_output .= '<article class="lcp_full">';

foreach ($this->catlist->get_categories_posts() as $single){

  //Show the title and link to the post:
  $lcp_display_output .= '<h1 class="lcp_full_title">'.$this->get_post_title($single).'</h1>';

  	//Post Thumbnail
  	if(has_post_thumbnail($single->ID)):
  		$lcp_display_output .= '<div class="lcp_full_img">'.$this->get_thumbnail($single).'</div>';
	endif;
  
  $lcp_display_output .= $this->get_content($single, 'p', 'lcp_content');
  $lcp_display_output .= $this->get_excerpt($single, 'p', 'lcp_excerpt');

}

$lcp_display_output .= '</article>';
// Output
$this->lcp_output = $lcp_display_output;

?>