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
	
	$( document ).on( 'change', '#selectCountry', function(e) {
        var $thisbutton = $( this );
		$thisval = $thisbutton.val()
		//alert($thisbutton.val());
		
		$.ajax({
          type: 'POST',
          url: adminUrl.ajaxurl,
          data: {
          action: 'get_country_state',
          country:$thisval          
          },
          success: function(data, textStatus, XMLHttpRequest){
			var obj = jQuery.parseJSON(data);			
			if(obj['success'] == true){
				$('.checkout_town_city').html('');
				$('#checkout_town_city').show();
				var value_dum = '';
				$('#checkout_town_city').html('');
				$('#checkout_town_city').append('<option value="' + value_dum + '">Select One</option>');			
				for (var prop in obj[$thisval]) {			 
					$('#checkout_town_city').append('<option value="'+prop+'">' + obj[$thisval][prop] + '</option>'); 			 
				}	
			} else {
				$('#checkout_town_city').hide();
				$('.checkout_town_city').html('').html('<input type="test" name="town_city" class="form-control"/>');
			}	
          },
          error: function(MLHttpRequest, textStatus, errorThrown){
            alert(errorThrown);
          }

          });
		
	return false;
    });

});