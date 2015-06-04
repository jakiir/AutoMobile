jQuery( function( $ ) {
	
	$( document ).on( 'click', '#inquiry_submit', function() {
		var $thisbutton = $( this );           
		var enquiry_msg = $('#enquiry_msg');
		
		var your_name = $('#your_name');		
        if (your_name.val()==null || your_name.val()=="")
          {
                enquiry_msg.html('<span class="error">Name is required!</span>');
                your_name.focus();
                your_name.select();
                return false;
          } else {
            enquiry_msg.html('');
          }
		
		var email_address = $('#email_address');
        if (email_address.val()==null || email_address.val()=="")
          {
                enquiry_msg.html('<span class="error">Email is required!</span>');
                email_address.focus();
                email_address.select();
                return false;
          } else {
            enquiry_msg.html('');
          }
          if(!IsEmail(email_address.val())){
                enquiry_msg.html('<span class="error">Email is not valid!</span>');
                email_address.focus();
                email_address.select();
                return false;
          }else {
            enquiry_msg.html('');
          }
		  
		var inquiry_parts = $('#inquiry_parts');
		
		var product_inquiry = $('textarea#product_inquiry');		
        if (product_inquiry.val()==null || product_inquiry.val()=="")
          {
                enquiry_msg.html('<span class="error">Inquiry is required!</span>');
                product_inquiry.focus();
                product_inquiry.select();
                return false;
          } else {
            enquiry_msg.html('');
          }		  
		  
		  $thisbutton.parent().addClass('addToCartLodding');
		  enquiry_msg.html('');		  
		  $.ajax({
          type: 'POST',
          url: adminUrl.ajaxurl,
          data: {
          action: 'inquiry_send',
          your_name:your_name.val(),
          email_address:email_address.val(),
          inquiry_parts:inquiry_parts.val(),
          product_inquiry:product_inquiry.val()
          },
          success: function(data){
			$thisbutton.parent().removeClass('addToCartLodding');
			enquiry_msg.html('');
			console.log(data);
			var obj = jQuery.parseJSON(data);
			if(obj['success'] == true){
				enquiry_msg.html('<span class="success">'+obj['mess']+'</span>');				
			} else {
				enquiry_msg.html('<span class="error">'+obj['mess']+'</span>');
			}
          },
          error: function(errorThrown){
            alert(errorThrown);
          }

          });
		  
		return false;
	});
	
    $( document ).on( 'click', '.auto_mobile_add_to_cart', function() {
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
          success: function(data){
              $thisbutton.parent().removeClass('addToCartLodding');
              $('.cart_item').attr('data-qty', now_qty).html(now_qty);
              $('.cart_price').attr('data-price', now_price).html('$' + now_price);
              $('.view_cart').show();
          },
          error: function(errorThrown){
            alert(errorThrown);
          }

          });

        return false;

    });

    $( document ).on( 'click', '.itemRemoveBtn', function() {
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
          success: function(){
              //console.log(data);
              $thisbutton.parent().removeClass('addToCartLodding');
              location.reload();
          },
          error: function(errorThrown){
            alert(errorThrown);
          }

          });

        return false;

    });

    $( document ).on( 'change', '#selectCountry', function() {
        var $thisbutton = $( this );
        var $thisVal = $thisbutton.val();
        //alert($thisbutton.val());
        var checkout_town_city = $('#checkout_town_city');
        var checkout_town_citi = $('.checkout_town_city');
        $.ajax({
          type: 'POST',
          url: adminUrl.ajaxurl,
          data: {
          action: 'get_country_state',
          country:$thisVal
          },
          success: function(data){
            var obj = jQuery.parseJSON(data);
            if(obj['success'] == true){
                checkout_town_citi.html('');
                checkout_town_city.show();
                var value_dum = '';
                checkout_town_city.html('');
                checkout_town_city.append('<option value="' + value_dum + '">Select One</option>');
                for (var prop in obj[$thisVal]) {
                    $('#checkout_town_city').append('<option value="'+prop+'">' + obj[$thisVal][prop] + '</option>');
                }
            } else {
                checkout_town_city.hide();
                checkout_town_citi.html('').html('<input type="test" id="town_city_text" name="town_city_text" class="form-control"/>');
            }
          },
          error: function(errorThrown){
            alert(errorThrown);
          }
          });

    return false;
    });

    $( document ).on( 'click', '#automobile_place_order', function() {
        var $thisbutton = $( this );
        var data_logged = $thisbutton.attr('data-logged');
        var checkout_mess = $('#checkout_mess');

        var checkout_email = $('#checkout_email');
        if (checkout_email.val()==null || checkout_email.val()=="")
          {
                checkout_mess.html('<span class="error">Email is required!</span>');
                checkout_email.focus();
                checkout_email.select();
                return false;
          } else {
            checkout_mess.html('');
          }
          if(!IsEmail(checkout_email.val())){
                checkout_mess.html('<span class="error">Email is not valid!</span>');
                checkout_email.focus();
                checkout_email.select();
                return false;
          }else {
            checkout_mess.html('');
          }

        var checkout_password = $('#checkout_password');
        if(data_logged =='no') {
            if (checkout_password.val() == null || checkout_password.val() == "") {
                checkout_mess.html('<span class="error">Password is required!</span>');
                checkout_password.focus();
                checkout_password.select();
                return false;
            } else {
                checkout_mess.html('');
            }
            if (checkout_password.val().length < 6) {
                checkout_mess.html('<span class="error">Password is 6 disit must!</span>');
                checkout_password.focus();
                checkout_password.select();
                return false;
            } else {
                checkout_mess.html('');
            }
        }
        if(data_logged =='yes'){
            if (checkout_password.val() != "") {
                if (checkout_password.val().length < 6) {
                    checkout_mess.html('<span class="error">Password is 6 disit must!</span>');
                    checkout_password.focus();
                    checkout_password.select();
                    return false;
                } else {
                    checkout_mess.html('');
                }
            }
        }
        var checkout_first_name = $('#checkout_first_name');
        if (checkout_first_name.val()==null || checkout_first_name.val()=="")
          {
            checkout_mess.html('<span class="error">First Name is required!</span>');
            checkout_first_name.focus();
            checkout_first_name.select();
            return false;
          } else {
            checkout_mess.html('');
          }
        var checkout_last_name = $('#checkout_last_name');
        if (checkout_last_name.val()==null || checkout_last_name.val()=="")
          {
            checkout_mess.html('<span class="error">Last Name is required!</span>');
            checkout_last_name.focus();
            checkout_last_name.select();
            return false;
          } else {
            checkout_mess.html('');
          }
        var checkout_address = $('#checkout_address');
        if (checkout_address.val()==null || checkout_address.val()=="")
          {
            checkout_mess.html('<span class="error">Address is required!</span>');
            checkout_address.focus();
            checkout_address.select();
            return false;
          } else {
            checkout_mess.html('');
          }
        var checkout_phone = $('#checkout_phone');
        if (checkout_phone.val()==null || checkout_phone.val()=="")
          {
            checkout_mess.html('<span class="error">Phone is required!</span>');
            checkout_phone.focus();
            checkout_phone.select();
            return false;
          } else {
            checkout_mess.html('');
          }
        var checkout_company_name = $('#checkout_company_name');
        var selectCountry = $('#selectCountry');
        if (selectCountry.val()==null || selectCountry.val()=="")
          {
            checkout_mess.html('<span class="error">Country is required!</span>');
            selectCountry.focus();
            selectCountry.select();
            return false;
          } else {
            checkout_mess.html('');
          }
        var checkout_postcode = $('#checkout_postcode');
        if (checkout_postcode.val()==null || checkout_postcode.val()=="")
          {
            checkout_mess.html('<span class="error">Post code is required!</span>');
            checkout_postcode.focus();
            checkout_postcode.select();
            return false;
          } else {
            checkout_mess.html('');
          }


        if (document.getElementById("town_city_text")) {
            var checkout_town_city = $('#town_city_text');
            if (checkout_town_city.val()==null || checkout_town_city.val()=="")
          {
            checkout_mess.html('<span class="error">City is required!</span>');
            checkout_town_city.focus();
            checkout_town_city.select();
            return false;
          } else {
            checkout_mess.html('');
          }
        } else {
            var checkout_town_city = $('#checkout_town_city');
            if (checkout_town_city.val()==null || checkout_town_city.val()=="")
              {
                checkout_mess.html('<span class="error">City is required!</span>');
                checkout_town_city.focus();
                checkout_town_city.select();
                return false;
              } else {
                checkout_mess.html('');
              }
        }
        var checkout_notes = $('#checkout_notes');
		
		var product_ids = getValues('product_ids');	
		var product_names = getValues('product_names');		
		var product_item_prices = getValues('product_item_prices');
		var product_total_price = getValues('product_total_price');
		var product_quantity = getValues('product_quantity');
		var product_shipping = getValues('product_shipping');
		
		var subTotalPrice = $('#subTotalPrice');
		var productTotalPrice = $('#productTotalPrice');
		var productTotalItem = $('#productTotalItem');		
		
        $.ajax({
          type: 'POST',
          url: adminUrl.ajaxurl,
          data: {
          action: 'add_customer_info',
            checkout_email : checkout_email.val(),
            checkout_password : checkout_password.val(),
            checkout_first_name : checkout_first_name.val(),
            checkout_last_name : checkout_last_name.val(),
            checkout_address : checkout_address.val(),
            checkout_phone : checkout_phone.val(),
            checkout_company_name : checkout_company_name.val(),
            selectCountry : selectCountry.val(),
            checkout_postcode : checkout_postcode.val(),
            checkout_town_city : checkout_town_city.val(),
            checkout_notes    : checkout_notes.val(),
			subTotalPrice 	: subTotalPrice.val(),
			productTotalPrice : productTotalPrice.val(),
			productTotalItem : productTotalItem.val(),
			product_ids : product_ids,
			product_names : product_names,
			product_item_prices : product_item_prices,
			product_total_price : product_total_price,
			product_quantity : product_quantity,
			product_shipping : product_shipping,			
            registrationId : $thisbutton.attr('id')
          },
          success: function(data){
            var obj = jQuery.parseJSON(data);
            //console.log(data);
			if(obj['success'] == true && obj['post_id'] !=''){
				setTimeout("document.frm_payment_method.submit()", 2);
			} else {
				checkout_mess.html('<span class="error">'+obj['mess']+'</span>');
			}

          },
          error: function(errorThrown){
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

function getValues(className){
    var tempValues = {};
    var i = 0;
    $('.' + className).each(function(){
        var th= $(this);
        tempValues[i] = th.val();
        i++;
    });
    return tempValues;
}

function get_state_city(VALUE,CITY) {
    var $thisVal = VALUE;
    var checkout_town_city = $('#checkout_town_city');
    var checkout_town_citi = $('.checkout_town_city');
    $.ajax({
        type: 'POST',
        url: adminUrl.ajaxurl,
        data: {
            action: 'get_country_state',
            country:$thisVal
        },
        success: function(data){
            var obj = jQuery.parseJSON(data);
            if(obj['success'] == true){
                checkout_town_citi.html('');
                checkout_town_city.show();
                var value_dum = '';
                checkout_town_city.html('');
                checkout_town_city.append('<option value="' + value_dum + '">Select One</option>');
                for (var prop in obj[$thisVal]) {
                    var $marked = ( prop == CITY ? 'selected="selected"' : null );
                    $('#checkout_town_city').append('<option '+$marked+' value="'+prop+'">' + obj[$thisVal][prop] + '</option>');
                }
            } else {
                checkout_town_city.hide();
                checkout_town_citi.html('').html('<input type="test" id="town_city_text" name="town_city_text" class="form-control"/>');
            }
        },
        error: function(errorThrown){
            alert(errorThrown);
        }
    });

    return false;
}