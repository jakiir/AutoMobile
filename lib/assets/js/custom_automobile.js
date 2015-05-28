jQuery( function( $ ) {
    $( document ).on( 'click', '.auto_mobile_add_to_cart', function(e) {
        var $thisbutton = $( this );
        //$('.addToCartLodding').removeClass( 'addToCartLodding' );
        $thisbutton.parent().addClass('addToCartLodding');
        var item_id = $thisbutton.attr('data-item_id');
        var item_sku = $thisbutton.attr('data-item_sku');
        var quantity = $thisbutton.attr('data-quantity');
        var item_price = $thisbutton.attr('data-item_price');
		
		var total_qty = parseInt($('.cart_item').attr('data-qty'));		
		var now_qty = total_qty + parseInt(quantity);
		
		var total_price = parseInt($('.cart_price').attr('data-price'));		
		var now_price = total_price + parseInt(item_price);
		
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
			  $('.cart_item').attr('data-qty', now_qty).html(now_qty);
			  $('.cart_price').attr('data-price', now_price).html('$' + now_price);
			  $('.view_cart').show();;
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
				$('.checkout_town_city').html('').html('<input type="test" id="town_city_text" name="town_city_text" class="form-control"/>');
			}	
          },
          error: function(MLHttpRequest, textStatus, errorThrown){
            alert(errorThrown);
          }
          });
		
	return false;
    });
	
	$( document ).on( 'click', '#automobile_place_order', function(e) {
        var $thisbutton = $( this );
		
		var checkout_email = $('#checkout_email').val();
		if (checkout_email==null || checkout_email=="")
		  {
		  $('#checkout_mess').html('<span class="error">Email is required!</span>');
		  $('#checkout_email').focus();
		  $('#checkout_email').select();
			return false;
		  } else {
			$('#checkout_mess').html('');
		  }
		  if(!IsEmail(checkout_email)){
			$('#checkout_mess').html('<span class="error">Email is not valid!</span>');
			$('#checkout_email').focus();
			$('#checkout_email').select();
			return false;
		  }else {
			$('#checkout_mess').html('');
		  }		  
		 
		var checkout_password = $('#checkout_password').val();
		if (checkout_password==null || checkout_password=="")
		  {
			$('#checkout_mess').html('<span class="error">Password is required!</span>');
			$('#checkout_password').focus();
			$('#checkout_password').select();
			return false;
		  } else {
			$('#checkout_mess').html('');
		  }
		if (checkout_password.length < 6)
		  {
			$('#checkout_mess').html('<span class="error">Password is 6 disit must!</span>');
			$('#checkout_password').focus();
			$('#checkout_password').select();
			return false;
		  } else {
			$('#checkout_mess').html('');
		  }
		var checkout_first_name = $('#checkout_first_name').val();
		if (checkout_first_name==null || checkout_first_name=="")
		  {
			$('#checkout_mess').html('<span class="error">First Name is required!</span>');
			$('#checkout_first_name').focus();
			$('#checkout_first_name').select();
			return false;
		  } else {
			$('#checkout_mess').html('');
		  }
		var checkout_last_name = $('#checkout_last_name').val();
		if (checkout_last_name==null || checkout_last_name=="")
		  {
			$('#checkout_mess').html('<span class="error">Last Name is required!</span>');
			$('#checkout_last_name').focus();
			$('#checkout_last_name').select();
			return false;
		  } else {
			$('#checkout_mess').html('');
		  }
		var checkout_address = $('#checkout_address').val();
		if (checkout_address==null || checkout_address=="")
		  {
			$('#checkout_mess').html('<span class="error">Address is required!</span>');
			$('#checkout_address').focus();
			$('#checkout_address').select();
			return false;
		  } else {
			$('#checkout_mess').html('');
		  }
		var checkout_phone = $('#checkout_phone').val();
		if (checkout_phone==null || checkout_phone=="")
		  {
			$('#checkout_mess').html('<span class="error">Phone is required!</span>');
			$('#checkout_phone').focus();
			$('#checkout_phone').select();
			return false;
		  } else {
			$('#checkout_mess').html('');
		  }
		var checkout_company_name = $('#checkout_company_name').val();
		var selectCountry = $('#selectCountry').val();
		if (selectCountry==null || selectCountry=="")
		  {
			$('#checkout_mess').html('<span class="error">Country is required!</span>');
			$('#selectCountry').focus();
			$('#selectCountry').select();
			return false;
		  } else {
			$('#checkout_mess').html('');
		  }
		var checkout_postcode = $('#checkout_postcode').val();
		if (checkout_postcode==null || checkout_postcode=="")
		  {
			$('#checkout_mess').html('<span class="error">Post code is required!</span>');
			$('#checkout_postcode').focus();
			$('#checkout_postcode').select();
			return false;
		  } else {
			$('#checkout_mess').html('');
		  }
		
		  
		if (document.getElementById("town_city_text")) {
			var checkout_town_city = $('#town_city_text').val();
			if (checkout_town_city==null || checkout_town_city=="")
		  {
			$('#checkout_mess').html('<span class="error">City is required!</span>');
			$('#town_city_text').focus();
			$('#town_city_text').select();			
			return false;
		  } else {
			$('#checkout_mess').html('');
		  }
		} else {
			var checkout_town_city = $('#checkout_town_city').val();		
			if (checkout_town_city==null || checkout_town_city=="")
			  {
				$('#checkout_mess').html('<span class="error">City is required!</span>');
				$('#checkout_town_city').focus();
				$('#checkout_town_city').select();			
				return false;
			  } else {
				$('#checkout_mess').html('');
			  }
		} 
		var checkout_notes = $('#checkout_notes').val();
		
		$.ajax({
          type: 'POST',
          url: adminUrl.ajaxurl,
          data: {
          action: 'add_customer_info',
			checkout_email : checkout_email,
			checkout_password : checkout_password,
			checkout_first_name : checkout_first_name,
			checkout_last_name : checkout_last_name,
			checkout_address	: checkout_address,
			checkout_phone	: checkout_phone,
			checkout_company_name : checkout_company_name,
			selectCountry : selectCountry,
			checkout_postcode : checkout_postcode,
			checkout_town_city : checkout_town_city,
			checkout_notes    : checkout_notes,
			registrationId : $thisbutton.attr('id')
          },
          success: function(data, textStatus, XMLHttpRequest){
			var obj = jQuery.parseJSON(data);		
			console.log(obj['success']);
			
          },
          error: function(MLHttpRequest, textStatus, errorThrown){
            alert(errorThrown);
          }

          });
		
	return false;
    });

});

function IsEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

function check_number(txtMobId) {
 reg = /[^0-9.,]/g;
 txtMobId.value =  txtMobId.value.replace(reg,"");
}