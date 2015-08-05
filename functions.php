<?php
add_action( 'after_setup_theme', 'SmartMonkey_setup' );
function SmartMonkey_setup()
{
load_theme_textdomain( 'SmartMonkey', get_template_directory() . '/languages' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
add_image_size( 'feed-size', 280, 210 );
add_image_size( 'underviser-size', 270, 270 );
add_image_size( 'article-size', 640, '', false );


global $content_width;
if ( ! isset( $content_width ) ) $content_width = 640;
register_nav_menus(
array( 
	'main-menu' => __( 'Main Menu', 'SmartMonkey' ),
	'top-menu' => __( 'Top Menu', 'SmartMonkey' ),
 ));
}
add_action( 'wp_enqueue_scripts', 'SmartMonkey_load_scripts' );
function SmartMonkey_load_scripts()
{
wp_enqueue_script( 'jquery' );
}
add_action( 'comment_form_before', 'SmartMonkey_enqueue_comment_reply_script' );
function SmartMonkey_enqueue_comment_reply_script()
{
if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}
add_filter( 'the_title', 'SmartMonkey_title' );
function SmartMonkey_title( $title ) {
if ( $title == '' ) {
return '&rarr;';
} else {
return $title;
}
}
add_filter( 'wp_title', 'SmartMonkey_filter_wp_title' );
function SmartMonkey_filter_wp_title( $title )
{
return $title . esc_attr( get_bloginfo( 'name' ) );
}
add_action( 'widgets_init', 'SmartMonkey_widgets_init' );
function SmartMonkey_widgets_init()
{
register_sidebar( array (
'name' => __( 'Footer Venstre', 'SmartMonkey' ),
'id' => 'footer-left',
'before_widget' => '<div class="footer-widget footer-left-widget">',
'after_widget' => "</div>",
'before_title' => '<span style="display:none;">',
'after_title' => '</span>',
) );

register_sidebar( array (
'name' => __( 'Footer Højre', 'SmartMonkey' ),
'id' => 'footer-right',
'before_widget' => '<div class="footer-widget footer-right-widget">',
'after_widget' => "</div>",
'before_title' => '<span style="display:none;">',
'after_title' => '</span>',
) );

}
function SmartMonkey_custom_pings( $comment )
{
$GLOBALS['comment'] = $comment;
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php 
}
add_filter( 'get_comments_number', 'SmartMonkey_comments_number' );
function SmartMonkey_comments_number( $count )
{
if ( !is_admin() ) {
global $id;
$comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
return count( $comments_by_type['comment'] );
} else {
return $count;
}
}

add_action( 'admin_menu', 'my_remove_admin_menus' );
function my_remove_admin_menus() {
    remove_menu_page( 'edit-comments.php' );
}

add_action( 'wp_enqueue_scripts', 'jk_load_dashicons' );
function jk_load_dashicons() {
    wp_enqueue_style( 'dashicons' );
}

// Fjern pis fra header
 remove_action('wp_head', 'rsd_link'); // Removes the Really Simple Discovery link
 remove_action('wp_head', 'wlwmanifest_link'); // Removes the Windows Live Writer link
 remove_action('wp_head', 'wp_generator'); // Removes the WordPress version
 remove_action('wp_head', 'feed_links', 2); // Removes the RSS feeds remember to add post feed maunally (if required) to header.php
 remove_action('wp_head', 'feed_links_extra', 3); // Removes all other RSS links
 remove_action('wp_head', 'index_rel_link'); // Removes the index page link
 remove_action('wp_head', 'start_post_rel_link', 10, 0); // Removes the random post link
 remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Removes the parent post link
 remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Removes the next and previous post links
 
 
// Ryd op i admin menuen
function remove_menus(){
  
  //remove_menu_page( 'index.php' );                  	//Dashboard
  // remove_menu_page( 'edit.php' );                   	//Posts
  // remove_menu_page( 'upload.php' );                 	//Media
  remove_menu_page( 'edit.php?post_type=page' );    	//Pages
  remove_menu_page( 'edit-comments.php' );             	//Comments
  // remove_menu_page( 'themes.php' );                	//Appearance
  // remove_menu_page( 'plugins.php' );                	//Plugins
  // remove_menu_page( 'users.php' );                  	//Users
  remove_menu_page( 'tools.php' );                     	//Tools
  // remove_menu_page( 'options-general.php' );        	//Settings
  remove_menu_page('gadash_settings');
  
}
add_action( 'admin_menu', 'remove_menus' );

// Opret Om side
add_action( 'init', 'add_about' );
function add_about() {
	$labels = array(
		'name'               => _x( 'Infosider', 'post type general name', 'faircase' ),
		'singular_name'      => _x( 'inforside', 'post type singular name', 'faircase' ),
		'menu_name'          => _x( 'Infosider', 'admin menu', 'faircase' ),
		'name_admin_bar'     => _x( 'infoside', 'add new on admin bar', 'faircase' ),
		'add_new'            => _x( 'Tilføj ny infoside', 'quizside', 'faircase' ),
		'add_new_item'       => __( 'Tilføj ny infoside', 'faircase' ),
		'new_item'           => __( 'Ny infoside', 'faircase' ),
		'edit_item'          => __( 'Rediger', 'faircase' ),
		'view_item'          => __( 'Se indstililnger', 'faircase' ),
		'all_items'          => __( 'Se alle', 'faircase' ),
		'search_items'       => __( 'Find infoside', 'faircase' ),
		'parent_item_colon'  => __( 'Forældre:', 'faircase' ),
		'not_found'          => __( 'Start med at oprette en ny infoside.', 'faircase' ),
		'not_found_in_trash' => __( 'Papirkurven er tom.', 'faircase' ),
	);

	$args = array(
		'menu_icon' 		 => 'dashicons-info',
		'labels'             => $labels,
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'about' ),
		'capability_type'    => 'page',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 4,
		'supports'           => array( 'title', 'editor')
	);

	register_post_type( 'about', $args );
	
}


