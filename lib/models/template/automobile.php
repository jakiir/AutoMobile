<?php
/* Template Name: Automobile archive */
?>
<?php get_header(); 
global $autoMobile;
?>

<section class="main-container">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                 <!-- <div class="well well-sm">
        <strong>Category Title</strong>
        <div class="btn-group">
            <a href="#" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list">
            </span>List</a> <a href="#" id="grid" class="btn btn-default btn-sm"><span
                class="glyphicon glyphicon-th"></span>Grid</a>
        </div>
		
    </div>-->
	<?php if(!isset($_GET['txt_automobile_model'])) : ?>
				<div class="slider">
                   <img class="img-responsive" src="<?php echo esc_url( $autoMobile->assetsUrl ); ?>/images/slider.png" alt="slider" />
                </div>
                <div class="ctg-title">
                    <h2>Categories</h2>
                </div>
            <?php echo $autoMobile->automobile_taxonomies_terms(); 	?>
    <?php endif; ?>                                           
                <div class="ctg-title">
                    <h2>Latest Vehicles</h2>
                </div>
                
               <div id="products" class="row list-group">

        <?php if ( have_posts() ) : ?>          
        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		
		$atm_make = $_GET['txt_automobile_make'];
		$atm_model = $_GET['txt_automobile_model'];
		$atm_year = $_GET['txt_automobile_year'];
		$postLimit = 6;
		if(isset($_GET['txt_automobile_year']) && isset($_GET['txt_automobile_make']) && isset($_GET['txt_automobile_model'])) :	
			$args = array(
				'post_type' => 'tlp_automobile',
				'post_status' => 'publish',
				'posts_per_page' => $postLimit,
				'paged' => $paged,				
				'meta_query' => array(
							'relation' => 'AND',
					array(
							'key' => 'advanced_automobile_make',
							'value' => $atm_make,
							'compare' => 'LIKE',
					),
					array(
							'key' => 'advanced_automobile_model',
							'value' => $atm_model,
							'compare' => 'LIKE',
					),
					array(
							'key' => 'advanced_automobile_year',
							'value' => $atm_year,
							'compare' => 'LIKE',
					)					
				 )
			); 
		elseif($_GET['txt_automobile_model'] != '') :
			$args = array(
				'post_type' => 'tlp_automobile',
				'post_status' => 'publish',
				'posts_per_page' => $postLimit,
				'paged' => $paged,
				'meta_key'         => 'advanced_automobile_model',
				'meta_value'       => $atm_model				
			);
		elseif($_GET['product_category'] != '') :
			$args = array(
				'post_type' => 'tlp_automobile',
				'post_status' => 'publish',
				'posts_per_page' => $postLimit,
				'paged' => $paged,
				'tax_query' => array(
						array(
						  'taxonomy' => 'automobile_product_category',
						  'field' => 'id',
						  'terms' => $_GET['product_category'], 
						  'include_children' => false
						)
					  )				
			);
		else :
			$args = array(
				'post_type' => 'tlp_automobile',
				'post_status' => 'publish',
				'posts_per_page' => $postLimit,
				'paged' => $paged
			);        
		endif;
        $autoMobile->get_all_automobiles($args);
        echo $autoMobile->automobile_pagination($args);
 endif; 
 ?>
    </div>
                
              <!--<div class="row">
                    <div class="col-md-4">
                        <div class="latest-pro-box">
                            <img class="img-responsive" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/slider.png" alt="pro4" />
                            
                        </div>
                    </div>
                </div>-->
            </div>
            <div class="col-md-3">
               <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>