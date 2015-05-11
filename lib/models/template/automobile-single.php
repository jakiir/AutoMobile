<?php
 /*Template Name: New Template
 */
 $automobile_options = get_option('automobile_options');
get_header(); ?>
<div id="primary">
    <div id="content" role="main">
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
					<div class="product-price">$ <?php echo esc_html( get_post_meta( get_the_ID(), 'txt_automobile_price', true ) ); ?></div>
					<div class="product-stock"><?php echo esc_html( get_post_meta( get_the_ID(), 'automobile-product-status', true ) ); ?></div>
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
                    $main_top=get_post_meta($post->ID, 'txt_automobile_mpn', true);
                    $array_automobile_mpn=explode('|', $main_top);
                    $n=count($array_automobile_mpn);
                    for($i=0; $i<$n; $i++){
                    ?>
                    <li><?php echo $array_automobile_mpn[$i]; ?></li>
                    
                    <?php } ?>
                    </ul>
                    </section>
						
					</div>
					<div class="tab-pane fade" id="service-three">  
                      <section class="container product-info" >                 
                    <p>make: <?php echo esc_html( get_post_meta( get_the_ID(), 'txt_automobile_make', true ) ); ?></p> 
                    <p>model:   <?php echo esc_html( get_post_meta( get_the_ID(), 'txt_automobile_model', true ) ); ?> </p> 
                    <p>year :<?php echo esc_html( get_post_meta( get_the_ID(), 'txt_automobile_year', true ) ); ?></p> 
                    <p>color:<?php echo esc_html( get_post_meta( get_the_ID(), 'txt_automobile_color', true ) ); ?></p> 
                    <p>position:<?php echo esc_html( get_post_meta( get_the_ID(), 'txt_automobile_position', true ) ); ?></p> 
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
              