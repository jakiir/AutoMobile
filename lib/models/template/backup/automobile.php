 <?php
/* Template Name: Automobile archive */
?>
<?php get_header(); ?>


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
    </div>
    <div id="products" class="row list-group">
        
        <?php if ( have_posts() ) : ?>
          <header class="page-header">
          <h1 class="page-title">Movie Reviews</h1>
         </header>        
        <?php 
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array(
			'post_type' => 'tlp_automobile',
			'post_status' => 'publish',
			'posts_per_page' => 3,
			'paged' => $paged
		);	
		global $autoMobile;
		$autoMobile->get_all_automobiles($args);
		$autoMobile->automobile_pagination($args);
 endif; ?>
    </div>
</div>





  </div>
</section>
<?php get_footer(); ?>