<?php
 /*Template Name: checkout*/
 
 $automobile_options = get_option('automobile_options');
 
get_header(); 
?>
<div style="height: 200px;"></div>
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-6">
          
       <form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Form Name</legend>
<div id="checkout_mess"></div>
<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="checkout_email">Email Address *</label>
  <div class="controls">
    <input id="checkout_email" name="email" placeholder="Email Address " class="form-control" type="text">
    
  </div>
</div>

<!-- Password input-->
<div class="control-group">
  <label class="control-label" for="checkout_password">Password</label>
  <div class="controls">
    <input id="checkout_password" name="checkout_password" placeholder="******" class="form-control" required="" type="password">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="checkout_first_name">First Name</label>
  <div class="controls">
    <input id="checkout_first_name" name="checkout_first_name" placeholder="First Name" class="form-control" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="checkout_last_name">Last Name</label>
  <div class="controls">
    <input id="checkout_last_name" name="checkout_last_name" placeholder="Last Name" class="form-control" type="text">
    
  </div>
</div>

<!-- Textarea -->
<div class="control-group">
  <label class="control-label" for="checkout_address">Address</label>
  <div class="controls">                     
    <textarea id="checkout_address" class="form-control" name="checkout_address">Address</textarea>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="checkout_phone">Phone</label>
  <div class="controls">
    <input id="checkout_phone" name="checkout_phone" placeholder="Phone " class="form-control" required="" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="checkout_company_name">Company Name</label>
  <div class="controls">
    <input id="checkout_company_name" name="checkout_company_name" placeholder="Company Name" class="form-control" required="" type="text">
    
  </div>
</div>

<div class="control-group">
  <label class="control-label" for="selectCountry">Select Country</label>
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
  <label class="control-label" for="checkout_postcode">Postcode / Zip</label>
  <div class="controls">
    <input id="checkout_postcode" onkeyup="check_number(this)" onkeypress="check_number(this)" name="checkout_postcode" placeholder="Postcode / Zip" class="form-control" type="text">
    
  </div>
</div>

<!-- Select Basic -->
<div class="control-group">
  <label class="control-label" for="checkout_town_city">Town / City</label>
  <div class="controls">	
    <select id="checkout_town_city" name="town_city" class="form-control">
      <option value="">Select One</option>      
    </select>
	<span class="checkout_town_city"></span>
  </div>
</div>

<!-- Textarea -->
<div class="control-group">
  <label class="control-label" for="checkout_notes">Notes </label>
  <div class="controls">                     
    <textarea  class="form-control" id="checkout_notes" name="checkout_notes">Notes</textarea>
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
        <form action="" method="">
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
<input type="hidden" name="product_names[]" value="<?php echo get_the_title( $itemId ); ?>"/>
<input type="hidden" name="product_item_price[]" value="<?php echo $item_price/$item_quantity; ?>"/>
<input type="hidden" name="product_total_price[]" value="<?php echo $item_price; ?>"/>
<input type="hidden" name="product_quantity[]" value="<?php echo $item_quantity; ?>"/>
<input type="hidden" name="product_shipping" value="0.00"/>
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
        </form>
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
    <a id="automobile_place_order" href="javascript:void(0)" name="automobile_place_order" class="btn btn-primary">Place order</a>
  </div>
</div>
            </div>
            <!-- Button -->

        </div>

    

  <div class="row">
  
</div>
</div>
<?php get_footer(); ?>
              