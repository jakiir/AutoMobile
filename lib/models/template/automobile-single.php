<?php
 /*Template Name: New Template
 */
 $automobile_options = get_option('automobile_options');
get_header(); ?>
<div id="">
    <div id="" role="main">
    <?php  while ( have_posts() ) : the_post();    
    $pid=$post->ID;   
    $post_image= wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
    $author = get_the_author(get_the_ID($post->ID));?>

<div class="container-fluid">
    <div class="content-wrapper">	
		<div class="item-container">	
			<div class="container">	
            
            <h2><?php echo esc_attr($automobile_options['automobile_order_send_email']); ?></h2>
            	<div class="col-md-5 service-image-left">				                   
						<center>
							<img id="item-display" src="<?php echo $post_image; ?>" alt=""></img>
						</center>				
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
						<button type="button" class="btn btn-success">
							Add to cart 
						</button>
					</div>	
                    
                    			
				</div>
			</div> 
		</div>
		<div class="container-fluid">		
			<div class="col-md-12 product-info">
					<ul id="myTab" class="nav nav-tabs nav_tabs">
						
						<li class="active"><a href="#service-one" data-toggle="tab">DESCRIPTION</a></li>
						<li><a href="#service-two" data-toggle="tab">MPN</a></li>
						<li><a href="#service-three" data-toggle="tab">Advanced</a></li>
						
					</ul>
				<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade in active" id="service-one">
						 
							<section class="container product-info">
							  <?php the_content(); ?>
							</section>
										  
						</div>
					<div class="tab-pane fade" id="service-two">
						
                    <section class="container product-info" >
                    
                    <ul>
						<?php 
						$get_automobile_mpn = get_post_meta($post->ID, 'txt_automobile_mpn', true);
						$get_automobile_mpn_uns = unserialize($get_automobile_mpn);			
						foreach($get_automobile_mpn_uns as $get_automobile_mpn_un): ?>
							<li><?php echo $get_automobile_mpn_un; ?></li>
						<?php endforeach; ?>
                    </ul>
                    </section>
						
					</div>
					<div class="tab-pane fade" id="service-three">  
                      <section class="container product-info" >  

					  <?php
						$get_advanced_automobile_array = get_post_meta($post->ID, 'advanced_automobile', true);
						$get_advanced_automobile = unserialize($get_advanced_automobile_array); 
					  ?>
					  
                    <p>make: <?php echo $get_advanced_automobile['txt_automobile_make']; ?></p> 
                    <p>model:<?php echo $get_advanced_automobile['txt_automobile_model']; ?></p> 
                    <p>year :<?php echo $get_advanced_automobile['txt_automobile_year']; ?></p> 
                    <p>color:<?php echo $get_advanced_automobile['txt_automobile_color']; ?></p> 
                    <p>position:<?php echo $get_advanced_automobile['txt_automobile_position']; ?></p> 
					<p>Weight (oz):<?php echo $get_advanced_automobile['txt_automobile_weight']; ?></p>
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
              