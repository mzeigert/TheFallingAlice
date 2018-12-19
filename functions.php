<?php
add_theme_support('post-thumbnails');
add_theme_support('automatic-feed-links');
add_theme_support('custom-background');
if (!isset($content_width)) {
    $content_width = 900;
}
set_post_thumbnail_size(180, 150, false);
?>
<?php
add_action( 'wp_enqueue_scripts', 'thefallingalice_scripts' );
function thefallingalice_scripts(){
    wp_enqueue_style( 'thefallingalice-style', get_stylesheet_uri(), array('dashicons'), '1.0' );

 }
?>
<?php
function get_book_review_entries() {
  $posts = get_posts( array(
    'category_name' => 'Bücher',
  ) );
 
  if ( empty( $posts ) ) {
    return null;
  }
	$bookReviews = array();
	
	foreach($posts as $post){
		$bookReviews[] = array(
			'id' => $post->ID,
			'title'=>apply_filters('the_title', $post->post_title),
			'authors'=> get_post_custom_values('Autor', $post->ID),
			'reviewer'=> get_the_author_meta('display_name',$post->post_author),
			'thumbnail'=> get_the_post_thumbnail($post->ID)
		);
	}
 
  return $bookReviews;
}
function get_book_review_detail($data) {
	$post = get_post($data['id']);
	$bookReview = array(
		'id'=>$post->ID,
		'title'=>apply_filters('the_title', $post->post_title),
		'date'=>get_the_date('j. M \'y', $post->ID),
		'authors'=>get_post_custom_values('Autor', $post->ID),
		'genre'=>get_the_category($post->ID),
		'meta'=>get_post_custom($post->ID),
		'reviewer'=> get_the_author_meta('display_name',$post->post_author),
		'excerpt'=>apply_filters( 'the_excerpt', $post->post_excerpt ),
		'content'=>apply_filters( 'the_content', $post->post_content ),
		'header_image'=>get_the_post_thumbnail( $post->ID, 'large' ),
		'meta_image'=> get_the_post_thumbnail( $post->ID, 'thumbnail' )
	);
	return $bookReview;
}

add_action( 'rest_api_init', function () {
	register_rest_route( 'tfajson/', '/buecher', array(
    'methods' => 'GET',
    'callback' => 'get_book_review_entries',
  ));
	register_rest_route( 'tfajson/', '/buecher/detail/(?P<id>\d+)', array(
    'methods' => 'GET',
    'callback' => 'get_book_review_detail',
  ));
});

?>
<?php
function thefallingalice_wp_title($title, $sep)
{
    global $paged, $page;

    if (is_feed()) {
        return $title;
    }

    $title .= get_bloginfo('name');

    $site_description = get_bloginfo('description', 'display');
    if ($site_description && (is_home() || is_front_page())) {
        $title = "$title $sep $site_description";
    }

    if ($paged >= 2 || $page >= 2) {
        $title = "$title $sep " . sprintf(__('Page %s', 'thefallingalice'), max($paged, $page));
    }

    return $title;
}

add_filter('wp_title', 'thefallingalice_wp_title', 10, 2);?>
<?php
function set_posts_per_page($query){
    if (!is_admin()) {
        if ($query->is_home() && $query->is_main_query()) {
            $query->set('posts_per_page', 28);
            $query->set('cat', '-2471');
        } else if($query->is_category || $query->is_search){
            $query->set('posts_per_page', -1);
            $query->set('orderby', 'title');
            $query->set('order', 'ASC');
        }
    }
}

add_action('pre_get_posts', 'set_posts_per_page');
?>
<?php
function exclude_category( $query ) {
    if ( $query->is_home() && $query->is_main_query() ) {
        $query->set( 'cat', '-'.get_cat_id('Autoren') );
    }
}
add_action( 'pre_get_posts', 'exclude_category' );
?>
<?php
add_filter('next_posts_link_attributes', 'posts_link_attributes_next');
add_filter('previous_posts_link_attributes', 'posts_link_attributes_previous');

function posts_link_attributes_next()
{
    return 'class="home-nav-button arrow"';
}

function posts_link_attributes_previous()
{
    return 'class="home-nav-button arrow"';
}

?>
<?php
function register_my_menu()
{
    register_nav_menu('footer-menu', __('Footer'));
    register_nav_menu('header-menu', __('Header'));
}

add_action('init', 'register_my_menu');
?>
<?php
function thefallingalice_widgets_init()
{
    register_sidebar(array(
        'name' => __('Seitenleiste Header', 'thefallingalice'),
        'id' => 'sidebar-header',
        'description' => __('Seitenleiste mit anpassbaren Modulen', 'thefallingalice'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="widget-title tap-title">',
        'after_title' => '</div>',
    ));
    register_sidebar(array(
        'name' => __('Social Bereich', 'thefallingalice'),
        'id' => 'area-social',
        'description' => __('Sharebereich', 'thefallingalice'),
        'before_widget' => '<div id="%1$s" class="social_widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="widget-title">',
        'after_title' => '</div>',
    ));
    register_sidebar(array(
        'name' => __('Seitenleiste Footer', 'thefallingalice'),
        'id' => 'sidebar-footer',
        'description' => __("Bereich für Meta-Daten", "thefallingalice"),
        'before_widget' => '<div id="%1$s" class="footer_widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="footer-widget-title">',
        'after_title' => '</div>',
    ));
}

add_action('widgets_init', 'thefallingalice_widgets_init');
?>
<?php
/*add_filter('pre_option_link_manager_enabled', '__return_true');*/
add_filter( 'jetpack_enable_open_graph', '__return_false' );
?>
<?php
add_action( 'wp_head', 'kb_load_open_graph' );
 
function kb_load_open_graph() {

    global $post;
     
    // Standard-Grafik für Seiten ohne Beitragsbild
    $kb_site_logo = get_stylesheet_directory_uri() . '/img/wp/logo-open-graph.png';
     
    // Wenn Startseite
    if ( is_front_page() ) { // Alternativ is_home
        /*echo '<meta property="og:type" content="website" />';
        echo '<meta property="og:url" content="' . get_bloginfo( 'url' ) . '" />';
        echo '<meta property="og:title" content="' . esc_attr( get_bloginfo( 'name' ) ) . '" />';*/
        echo '<meta property="og:image" content="' . $kb_site_logo . '" />';
        /*echo '<meta property="og:description" content="' . esc_attr( get_bloginfo( 'description' ) ) . '" />';*/
    }
     
    // Wenn Einzelansicht von Seite, Beitrag oder Custom Post Type
    elseif ( is_singular() ) {
        /*echo '<meta property="og:type" content="article" />';
        echo '<meta property="og:url" content="' . get_permalink() . '" />';
        echo '<meta property="og:title" content="' . esc_attr( get_the_title() ) . '" />';*/
        if ( has_post_thumbnail( $post->ID ) ) {
            $kb_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
            echo '<meta property="og:image" content="' . esc_attr( $kb_thumbnail[0] ) . '" />';
        } else
            echo '<meta property="og:image" content="' . $kb_site_logo . '" />';
            /*echo '<meta property="og:description" content="' . esc_attr( get_the_excerpt() ) . '" />';*/
        }
}
?>
<?php
function remove_hentry( $class ) {
	$class = array_diff( $class, array( 'hentry' ) );	
	return $class;
}
add_filter( 'post_class', 'remove_hentry' );