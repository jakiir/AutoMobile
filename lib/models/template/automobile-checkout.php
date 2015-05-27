<?php
 /*Template Name: checkout*/
 
 $automobile_options = get_option('automobile_options');
 
get_header(); ?>
<div style="height: 200px;"></div>
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-6">
          
       <form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Form Name</legend>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="email">Email Address *</label>
  <div class="controls">
    <input id="email" name="email" placeholder="Email Address " class="form-control" type="text">
    
  </div>
</div>

<!-- Password input-->
<div class="control-group">
  <label class="control-label" for="passwordinput">Password</label>
  <div class="controls">
    <input id="passwordinput" name="passwordinput" placeholder="placeholder" class="form-control" required="" type="password">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="textinput">First Name</label>
  <div class="controls">
    <input id="textinput" name="textinput" placeholder="First Name" class="form-control" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="last_name">Last Name</label>
  <div class="controls">
    <input id="last_name" name="last_name" placeholder="Last Name" class="form-control" type="text">
    
  </div>
</div>

<!-- Textarea -->
<div class="control-group">
  <label class="control-label" for="address">Address</label>
  <div class="controls">                     
    <textarea id="address" class="form-control" name="address">Address</textarea>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="phone ">Phone </label>
  <div class="controls">
    <input id="phone " name="phone " placeholder="Phone " class="form-control" required="" type="text">
    
  </div>
</div>

<!-- Select Basic -->
<div class="control-group">
  <label class="control-label" for="selectbasic">Select Basic</label>
  <div class="controls">
    <select id="selectbasic" name="selectbasic" class="form-control">
      <option>Option one</option>
      <option>Option two</option>
    </select>
  </div>
</div>

<div class="control-group">
  <label class="control-label" for="selectbasic">Select Country</label>
  <div class="controls">
  <?php
		global $autoMobile;
		$countryList = $autoMobile->create_countryList();
		
	?>
    <select id="selectCountry" name="selectCountry" class="form-control">
		<option value="">Country</option>
		<?php 
		foreach($countryList as $ckey => $cvalue) {
			$marked = ( $ckey == $_REQUEST['country'] ? 'selected="selected"' : null );
			echo "<option value='$ckey' $marked>$cvalue</option>";
		}
		?>
    </select>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="postcode">Postcode / Zip</label>
  <div class="controls">
    <input id="postcode" name="postcode" placeholder="Postcode / Zip" class="form-control" type="text">
    
  </div>
</div>

<!-- Select Basic -->
<div class="control-group">
  <label class="control-label" for="town_city">Town / City</label>
  <div class="controls">
    <select id="town_city" name="town_city" class="form-control">
      <option>Option one</option>
      <option>Option two</option>
    </select>
  </div>
</div>

<!-- Textarea -->
<div class="control-group">
  <label class="control-label" for="Notes ">Notes </label>
  <div class="controls">                     
    <textarea  class="form-control" id="Notes " name="Notes ">Notes </textarea>
  </div>
</div>



</fieldset>
</form>
    </div>
    <div class="col-sm-6 col-md-6">
	<?php
        @session_start();
        $sessionId = session_id();
        $auto_mobile_info = '_auto_mobile_info_'.$sessionId;
        $get_mobile_info = get_option( $auto_mobile_info );
        if($get_mobile_info){
        $get_mobile_info_uns = @unserialize($get_mobile_info);
        if($get_mobile_info_uns){
        ?>
    <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Total</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
				<?php
                $totalPrice =0;
                $incr = 0;
                foreach($get_mobile_info_uns as $key=>$get_mobile_info_unss):
                $itemId = $get_mobile_info_unss['item_id'];
                $item_quantity = $get_mobile_info_unss['item_quantity'];
                $item_price = $get_mobile_info_unss['item_price'];
                $post_image = wp_get_attachment_url( get_post_thumbnail_id($itemId) );
                if($post_image): $postImage = $post_image; else : $postImage = 'http://placehold.it/72x72'; endif;
                $totalPrice += $item_price;
                ?>
                    <tr>
                        <td class="col-sm-8 col-md-6">
                        <div class="media">
                          
                            <div class="media-body">
                                <h4 class="media-heading"><a href="#"><?php echo get_the_title( $itemId ); ?></a></h4>
                                <h5 class="media-heading"> by <a href="#">Brand name</a></h5>
                               
                            </div>
                        </div></td>
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                        <span><?php echo $item_quantity; ?></span>
                        </td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>$<?php echo $item_price/$item_quantity; ?></strong></td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>$<?php echo $item_price; ?></strong></td>
                       
                    </tr>
			<?php $incr++; endforeach; ?>
                    
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h5>Subtotal</h5></td>
                        <td class="text-right"><h5><strong>$<?php echo $totalPrice; ?></strong></h5></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h5>Estimated shipping</h5></td>
                        <td class="text-right"><h5><strong>$0.00</strong></h5></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h3>Total</h3></td>
                        <td class="text-right"><h3><strong>$<?php echo $totalPrice; ?></strong></h3></td>
                    </tr>
                    
                </tbody>
            </table>
			<?php } else { ?>
        <article id="post-5" class="post-5 page type-page status-publish hentry">
                <header class="entry-header">

                <h1 class="entry-title">Cart</h1>
                </header><!-- .entry-header -->

                <div class="entry-content">
                <div class="">
                <p class="cart-empty">Your cart is currently empty.</p>
                <p class="return-to-auto-mobile"><a class="button wc-backward" href="<?php echo home_url('/auto-mobile/'); ?>">Return To Auto Mobile</a></p>
                </div>
                </div>
            </article>
        <?php } } else { ?>
            <article id="post-5" class="post-5 page type-page status-publish hentry">
                <header class="entry-header">

                <h1 class="entry-title">Cart</h1>
                </header><!-- .entry-header -->

                <div class="entry-content">
                <div class="">
                <p class="cart-empty">Your cart is currently empty.</p>
                <p class="return-to-auto-mobile"><a class="button wc-backward" href="<?php echo home_url('/auto-mobile/'); ?>">Return To Auto Mobile</a></p>
                </div>
                </div>
            </article>
        <?php } ?>
            <div class="control-group pull-right">
  <label class="control-label" for="Place order">Place order</label>
  <div class="controls">
    <button id="Place order" name="Place order" class="btn btn-primary">Place order</button>
  </div>
</div>
            </div>
            <!-- Button -->

        </div>

    

  <div class="row">
  
</div>
</div>
<?php get_footer(); ?>       
              