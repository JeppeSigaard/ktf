<?php 

add_action( 'init', 'smamo_add_tilmeldinger' );

function smamo_add_tilmeldinger() {
	register_post_type( 'tilmelding', array(
		
        'menu_icon' 		 => 'dashicons-email-alt',
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'tilmelding' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 102,
		'supports'           => array( 'title', 'thumbnail','editor'),
        'labels'             => array(
            
            'name'               => _x( 'Tilmeldinger', 'post type general name', 'smamo' ),
            'singular_name'      => _x( 'tilmelding', 'post type singular name', 'smamo' ),
            'menu_name'          => _x( 'Tilmeldinger', 'admin menu', 'smamo' ),
            'name_admin_bar'     => _x( 'Tilmeldinger', 'add new on admin bar', 'smamo' ),
            'add_new'            => _x( 'Tilføj ny ', 'tilmdelding', 'smamo' ),
            'add_new_item'       => __( 'Tilføj ny', 'smamo' ),
            'new_item'           => __( 'Ny tilmdelding', 'smamo' ),
            'edit_item'          => __( 'Rediger', 'smamo' ),
            'view_item'          => __( 'Se tilmdelding', 'smamo' ),
            'all_items'          => __( 'Se alle', 'smamo' ),
            'search_items'       => __( 'Find tilmdelding', 'smamo' ),
            'parent_item_colon'  => __( 'Forældre:', 'smamo' ),
            'not_found'          => __( 'Start med at oprette en ny tilmelding.', 'smamo' ),
            'not_found_in_trash' => __( 'Papirkurven er tom.', 'smamo' ),
            ),
	   )
    );
}