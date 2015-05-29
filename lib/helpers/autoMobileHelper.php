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



    function get_all_automobiles($args = array()){

        global $wp_query , $post, $autoMobile;
        $wp_query = new WP_Query($args);
        if( $wp_query->have_posts() ) {
          while ($wp_query->have_posts()) : $wp_query->the_post();
            $txt_limit=20;
            $content = get_the_content(get_the_ID($post->ID));
            $automobile_content = wp_trim_words( $content,$txt_limit); ?>
            <div class="item  col-xs-4 col-lg-4">
            <div class="thumbnail">
                <a href="<?php the_permalink(); ?>">
                    <?php echo $autoMobile->auto_mobile_thumbnail('400x250'); ?>
                </a>
                <div class="caption">
                    <h4 class="group inner list-group-item-heading">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                    </h4>
                    <p class="group inner list-group-item-text">
                        <?php echo $automobile_content; ?></p>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <span class="automobile-price">
                               Price: <?php $itemPriec = esc_html( get_post_meta( get_the_ID(), 'txt_automobile_price', true ) ); if($itemPriec): echo '$'.$itemPriec; endif; ?></span>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <a data-item_id="<?php echo get_the_ID(); ?>" data-item_sku="<?php echo esc_html(get_post_meta(get_the_ID(), 'txt_automobile_sku', true)); ?>" data-quantity="1" data-item_price="<?php echo esc_html( get_post_meta( get_the_ID(), 'txt_automobile_price', true ) ); ?>" class="btn btn-success auto_mobile_add_to_cart" href="<?php echo esc_url(home_url('/auto-mobile/?addToCart='.get_the_ID())); ?>">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php  endwhile;
        }
    }

  }
}
?>