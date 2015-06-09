<?php
 /*Template Name: Automobile single */

 $automobile_options = get_option('automobile_options');
get_header(); 
?>
<div id="">
    <div id="" role="main">
    <?php  while ( have_posts() ) : the_post();
        global $post;
    $pid=$post->ID;
    $post_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
    $author = get_the_author(get_the_ID($post->ID));
    global $autoMobile;
    ?>

<div class="container-fluid">
<!--<span class="mini_cart"><?php //echo $autoMobile->mini_cart(); ?></span>-->



    <div class="content-wrapper">
        <div class="item-container">
            <div class="container">

            <h2><?php //echo esc_attr($automobile_options['automobile_order_send_email']); ?></h2>
                <div class="col-md-5 service-image-left">
                        <div style="margin:0 auto;">
                            <?php echo $autoMobile->auto_mobile_thumbnail('400x250'); ?>
                            <!--<img id="item-display" src="<?php //echo $post_image; ?>" alt=""></img>-->
                        </div>
                </div>
                <div class="col-md-7">
                    <div class="product-title"><?php the_title(); ?></div>
                    <!--<div class="product-desc">The Corsair Gaming Series GS600 is the ideal price/performance choice for mid-spec gaming PC</div>-->
                    <hr>
                    <p class="price">
                    <?php $txt_automobile_regular_price = esc_html( get_post_meta( get_the_ID(), 'txt_automobile_regular_price', true ) );
                    if($txt_automobile_regular_price): ?>
                    <del><span class="amount">$<?php echo $txt_automobile_regular_price; ?>.00</span></del>
                    <?php endif;
                    $txt_automobile_price = esc_html( get_post_meta( get_the_ID(), 'txt_automobile_price', true ) );
                    if($txt_automobile_price):
                    ?>
                    <ins><span class="amount">$<?php echo $txt_automobile_price; ?>.00</span></ins>
                    <?php endif; ?>
                    </p>

                    <div class="product-stock">
                    <?php
                    $automobile_product_status = esc_html( get_post_meta( get_the_ID(), 'automobile-product-status', true ) );
                    if($automobile_product_status == 'instock' ):
                        echo 'In stock';
                    else :
                        echo 'Out of stock';
                    endif;
                    ?>

                    </div>
                    <hr>


                    <div class="btn-group cart">
                        <a data-item_id="<?php echo get_the_ID(); ?>" data-item_sku="<?php echo esc_html(get_post_meta(get_the_ID(), 'txt_automobile_sku', true)); ?>" data-quantity="1" data-item_price="<?php echo esc_html( get_post_meta( get_the_ID(), 'txt_automobile_price', true ) ); ?>" class="btn btn-success auto_mobile_add_to_cart" href="<?php echo esc_url(home_url('/auto-mobile/?addToCart='.get_the_ID())); ?>">Add to cart</a>
                    </div>


                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="col-md-12 product-info">
			<?php
				$get_advanced_automobile_array = get_post_meta($post->ID, 'advanced_automobile', true);
				$get_advanced_automobile = unserialize($get_advanced_automobile_array);
			?>
                    <ul id="myTab" class="nav nav-tabs nav_tabs">
 
						<li class="active"><a href="#product_details" data-toggle="tab">Product Details</a></li>
						<li><a href="#applications" data-toggle="tab">Applications</a></li>
						<li><a href="#product_inquiry" data-toggle="tab">Product Inquiry</a></li>						 
                        <li><a href="#service-one" data-toggle="tab">DESCRIPTION</a></li>
                        <li><a href="#service-two" data-toggle="tab">MPN</a></li>                        

                    </ul>
                <div id="myTabContent" class="tab-content">				
						<div class="tab-pane fade in active" id="product_details">

                            <section class="container product-details">
                              <p>
								<span class="adv_head">Color </span>
								<span class="adv_result">:
									<?php echo $get_advanced_automobile['txt_automobile_color']; ?>
								</span>
							</p>
							<p>
								<span class="adv_head">Position </span>
								<span class="adv_result">:
								<?php echo $get_advanced_automobile['txt_automobile_position']; ?>
								</span>
							</p>
							<p>
								<span class="adv_head">MPN </span>
								<span class="adv_result">:
									
										<?php
										echo get_post_meta($post->ID, 'txt_automobile_mpn', true);
											/* $get_automobile_mpn = get_post_meta($post->ID, 'txt_automobile_mpn', true);
											$get_automobile_mpn_uns = unserialize($get_automobile_mpn);
											if($get_automobile_mpn_uns):
											foreach($get_automobile_mpn_uns as $get_automobile_mpn_un): ?>
												<li><?php echo $get_automobile_mpn_un; ?></li>
										<?php endforeach; endif; */ ?>
									
								</span>
							</p>
                            </section>

                        </div>
						<div class="tab-pane fade" id="applications">

                            <section class="container applications">
								<p>
									<span class="adv_head">Year </span>
									<span class="adv_result">:
										<?php 
										$txt_automobile_year = get_post_meta($post->ID, 'advanced_automobile_year', true); 
										$auto_mobile_year = '_auto_mobile_year';
										$get_auto_mobile_year = get_option( $auto_mobile_year );
										$get_auto_mobile_year_uns = @unserialize($get_auto_mobile_year);
										echo $get_auto_mobile_year_uns[$txt_automobile_year]; 
										?>										
									</span>
								</p>
								<p>
									<span class="adv_head">Make </span>
									<span class="adv_result">:
										<?php 
											if ( isset ( $get_advanced_automobile['txt_automobile_make'] ) )
											$txt_automobile_make = $get_advanced_automobile['txt_automobile_make'];
											$auto_mobile_make = '_auto_mobile_make';
											$get_auto_mobile_make = get_option( $auto_mobile_make );
											$get_auto_mobile_make_uns = @unserialize($get_auto_mobile_make);
											echo $get_auto_mobile_make_uns[$txt_automobile_make]; 
										?>
									</span>
									</p>
									<p>
										<span class="adv_head">Model </span>
										<span class="adv_result">:
										<?php 
											if ( isset ( $get_advanced_automobile['txt_automobile_model'] ) )
											$txt_automobile_model = $get_advanced_automobile['txt_automobile_model'];
											$auto_mobile_model = '_auto_mobile_model';
											$get_auto_mobile_model = get_option( $auto_mobile_model );
											$get_auto_mobile_model_uns = @unserialize($get_auto_mobile_model);
											echo $get_auto_mobile_model_uns[$txt_automobile_model];
										?>
										</span>
									</p>
									<p>
										<span class="adv_head">Position </span>
										<span class="adv_result">:
										<?php echo $get_advanced_automobile['txt_automobile_position']; ?>
										</span>
									</p>
									<p>
										<span class="adv_head">Application Notes </span>
										<span class="adv_result">:
											<?php the_content(); ?>
										</span>
									</p>
                            </section>

                        </div>
						<div class="tab-pane fade" id="product_inquiry">

                            <section class="container product-inquiry">
								<div id="enquiry_msg"></div>
								<form action="" method="post">
								  <div class="form-group">
									<label for="your_name">Your Name <span class="requird">*</span></label>
									<input type="text" class="form-control" id="your_name" placeholder="Your Name">
								  </div>
								  <div class="form-group">
									<label for="email_address">Email address <span class="requird">*</span></label>
									<input type="email" name="email_address" class="form-control" id="email_address" placeholder="Enter email">
								  </div>
								  <div class="form-group">
									<label for="parts">Part # (automatically fill)</label>
									<input type="text" name="inquiry_parts" class="form-control" id="inquiry_parts" placeholder="Part # (automatically fill)">
								  </div>
								  <div class="form-group">
									<label for="product_inquiry">Product Inquiry <span class="requird">*</span></label>
									<textarea name="product_inquiry" id="product_inquiry" class="form-control" rows="3"></textarea>									
								  </div>
								  <span>							  
								  <button type="submit" id="inquiry_submit" class="btn btn-default">Submit</button>
								  </span>
								</form>
                            </section>

                        </div>
                        <div class="tab-pane fade" id="service-one">

                            <section class="container product-info">
                              <?php the_content(); ?>
                            </section>

                        </div>
                    <div class="tab-pane fade" id="service-two">

                    <section class="container product-info">
						<?php echo get_post_meta($post->ID, 'txt_automobile_mpn', true); ?>
                    </section>

                    </div>
                    
                </div>
                <hr>
            </div>
        </div>
    </div>
</div>

   <?php endwhile;  ?>
   </div>
</div>

<?php get_footer(); ?>