// Opret Albums
add_action( 'init', 'add_facebook_albums' );
function add_facebook_albums() {
	$labels = array(
		'name'               => _x( 'Albums', 'post type general name', 'faircase' ),
		'singular_name'      => _x( 'album', 'post type singular name', 'faircase' ),
		'menu_name'          => _x( 'facebook Albums', 'admin menu', 'faircase' ),
		'name_admin_bar'     => _x( 'album', 'add new on admin bar', 'faircase' ),
		'add_new'            => _x( 'Tilføj nyt album', 'quizside', 'faircase' ),
		'add_new_item'       => __( 'Tilføj nyt album', 'faircase' ),
		'new_item'           => __( 'Nyt album', 'faircase' ),
		'edit_item'          => __( 'Rediger', 'faircase' ),
		'view_item'          => __( 'Se indstililnger', 'faircase' ),
		'all_items'          => __( 'Se alle', 'faircase' ),
		'search_items'       => __( 'Find album', 'faircase' ),
		'parent_item_colon'  => __( 'Forældre:', 'faircase' ),
		'not_found'          => __( 'Start med at oprette et nyt album.', 'faircase' ),
		'not_found_in_trash' => __( 'Papirkurven er tom.', 'faircase' ),
	);

	$args = array(
		'menu_icon' 		 => 'dashicons-format-gallery',
		'labels'             => $labels,
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'album' ),
		'capability_type'    => 'page',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title')
	);

	register_post_type( 'album', $args );
	
}

add_action( 'init', 'create_post_types' );
function create_post_types() {
	
	register_post_type( 'Undervisere',
		array(
			'labels' => array(
				'name' => _x('Undervisere', 'post type general name'),
				'singular_name' => _x('Underviser', 'post type singular name'),
				'add_new' => _x('tilføj ny underviser', 'underviser'),
				'add_new_item' => __('Ny underviser'),
				'edit_item' => __('Rediger underviser'),
				'new_item' => __('Ny underviser'),
				'all_items' => __('Alle undervisere'),
				'view_item' => __('Se underviser'),
				'search_items' => __('Søg'),
				'not_found' =>  __('Ingen registrerede undervisere'),
				'not_found_in_trash' => __('Ingen undervisere i papirkurven'), 
				'parent_item_colon' => '',
				'menu_name' => __('Undervisere')
			),
		'menu_icon'=>'dashicons-id',
		'public' => false,
		'show_ui' => true,
		'hierarchical' => false,
		'has_archive' => true,
		'supports' => array( 'title', 'thumbnail', 'editor', 'excerpt')
		)
	);
	
	
	
	
}



function qr_widget() {
	wp_add_dashboard_widget(
                 'qr',         // Widget slug.
                 'QR',         // Title.
                 'qr_display' // Display function.
        );	
}
add_action( 'wp_dashboard_setup', 'qr_widget' );
function qr_display() {

	// Display whatever it is you want to show.
	?>
    <img src="http://klartilfilm.dk/wp-content/uploads/2014/08/chart.png" style="width:100%;"/>
    <div style="padding: 0px 40px 40px;margin-top: -30px;">
        <h2 style="text-align:center;">Indstil QR kode</h2>
        <p>Angiv en fuld webadresse, som qr-koden herover skal henvise til. Standard er http://klartilfilm.dk</p>
        <label for="option_qr">Henvis til:</label>
        <input class="widefat" id="option_qr" name="option_qr" type="text" value="<?php echo get_option('option_qr','http://klartilfilm.dk'); ?>" />
        <br/>
        <br/>
        <input name="save_qr" type="submit" class="button button-primary button-large" id="save_qr" value="Gem">
	</div>
	<?php
} 


function my_enqueue() {
	wp_enqueue_script( 'jq', get_bloginfo('template_directory') . '/js/jquery.js' );
    wp_enqueue_script( 'admin_script', get_bloginfo('template_directory') . '/js/admin.js' );
}
add_action( 'admin_enqueue_scripts', 'my_enqueue' );









function custom_post_type_boxes(){
	
	/* Undervisere */
	remove_meta_box( 'postimagediv', 'Undervisere', 'side' );
    add_meta_box( 'postimagediv', __( 'Portrætfoto' ), 'post_thumbnail_meta_box', 'Undervisere', 'side', 'high' );
    remove_meta_box( 'postexcerpt', 'Undervisere', 'normal' );
    add_meta_box( 'postexcerpt', __( 'Stillingsbeskrivelse' ), 'post_excerpt_meta_box', 'Undervisere', 'side', 'high' );
	
	/* Infosider */
	add_meta_box( 'postexcerpt', __( 'Højrejusteret indhold (video, billede, etc.)' ), 'post_excerpt_meta_box', 'about', 'normal', '' );
	
}
add_action('do_meta_boxes', 'custom_post_type_boxes');


// funktion til at hente data via curl (don't ask)
function file_get_contents_curl($url) {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_URL, $url);
      $data = curl_exec($ch);
      curl_close($ch);
      return $data;
}


add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
	echo '<style>

	div#postexcerpt>.inside>p {
	display: none;
	
	#adminmenu li.wp-menu-separator {
	height: 20px;}
	
	</style>';
}


require 'functions/post-types.php';