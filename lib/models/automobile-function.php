<?php
function autoMobileAddToCart(){
        $itemId = $_POST['itemId'];
        if($itemId):
        $itemSku = $_POST['itemSku'];
        $quantity = $_POST['quantity'];
        $itemPrice = $_POST['itemPrice'];
        @session_start();
        $sessionId = session_id();

        $autoMobielSession = '_auto_mobile_session_'.$sessionId;
        if ( get_option( $autoMobielSession ) !== false ) {
            update_option( $autoMobielSession, $sessionId );
        } else {
            add_option( $autoMobielSession, $sessionId, '', 'yes' );
        }


        $item_info = array(
            'item_1' 	=> array(
                        'item_id'           => $itemId,
                        'item_sku'          => $itemSku,
                        'item_quantity'     => $quantity,
                        'item_price'        => $itemPrice
                    )
        );
        $item_information = serialize($item_info);

        $auto_mobile_info = '_auto_mobile_info_'.$sessionId;
        if ( get_option( $auto_mobile_info ) !== false ) {

            $get_mobile_info = get_option( $auto_mobile_info );
            $get_mobile_info_uns = unserialize($get_mobile_info);
            $singleArray = array();
            foreach ($get_mobile_info_uns as $key => $value){
                $singleArray[$key] = $value['item_id'];
            }


                if (in_array($itemId, $singleArray)) {

                foreach ($get_mobile_info_uns as $key => $get_mobile_info_unss){
                    if($get_mobile_info_unss['item_id'] === $itemId){
                        $itemQuantity = $get_mobile_info_unss['item_quantity']+1;
                        $item_price = $get_mobile_info_unss['item_price']+ $itemPrice;
                        $itemInfo = array(
                            $key => array(
                                        'item_id'           => $get_mobile_info_unss['item_id'],
                                        'item_sku'          => $itemSku,
                                        'item_quantity'     => $itemQuantity,
                                        'item_price'        => $item_price
                                    )
                        );
                        $itemInfoResult = array_merge($get_mobile_info_uns, $itemInfo );
                        $item_inform = serialize($itemInfoResult);
                        update_option( $auto_mobile_info, $item_inform );

                        if ( is_user_logged_in() ) {
                            $user_ID = get_current_user_id();
                            update_user_meta( $user_ID, 'auto_mobile_shopping_cart', $item_inform );
                        }

                    }
                }

                } else {
                    $lastKey = substr(end(array_keys($get_mobile_info_uns)), -1);
                    $incrLast = intval($lastKey) + 1;
                    $item_info2 = array(
                        'item_'.$incrLast => array(
                                    'item_id'           => $itemId,
                                    'item_sku'          => $itemSku,
                                    'item_quantity'     => $quantity,
                                    'item_price'        => $itemPrice
                                )
                    );

                    $itemInfo_result = array_merge($get_mobile_info_uns, $item_info2 );
                    $item_inform2 = serialize($itemInfo_result);
                    update_option( $auto_mobile_info, $item_inform2 );

                    if ( is_user_logged_in() ) {
                        $user_ID = get_current_user_id();
                        update_user_meta( $user_ID, 'auto_mobile_shopping_cart', $item_inform2 );
                    }

                }

        } else {
            add_option( $auto_mobile_info, $item_information, '', 'yes' );

            if ( is_user_logged_in() ) {
                $user_ID = get_current_user_id();
                update_user_meta( $user_ID, 'auto_mobile_shopping_cart', $item_information );
            }

        }

        endif;



  die();
  }
add_action( 'wp_ajax_nopriv_autoMobileAddToCart','autoMobileAddToCart' );
add_action( 'wp_ajax_autoMobileAddToCart','autoMobileAddToCart' );


function autoMobileRemoveCart(){
        $itemId = $_POST['itemId'];
        if($itemId):
        $item_key = $_POST['item_key'];
        @session_start();
        $sessionId = session_id();

        $auto_mobile_info = '_auto_mobile_info_'.$sessionId;

            $get_mobile_info = get_option( $auto_mobile_info );
            $get_mobile_info_uns = unserialize($get_mobile_info);

            unset($get_mobile_info_uns[$item_key]);

            //print_r($get_mobile_info_uns);
            $item_inform2 = serialize($get_mobile_info_uns);
            update_option( $auto_mobile_info, $item_inform2 );

            if ( is_user_logged_in() ) {
                $user_ID = get_current_user_id();
                update_user_meta( $user_ID, 'auto_mobile_shopping_cart', $item_inform2 );
            }

        endif;



  die();
  }
add_action( 'wp_ajax_nopriv_autoMobileRemoveCart','autoMobileRemoveCart' );
add_action( 'wp_ajax_autoMobileRemoveCart','autoMobileRemoveCart' );
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
    wp_enqueue_style( 'user-style', plugins_url('assets/style/user_style.css', dirname(__FILE__)) );
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
}
    else
    {
        $template_path = plugin_dir_path( __FILE__ ) . '/template/automobile-single.php';
    }
  }



elseif ( is_archive() ) {
  if ( $theme_file = locate_template( array ( 'automobile_archive.php' ) ) ) {
$template_path = $theme_file;
}

else
        {
            $template_path = plugin_dir_path( __FILE__ ) . '/template/automobile-archive.php';
        }
    }
}
if(is_page( 'shopping-cart' )){
$template_path = plugin_dir_path( __FILE__ ) . '/template/automobile-shopping-cart.php';
}
if(is_page( 'auto-mobile' )){
$template_path = plugin_dir_path( __FILE__ ) . '/template/automobile.php';
}

if(is_page( 'automobile-checkout' )){
$template_path = plugin_dir_path( __FILE__ ) . '/template/automobile-checkout.php';
}

if(is_page( 'automobile-account' )){
$template_path = plugin_dir_path( __FILE__ ) . '/template/automobile-register.php';
}

return $template_path;
}
    function getFeaturedImage( $post_id = NULL, $size = 'large', $arr=false) {
        //global $id;
        $src = '';

            $post_thumbnail_id = get_post_thumbnail_id( $post_id );
            $image = wp_get_attachment_image_src($post_thumbnail_id, $size);
            if(!$image)return false;
            if($arr) return $image;
            if ( $image ) {
            list($src) = $image;
                //list($src, $widthd, $height) = $image;
            }
        return $src;
    }




 //images resize



    if ( ! function_exists( 'automobile_resize' ) ) {

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