<?php
add_action( 'init', 'automobile_product' );
function automobile_product() {
    register_post_type( 'tlp_automobile',
        array(
            'labels' => array(
                'name' => 'Automobiles',
                'singular_name' => 'Automobile',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Automobile',
                'edit' => 'Edit',
                'edit_item' => 'Edit Automobile',
                'new_item' => 'New Automobile',
                'view' => 'View',
                'view_item' => 'View Automobile',
                'search_items' => 'Search Automobiles',
                'not_found' => 'No Automobiles found',
                'not_found_in_trash' => 'No Automobiles found in Trash',
                'parent' => 'Parent Automobile'
            ),
 
            'public' => true,
            'menu_position' => 15,
            'supports' => array( 'title', 'editor', 'comments', 'thumbnail', 'custom-fields' ),
            'taxonomies' => array( '' ),
            'menu_icon' => plugins_url( '../assets/images/image.png', __FILE__ ),
            'has_archive' => true
        )
    );
}


add_action( 'init', 'automobile_taxonomies', 0 );
function automobile_taxonomies() {
    register_taxonomy(
        'automobile_product_category',
        'tlp_automobile',
        array(
            'labels' => array(
                'name' => 'AutoMobile Category ',
                'add_new_item' => 'Add New Category',
                'new_item_name' => "New AutoMobile Type Category"
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true
        )
    );
}
add_filter( 'manage_edit-tlp_automobile_columns', 'automobile_columns' );

 function tlp_automobile_meta_box($post_type, $post)
        {
            add_meta_box(
            'tlp_automobile_discount',
            __('Automobile Discount ', 'automobile_plugin'),
            'automobile_discount_meta_box',
            'tlp_automobile',
            'normal', 
            'high'
        );
    }		

 add_action('add_meta_boxes', 'tlp_automobile_meta_box', 10, 2);  
function automobile_discount_meta_box($post, $args){
   wp_nonce_field(plugins_url(__FILE__), 'automobile_plugin_noncename');    
   $prfx_stored_meta = get_post_meta( $post->ID );
?>
<div class="automobile-meta">
 <ul class='tabs tabs-menu'>
    <li><a href='#general'>General</a></li>    
    <li><a href='#mpn'>MPN</a></li>
    <li><a href='#advanced'>advanced</a></li>
    <li><a href='#options'>Options</a></li>
  </ul>
  <div class="automobile-meta-boxs">
  <div id='general'>
    <p>
       <label class="left-lable"  for="txt_automobile_sku"><?php _e('SKU', 'automobile_plugin'); ?>: </label>
       <input type="text" name="txt_automobile_sku" size="50" value="<?php echo get_post_meta($post->ID, 'txt_automobile_sku', true); ?>" />
       <!--<span class="tip"><a rel="tooltip" title="A paragraph typically consists of a unifying main point, thought, or idea accompanied by <b>supporting details</b>">paragraph</a></span>-->
   </p>
   <div class="border-sep"></div>
   <p>
       <label class="left-lable"  for="txt_automobile_regular_price"><?php _e('Regular Price ($)', 'automobile_plugin'); ?>: </label>
       <input type="number" name="txt_automobile_regular_price" size="50" value="<?php echo get_post_meta($post->ID, 'txt_automobile_regular_price', true); ?>" />
       <em></em>
   </p>
  <p>
       <label class="left-lable"  for="txt_automobile_price"><?php _e('Price ($)', 'automobile_plugin'); ?>: </label>
       <input type="number" name="txt_automobile_price" size="50" value="<?php echo get_post_meta($post->ID, 'txt_automobile_price', true); ?>" />
       <em></em>
   </p>
   <div class="border-sep"></div>
   <p>
   
    <label for="left-lable" class="left-lable"><?php _e( 'Stock status', 'automobile_plugin' )?>:</label>
    <select name="automobile-product-status" id="meta-select">
        <option value="instock" <?php if ( isset ( $prfx_stored_meta['automobile-product-status'] ) ) selected( $prfx_stored_meta['automobile-product-status'][0], 'instock' ); ?>><?php _e( 'In stock', 'automobile_plugin' )?></option>';
        <option value="Outofstock" <?php if ( isset ( $prfx_stored_meta['automobile-product-status'] ) ) selected( $prfx_stored_meta['automobile-product-status'][0], 'Outofstock' ); ?>><?php _e( 'Out of stock', 'automobile_plugin' )?></option>';
    </select>
</p>
   <p>
       <label class="left-lable"  for="txt_automobile_qty"><?php _e('Qty', 'automobile_plugin'); ?>: </label>
       <input type="number" name="txt_automobile_qty" size="50" value="<?php echo get_post_meta($post->ID, 'txt_automobile_qty', true); ?>" />
       <em></em>
   </p>
  </div>
  
  <div id='mpn'>  
    <div class="automobile_mpn">
        <?php if(empty($prfx_stored_meta)): ?>  
        <p>
            <input type="text" name="txt_automobile_mpn" size="50" value="<?php echo get_post_meta($post->ID, 'txt_automobile_mpn', true); ?>" />
        </p>
        <p><span class=" add_more button button-primary button-large" style="margin-left:5px; margin-top:5xp;">Add More</span></p>
        <?php else:            
			$get_automobile_mpn = get_post_meta($post->ID, 'txt_automobile_mpn', true);
			$get_automobile_mpn_uns = unserialize($get_automobile_mpn);
			if($get_automobile_mpn_uns):
			foreach($get_automobile_mpn_uns as $get_automobile_mpn_un): ?>
				<p>
					<input size="50" name='txt_automobile_mpn[]' type='text' class='in_box'  value="<?php echo $get_automobile_mpn_un; ?>" />
					<span class="rem"><a href='javascript:void(0);' ><span class="dashicons dashicons-dismiss"></span></a></span>
				</p>
			<?php endforeach; endif; ?>
            <p> <span class="add_more button button-primary button-large"><?php _e('Add More', 'automobile_plugin'); ?></span> </p>
        <?php endif;?>
    </div> 
   
  </div>
<div id='advanced'> 
<?php 
$get_advanced_automobile_array = get_post_meta($post->ID, 'advanced_automobile', true);
$get_advanced_automobile = unserialize($get_advanced_automobile_array); 
?>
<p>
       <label class="left-lable"  for="txt_automobile_make"><?php _e('Make', 'automobile_plugin'); ?>: </label>
       <input type="text" name="txt_automobile_make" size="50" value="<?php echo $get_advanced_automobile['txt_automobile_make']; ?>" />
       <em></em>
   </p>
    <p>
       <label class="left-lable"  for="txt_automobile_model"><?php _e('Model', 'automobile_plugin'); ?>: </label>
       <input type="text" name="txt_automobile_model" size="50" value="<?php echo $get_advanced_automobile['txt_automobile_model']; ?>" />
       <em></em>
   </p>
   
   <p>
       <label class="left-lable"  for="txt_automobile_year"><?php _e('Year', 'automobile_plugin'); ?>: </label>
       <input type="text" class="txt_automobile_year" id="txt_automobile_year" name="txt_automobile_year" size="50" value="<?php echo $get_advanced_automobile['txt_automobile_year']; ?>" />
       <em></em>
   </p>
   <p>
       <label class="left-lable"  for="txt_automobile_color"><?php _e('Color', 'automobile_plugin'); ?>: </label>
       <input type="text" name="txt_automobile_color" size="50" value="<?php echo $get_advanced_automobile['txt_automobile_color']; ?>" />
       <em></em>
   </p>
   <p>
       <label class="left-lable"  for="txt_automobile_position"><?php _e('Position', 'automobile_plugin'); ?>: </label>
       <input type="text" name="txt_automobile_position" size="50" value="<?php echo $get_advanced_automobile['txt_automobile_position']; ?>" />
       <em></em>
   </p>  
   <p>
       <label class="left-lable"  for="txt_automobile_weight"><?php _e('Weight (oz)', 'automobile_plugin'); ?>: </label>
       <input type="text" name="txt_automobile_weight" size="50" value="<?php echo $get_advanced_automobile['txt_automobile_weight']; ?>" />
       <em></em>
   </p>
</div>
  <div id="options">  
    <p>
        <label class="left-lable"  for="inquiry"><?php _e('Product Inquiry', 'automobile_plugin'); ?>: </label>
        <input type="checkbox" class="ckb-inquiry" name="inquiry" id="inquiry" value="yes" <?php if ( isset ( $prfx_stored_meta['inquiry'] ) ) checked( $prfx_stored_meta['inquiry'][0], 'yes' ); ?> />
        <?php _e( ' Yes / No', 'automobile_plugin' )?>
    </p>
     <p>
       <label class="left-lable"  for="txt_automobile_weight2"><?php _e('if need meta box (EX:Jakir vi)', 'automobile_plugin'); ?>: </label>
       <input type="text" name="txt_automobile_weight2" size="50" value="<?php echo get_post_meta($post->ID, 'txt_automobile_weight2', true); ?>" />
       <em></em>
   </p>
  </div>
   </div>   
  </div>  
<?php


}
add_action('save_post', 'automobile_save_meta_box', 10, 2);
function automobile_save_meta_box($post_id, $post)
{
   if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
       return;

   if('page' == $_POST['post_type'])
   {
       if(!current_user_can('edit_page', $post_id))
           return;
   }
   else
       if(!current_user_can('edit_post', $post_id))
           return;

   if(isset($_POST['automobile_plugin_noncename']) && wp_verify_nonce($_POST['automobile_plugin_noncename'], plugins_url(__FILE__)) && check_admin_referer(plugins_url(__FILE__), 'automobile_plugin_noncename'))
   {       
       
       if( isset( $_POST[ 'txt_automobile_sku' ] ) ) {                        
		  update_post_meta($post_id, 'txt_automobile_sku', $_POST['txt_automobile_sku']);			
		} else {
			delete_post_meta( $post_id, 'txt_automobile_sku' );  			
		}     
		
            if( isset( $_POST[ 'txt_automobile_regular_price' ] ) ) {                        
                      update_post_meta($post_id, 'txt_automobile_regular_price', $_POST['txt_automobile_regular_price']);
                    } else {                        
                        delete_post_meta( $post_id, 'txt_automobile_regular_price' );                         
                    }       
					
            if( isset( $_POST[ 'txt_automobile_price' ] ) ) {                        
                      update_post_meta($post_id, 'txt_automobile_price', $_POST['txt_automobile_price']);                        
                    } else { delete_post_meta( $post_id, 'txt_automobile_price' ); } 

					
            if( isset( $_POST[ 'txt_automobile_qty' ] ) ) {                        
                      update_post_meta($post_id, 'txt_automobile_qty', $_POST['txt_automobile_qty']);                        
                    } else { delete_post_meta( $post_id, 'txt_automobile_qty' );} 
					
              if( isset( $_POST[ 'automobile-product-status' ] ) ) {                        
                      update_post_meta($post_id, 'automobile-product-status', $_POST['automobile-product-status']);
                    } else {delete_post_meta( $post_id, 'automobile-product-status' ); }         
                    
					
            if( isset( $_POST[ 'txt_automobile_make' ] ) ) 
			{ $txt_automobile_make = $_POST[ 'txt_automobile_make' ]; } else { $txt_automobile_make = ''; } 
            if( isset( $_POST[ 'txt_automobile_model' ] ) ) 
			{ $txt_automobile_model = $_POST['txt_automobile_model'];} else { $txt_automobile_model = ''; }  
			
            if( isset( $_POST[ 'txt_automobile_year' ] ) ) 
			{ $txt_automobile_year = $_POST[ 'txt_automobile_year' ]; } else { $txt_automobile_year = ''; }
			
            if( isset( $_POST[ 'txt_automobile_color' ] ) ) 
			{ $txt_automobile_color = $_POST[ 'txt_automobile_color' ]; } else { $txt_automobile_color = ''; } 
		
            if( isset( $_POST[ 'txt_automobile_position' ] ) ) 
			{ $txt_automobile_position = $_POST[ 'txt_automobile_position' ]; } else { $txt_automobile_position = ''; }
		
			if( isset( $_POST[ 'txt_automobile_weight' ] ) ) 
			{ $txt_automobile_weight = $_POST[ 'txt_automobile_weight' ]; } else { $txt_automobile_weight = ''; } 
			
		$advanced_automobile_array = array(
			'txt_automobile_make'   => $txt_automobile_make,
			'txt_automobile_model'	=> $txt_automobile_model,
			'txt_automobile_year'	=> $txt_automobile_year,
			'txt_automobile_color'	=> $txt_automobile_color,
			'txt_automobile_position' => $txt_automobile_position,
			'txt_automobile_weight'		=> $txt_automobile_weight
			);
			
		$advanced_automobile = serialize($advanced_automobile_array);
		update_post_meta($post_id, 'advanced_automobile', $advanced_automobile);		
					
					
            if( isset( $_POST[ 'txt_automobile_mpn' ] ) )        
                    {
                        $combined = $_POST['txt_automobile_mpn'];
						$automobile_mpn = serialize($combined);
                        //$pics=implode('|',$combined);					
                        update_post_meta($post_id, 'txt_automobile_mpn', $automobile_mpn);
                    }
                    else 
                    {
                        delete_post_meta( $post_id, 'txt_automobile_mpn' );
                    }      
             
             
                  if( isset( $_POST[ 'monday-checkbox' ] ) ) {            
            update_post_meta( $post_id, 'monday-checkbox', 'yes' );            
        } else {            
            update_post_meta( $post_id, 'monday-checkbox', 'no' );            
        }  
   }
   return;
}
?>