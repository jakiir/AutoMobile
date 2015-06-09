<?php
/* Template Name: Automobile archive */
?>
<?php get_header(); 
global $autoMobile;
?>

<section id="primary">
<div id="content" role="main">


<div class="container">
    <div class="well well-sm">
        <strong>Category Title</strong>
        <div class="btn-group">
            <a href="#" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list">
            </span>List</a> <a href="#" id="grid" class="btn btn-default btn-sm"><span
                class="glyphicon glyphicon-th"></span>Grid</a>
        </div>
		<!--<span class="mini_cart"><?php //echo $autoMobile->mini_cart(); ?></span>-->
    </div>
	<div class="search_list"><?php echo $autoMobile->automobile_search_list(); ?></div>
	<div class="category_list"><?php echo $autoMobile->automobile_taxonomies_terms(); 	?>
	
	</div>
    <div id="products" class="row list-group">

        <?php if ( have_posts() ) : ?>
          <header class="page-header">
          <h1 class="page-title">Movie Reviews</h1>
         </header>
        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		if($_GET['txt_automobile_year'] !='' || $_GET['txt_automobile_make'] != '' || $_GET['txt_automobile_model'] != '') :
		
		$atm_make = $_GET['txt_automobile_make'];
		$atm_model = $_GET['txt_automobile_model'];
		$atm_year = $_GET['txt_automobile_year'];
		
			$args = array(
				'post_type' => 'tlp_automobile',
				'post_status' => 'publish',
				'posts_per_page' => 3,
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
		else :
			$args = array(
				'post_type' => 'tlp_automobile',
				'post_status' => 'publish',
				'posts_per_page' => 3,
				'paged' => $paged
			);        
		endif;
        $autoMobile->get_all_automobiles($args);
        echo $autoMobile->automobile_pagination($args);
 endif; ?>
    </div>
</div>





  </div>
</section>
<?php get_footer(); ?>