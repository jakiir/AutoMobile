<?php 

//add colume

function automobile_columns( $columns ) {
    $columns['automobile_make'] = 'Make';
    $columns['automobile_model'] = 'Model';
    $columns['automobile_categories'] = 'Categories';
    unset( $columns['comments'] );
    return $columns;
}
	add_action( 'manage_posts_custom_column', 'automobile_populate_columns' );


function automobile_populate_columns( $column ) {
    if ( 'automobile_make' == $column ) {
        $txt_automobile_make = esc_html( get_post_meta( get_the_ID(), 'txt_automobile_make', true ) );
        echo $txt_automobile_make;
    }
    elseif ( 'automobile_model' == $column ) {
        $txt_automobile_model = get_post_meta( get_the_ID(), 'txt_automobile_model', true );
        echo $txt_automobile_model;
    }
    elseif ( 'automobile_categories' == $column ) {
        $txt_automobile_categories = get_post_meta( get_the_ID(), 'txt_automobile_categories', true );
        echo $txt_automobile_categories;
    }
}

add_filter( 'manage_edit-tlp_automobile_sortable_columns', 'sort_automobile' );

function sort_automobile( $columns ) {
    $columns['automobile_make'] = 'automobile_make';
    $columns['automobile_model'] = 'automobile_model';
    $columns['automobile_categories'] = 'automobile_categories';
    return $columns;
}

//add_filter( 'request', 'column_ordering' );
 
add_filter( 'request', 'automobile_column_orderby' );
 
function automobile_column_orderby ( $vars ) {
    if ( !is_admin() )
        return $vars;
    if ( isset( $vars['orderby'] ) && 'automobile_make' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array( 'meta_key' => 'txt_automobile_make', 'orderby' => 'meta_value' ) );
    }
    elseif ( isset( $vars['orderby'] ) && 'automobile_model' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array( 'meta_key' => 'txt_automobile_model', 'orderby' => 'meta_value' ) );
    }
    elseif ( isset( $vars['orderby'] ) && 'automobile_categories' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array( 'meta_key' => 'txt_automobile_categories', 'orderby' => 'meta_value' ) );
    }
    return $vars;
}




// CREATE FILTERS WITH CUSTOM TAXONOMIES

add_action( 'restrict_manage_posts', 'automobile_filter_list' );


function automobile_filter_list() {
    $screen = get_current_screen();
    global $wp_query;
    if ( $screen->post_type == 'tlp_automobile' ) {
        wp_dropdown_categories( array(
            'show_option_all' => 'Show All Category',
            'taxonomy' => 'automobile_product_category',
            'name' => 'automobile_product_category',
            'orderby' => 'name',
            'selected' => ( isset( $wp_query->query['automobile_product_category'] ) ? $wp_query->query['automobile_product_category'] : '' ),
            'hierarchical' => false,
            'depth' => 3,
            'show_count' => false,
            'hide_empty' => true,
        ) );
    }
}


	
add_filter( 'parse_query','automobile_perform_filtering' );

function automobile_perform_filtering( $query ) {
    $qv = &$query->query_vars;
    if ( ( $qv['automobile_product_category'] ) && is_numeric( $qv['automobile_product_category'] ) ) {
        $term = get_term_by( 'id', $qv['automobile_product_category'], 'automobile_product_category' );
        $qv['automobile_product_category'] = $term->slug;
    }
}


if (!is_admin()){
    add_action('wp_footer', 'owl_team_js');
}
    if (!function_exists('owl_team_js')) {
        function owl_team_js() {	
            wp_enqueue_script( 'automobile-owl-carousel-js', plugins_url('assets/js/owl.carousel.js', dirname(__FILE__)) );           
            wp_enqueue_script( 'automobile-bootstrap-font-js', plugins_url('assets/js/bootstrap.min.js', dirname(__FILE__)) );
            wp_enqueue_script( 'automobile-jquery', plugins_url('assets/js/jquery-1.11.1.min.js', dirname(__FILE__)) );
            wp_enqueue_script( 'automobile-custom', plugins_url('assets/js/custom.js', dirname(__FILE__)) );               
        }
    }

/**
 * Enqueues styles for front-end.
 *
 */ 
if (!function_exists('owl_team_public_css')) {
    function owl_team_public_css() { 	  
    //wp_enqueue_style( 'font-awesome', plugins_url('lib/assets/css/font-awesome/css/font-awesome.min.css', dirname(__FILE__)) );    w
    wp_enqueue_style( 'automobile-owl-carousel', plugins_url('assets/style/owl.carousel.css', dirname(__FILE__)) );
    wp_enqueue_style( 'automobile-bootstrap', plugins_url('assets/style/bootstrap.min.css', dirname(__FILE__)) );   
    wp_enqueue_style( 'automobile-style', plugins_url('assets/style/style.css', dirname(__FILE__)) ); 
    
    wp_enqueue_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.1/css/font-awesome.css', null, '4.0.1' );   
    wp_enqueue_style( 'droid-serif', 'http://fonts.googleapis.com/css?family=Droid+Serif:400,400italic,700,700italic'); 
    
    }
}
add_action( 'wp_enqueue_scripts', 'owl_team_public_css' );
  
  
  //template filter

add_filter( 'template_include','automobile_include_template_function', 1 );
function automobile_include_template_function( $template_path ) {
if ( get_post_type() == 'tlp_automobile' ) {
if ( is_single() ) {
// checks if the file exists in the theme first,
// otherwise serve the file from the plugin
if ( $theme_file = locate_template( array
( 'automobile-single.php' ) ) ) {
$template_path = $theme_file;
} else {
$template_path = plugin_dir_path( __FILE__ ) . '/template/automobile-single.php';
     }
  } 
    elseif ( is_archive() ) {
                if ( $theme_file = locate_template( array ( 'automobile_archive.php' ) ) ) {
$template_path = $theme_file;
}    else { $template_path = plugin_dir_path( __FILE__ ) . '/template/automobile-archive.php';

           }
      }
}
return $template_path;
}
    function getFeaturedImage( $post_id = NULL, $size = 'large', $arr=false) {
        global $id;
            $post_thumbnail_id = get_post_thumbnail_id( $post_id );
            $image = wp_get_attachment_image_src($post_thumbnail_id, $size);
            if(!$image)return false;
            if($arr) return $image;
            if ( $image ) {
            list($src, $width, $height) = $image;
            }
        return $src;
    }
    
    
    
    
 //images resize   
    
    
    
    if ( ! function_exists( 'automobile_resize' ) ) {
	
	/**
	 * Mahabub hasan Manik
	 * 
	 * @param string $url    - (required) must be uploaded using wp media uploader
	 * @param int    $width  - (required) 
	 * @param int    $height - (optional) 
	 * @param bool   $crop   - (optional) default to soft crop
	 * @param bool   $single - (optional) returns an array if false
	 */
	function automobile_resize( $url = '', $width = '', $height = NULL, $crop = NULL, $single = TRUE ) {
		
		if ( empty( $url ) )
			return NULL;
		
		if ( empty( $width ) )
			return NULL;
		
		$args = array(
			'url'    => $url,
			'width'  => $width,
			'height' => $height,
			'crop'   => $crop,
			'single' => $single
		);
		
		return wp_img_resizer_src( $args );
	}
}
    
     ?>