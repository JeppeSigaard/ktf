<?php
/*
Plugin Name: List Category Posts - Template "ktf-side"
*/

$lcp_display_output = '';

//Add 'starting' tag.
$lcp_display_output .= '<ul class="lcp_bottom">';

foreach ($this->catlist->get_categories_posts() as $single){
	
	$lcp_display_output .= '<li class="bottom-entry">';

  	//Show the title and link to the post:
  	$lcp_display_output .= '<h4 class="lcp_bottom_title">'.$this->get_post_title($single).'</h4>';

  	//Post Thumbnail
  	if(has_post_thumbnail($single->ID)):
  		$lcp_display_output .= '<div class="lcp_bottom_img">'.$this->get_thumbnail($single).'</div>';
	endif;
  
  	$lcp_display_output .= $this->get_excerpt($single, 'p', 'lcp_bottom_excerpt');
	
	$lcp_display_output .= '</li>';

}

$lcp_display_output .= '</ul>';

// Output
$this->lcp_output = $lcp_display_output;

?>