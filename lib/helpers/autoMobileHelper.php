<?php
if (!class_exists('autoMobileHelper'))
{
  class autoMobileHelper
  {


    function __construct(){

    }

    function mini_cart(){
        $output = '';
        $quantity = 0;
        $totalPrice = 0;
        $shopping_cart = home_url('/shopping-cart/');
        @session_start();
        $sessionId = session_id();
        $auto_mobile_info = '_auto_mobile_info_'.$sessionId;
        $get_mobile_info = get_option( $auto_mobile_info );
        $get_mobile_info_uns = @unserialize($get_mobile_info);
        if($get_mobile_info_uns){
            foreach($get_mobile_info_uns as $key=>$get_mobile_info_unss):
                $item_quantity = $get_mobile_info_unss['item_quantity'];
                $item_price = $get_mobile_info_unss['item_price'];
                $quantity += $item_quantity;
                $totalPrice += $item_price;
            endforeach;

            $output = '<span class="cart_item" data-qty="'.$quantity.'">'.$quantity.'</span> ';
            $output .= ' <span class="cart_price" data-price="'.$totalPrice.'">$'.$totalPrice.'</span> ';
            $output .= ' <span class="view_cart" style="display:none;"><a href="'.$shopping_cart.'" title="view cart" target="_self">View Cart</a></span>';
        }
        if($output != ''){
            return $output;
        } else {
            $output_empty = '<span class="cart_item" data-qty="0"></span> ';
            $output_empty .= ' <span class="cart_price" data-price="0"></span> ';
            $output_empty .= ' <span class="view_cart" style="display:none;"><a href="'.$shopping_cart.'" title="view cart" target="_self">View Cart</a></span>';
            return $output_empty;
        }
    }
	
function automobile_search_list() {
	echo '<form action="'. home_url('/auto-mobile/') .'" method="GET"><ul class="list-inline">';
    $screen = get_current_screen();
	
		$auto_mobile_year = '_auto_mobile_year';
        $get_auto_mobile_year = get_option( $auto_mobile_year );
        $get_auto_mobile_year_uns = @unserialize($get_auto_mobile_year);
        echo '<li><select class="form-control"  name="txt_automobile_year" id="txt_automobile_year_dropdown"><option value="">Show All Year</option>';         if($get_auto_mobile_year_uns) {
            foreach ($get_auto_mobile_year_uns as $key=>$get_auto_mobile_year_unss): ?>
                <option value="<?php echo $key; ?>" <?php if ( isset ( $_GET['txt_automobile_year'] ) ) selected( $_GET['txt_automobile_year'], $key ); ?>><?php _e( $get_auto_mobile_year_unss, 'automobile_plugin' )?></option>';         <?php  endforeach;
        }
        echo '</select></li>';
		
		$auto_mobile_make = '_auto_mobile_make';
        $get_auto_mobile_make = get_option( $auto_mobile_make );
        $get_auto_mobile_make_uns = @unserialize($get_auto_mobile_make);
        echo '<li><select class="form-control"  name="txt_automobile_make" id="txt_automobile_make_dropdown"><option value="">Show All Make</option>';         if($get_auto_mobile_make_uns) {
            foreach ($get_auto_mobile_make_uns as $key=>$get_auto_mobile_make_unss): ?>
                <option value="<?php echo $key; ?>" <?php if ( isset ( $_GET['txt_automobile_make'] ) ) selected( $_GET['txt_automobile_make'], $key ); ?>><?php _e( $get_auto_mobile_make_unss, 'automobile_plugin' )?></option>';         <?php  endforeach;
        }
        echo '</select></li>';
		
		$auto_mobile_model = '_auto_mobile_model';
        $get_auto_mobile_model = get_option( $auto_mobile_model );
        $get_auto_mobile_model_uns = @unserialize($get_auto_mobile_model);
        echo '<li><select class="form-control"  name="txt_automobile_model" id="txt_automobile_model_dropdown"><option value="">Show All Model</option>';
            if($get_auto_mobile_model_uns) {
                foreach ($get_auto_mobile_model_uns as $key=>$get_auto_mobile_model_unss): ?>
                    <option value="<?php echo $key; ?>" <?php if ( isset ( $_GET['txt_automobile_model'] ) ) selected( $_GET['txt_automobile_model'], $key ); ?>><?php _e( $get_auto_mobile_model_unss, 'automobile_plugin' )?></option>';
                <?php  endforeach;
            }
        echo '</select></li>';
		
		echo '<li><input type="submit" class="btn btn-danger search_submit" value="Go"/></li></ul></form>';
    
}


function automobile_taxonomies_terms(){
$terms = get_terms( 'automobile_product_category' );
$output = '';
 if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
	 global $autoMobile;
	 $automobile_category_extra_fields = get_option('automobile_category_images');
       
     $output = '<div class="row">';
     foreach ( $terms as $term ) {		 
		$thumbnail_id = absint($automobile_category_extra_fields[$term->term_id]['automobile_category_images']);
		if ( $thumbnail_id ) {
			$image = wp_get_attachment_thumb_url( $thumbnail_id );
		} else {
			$image = $autoMobile->auto_mobile_default_image();
		}
       $output .= '<div class="col-md-3"><div class="product-box"><img src="' . esc_url( $image ) . '" alt="'. __( 'Thumbnail', 'automobile' ) . '" class="wp-post-image img-responsive" height="" width="" /><h3>' . $term->name . '</h3></div></div>';
        
     }
     $output .= '</div>';
	return $output;
	}
}


    function get_all_automobiles($args = array()){

        global $wp_query , $post, $autoMobile;
        $wp_query = new WP_Query($args);
        if( $wp_query->have_posts() ) {
          while ($wp_query->have_posts()) : $wp_query->the_post();
            $txt_limit=20;
            $content = get_the_content(get_the_ID($post->ID));
            $automobile_content = wp_trim_words( $content,$txt_limit); ?>
            <div class="item  col-md-4">
            <div class="product-box">
                <a href="<?php the_permalink(); ?>">
                    <?php echo $autoMobile->auto_mobile_thumbnail('400x250'); ?>
                </a>
                <div class="caption">
                    <h3>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                    </h3>                    
                   
                </div>
            </div>
        </div>
        <?php  endwhile;
        }
    }

  }
}
?>