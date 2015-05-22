jQuery(document).ready(function($){

    $( '#automobile_make_submit' ).click( function(e) {
        var $thisbutton = $(this);
        var make_val = $('#automobile_make_id').val();
        $thisbutton.parent().find('.message').html('');
        $thisbutton.parent().find('.reloadIcon').css('display','inline-block');

        $.ajax({
            type: 'POST',
            url: adminUrl.ajaxurl,
            data: {
                action: 'add_automobile_make',
                make_val:make_val
            },
            success: function(data, textStatus, XMLHttpRequest){
                var obj = jQuery.parseJSON(data);
                console.log(data);
                if(obj['success'] == true) {
                    $thisbutton.parent().find('.reloadIcon').css('display', 'none');
                    $('#automobile_make_id').val('');
                    $thisbutton.parent().find('#make_display_area').show().append('<li class="each_make">' + obj['value'] + '</li>');
                } else {
                    $thisbutton.parent().find('.reloadIcon').css('display', 'none');
                    $('#automobile_make_id').focus();
                    $thisbutton.parent().find('.message').html('<strong style="color:red">'+ obj['value'] +'</strong>');
                }
            },
            error: function(MLHttpRequest, textStatus, errorThrown){
                alert(errorThrown);
            }

        });

        return false;


    });



    $('select.styled').customSelect();

    $(".automobile_block").hide();
    $(".automobile ul li:first").addClass("active").show();
    $(".automobile_block:first").show();

    $(".automobile ul li").click(function() {
        $(".automobile ul li").removeClass("active");
        $(this).addClass("active");
        $(".automobile_block").hide();
        var activeTab = $(this).find("a").attr("href");
        $(activeTab).fadeIn(200);
        return false;
    });

        $('#automobile_text_color_selector').ColorPicker({
        onChange: function (hsb, hex, rgb) {
                $('#automobile_text_color_selector div').css('backgroundColor', '#' + hex);
                $('#automobile_text_color').val('#'+hex);
        }
    });
    $('#automobile_links_color_selector').ColorPicker({
        onChange: function (hsb, hex, rgb) {
                $('#automobile_links_color_selector div').css('backgroundColor', '#' + hex);
                $('#automobile_links_color').val('#'+hex);
        }
    });
    $('#automobile_links_hover_color_selector').ColorPicker({
        onChange: function (hsb, hex, rgb) {
                $('#automobile_links_hover_color_selector div').css('backgroundColor', '#' + hex);
                $('#automobile_links_hover_color').val('#'+hex);
        }
    });
    $('#automobile_background_color_selector').ColorPicker({
        onChange: function (hsb, hex, rgb) {
                $('#automobile_background_color_selector div').css('backgroundColor', '#' + hex);
                $('#automobile_background_color').val('#'+hex);
        }
    });


    $('#automobile_hover_background_color_selector').ColorPicker({
        onChange: function (hsb, hex, rgb) {
                $('#automobile_hover_background_color_selector div').css('backgroundColor', '#' + hex);
                $('#automobile_hover_background_color').val('#'+hex);
        }
    });



    $("#sidebar-position-options input:checked").parent().addClass("selected");
    $("#sidebar-position-options .checkbox-select").click(
        function(event) {
            event.preventDefault();
            $("#sidebar-position-options li").removeClass("selected");
            $(this).parent().addClass("selected");
            $(this).parent().find(":radio").attr("checked","checked");
        }
    );

    if ($('#automobile_meta_post_show_review').is(':checked')) {
        $('#wt-post-meta-review-options').css('display', 'block');
    }

    $('#automobile_meta_post_show_review').click(function(){
        if (this.checked) {

            $('#wt-post-meta-review-options').slideDown();
        } else {
            $('#wt-post-meta-review-options').slideUp();
        }
    });

$('ul.tabs').each(function(){
    // For each set of tabs, we want to keep track of
    // which tab is active and it's associated content
    var $active, $content, $links = $(this).find('a');

    // If the location.hash matches one of the links, use that as the active tab.
    // If no match is found, use the first link as the initial active tab.
    $active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
    $active.addClass('active');

    $content = $($active[0].hash);

    // Hide the remaining content
    $links.not($active).each(function () {
      $(this.hash).hide();
    });

    // Bind the click event handler
    $(this).on('click', 'a', function(e){
      // Make the old tab inactive.
      $active.removeClass('active');
      $content.hide();

      // Update the variables with the new link and content
      $active = $(this);
      $content = $(this.hash);

      // Make the tab active.
      $active.addClass('active');
      $content.show();

      // Prevent the anchor's default click action
      e.preventDefault();
    });
  });

////Select all anchor tag with rel set to tooltip
//$('a[rel=tooltip]').mouseover(function(e) {
//
////Grab the title attribute's value and assign it to a variable
//var tip = $(this).attr('title');
//
////Remove the title attribute's to avoid the native tooltip from the browser
//$(this).attr('title','');
//
////Append the tooltip template and its value
//$(this).append('<div id="tooltip"><div class="tipHeader"></div><div class="tipBody">' + tip + '</div><div class="tipFooter"></div></div>');
//
////Show the tooltip with faceIn effect
//$('#tooltip').fadeIn('500');
//$('#tooltip').fadeTo('10',0.9);
//
//}).mousemove(function(e) {
//
////Keep changing the X and Y axis for the tooltip, thus, the tooltip move along with the mouse
//$('#tooltip').css('top', e.pageY + 10 );
//$('#tooltip').css('left', e.pageX + 20 );
//
//}).mouseout(function() {
//
////Put back the title attribute's value
//$(this).attr('title',$('.tipBody').html());
//
////Remove the appended tooltip template
//$(this).children('div#tooltip').remove();
//
//});
});

jQuery(document).ready(function ($) {
    setTimeout(function () {
        $(".fade").fadeOut("slow", function () {
            $(".fade").remove();
        });
    }, 2000);
});

jQuery(document).ready(function ($) {
    $("#wt-bg-default-pattern input:checked").parent().addClass("selected");
    $("#wt-bg-default-pattern .checkbox-select").click(
        function(event) {
            event.preventDefault();
            $("#wt-bg-default-pattern li").removeClass("selected");
            $(this).parent().addClass("selected");
            $(this).parent().find(":radio").attr("checked","checked");
        }
    );
});


 js = jQuery.noConflict();
    js(document).ready(function(){
    js('.add_more').click(function(e){
    e.preventDefault();
    js(this).before("<p><input size='50' name='txt_automobile_mpn[]' type='text' class='in_box' /> &nbsp;<span class='rem' ><a href='javascript:void(0);' ><span class='dashicons dashicons-dismiss'></span></a></span></p>");
    });
    js('.automobile_mpn').on('click', '.rem', function() {
    js(this).parent("p").remove();
    });
    });

    jQuery(document).ready(function() {
        jQuery('.txt_automobile_year').datepicker({
        dateFormat : 'dd-mm-yy'
    });
    });
