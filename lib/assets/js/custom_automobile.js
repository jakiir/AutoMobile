jQuery( function( $ ) {
	$( document ).on( 'click', '.auto_mobile_add_to_cart', function(e) {		
		var $thisbutton = $( this );
		//$('.addToCartLodding').removeClass( 'addToCartLodding' );
		$thisbutton.parent().addClass('addToCartLodding');	
		var item_id = $thisbutton.attr('data-item_id');
		var item_sku = $thisbutton.attr('data-item_sku');
		var quantity = $thisbutton.attr('data-quantity');
		var item_price = $thisbutton.attr('data-item_price');		
				
		$.ajax({
		  type: 'POST',
		  url: adminUrl.ajaxurl,
		  data: {
		  action: 'autoMobileAddToCart',
		  itemId:item_id,
		  itemSku:item_sku,
		  quantity:quantity,
		  itemPrice:item_price
		  },
		  success: function(data, textStatus, XMLHttpRequest){			  
			  $thisbutton.parent().removeClass('addToCartLodding');
		  },
		  error: function(MLHttpRequest, textStatus, errorThrown){
			alert(errorThrown);
		  }
		  
		  });
		
		return false;
		
	});
	
	$( document ).on( 'click', '.itemRemoveBtn', function(e) {		
		var $thisbutton = $( this );		
		$thisbutton.parent().addClass('addToCartLodding');	
		var item_id = $thisbutton.attr('data-item_id');
		var item_key = $thisbutton.attr('data-item_key');			
				
		$.ajax({
		  type: 'POST',
		  url: adminUrl.ajaxurl,
		  data: {
		  action: 'autoMobileRemoveCart',
		  itemId:item_id,
		  item_key:item_key
		  },
		  success: function(data, textStatus, XMLHttpRequest){
			  //console.log(data);
			  $thisbutton.parent().removeClass('addToCartLodding');
			  location.reload();
		  },
		  error: function(MLHttpRequest, textStatus, errorThrown){
			alert(errorThrown);
		  }
		  
		  });
		
		return false;
		
	});
	
});