<?php
if (!class_exists('autoMobileHelper'))
{
  class autoMobileHelper
  {
	  
	  
	function __construct(){
		
	}

function wt_cozy_thumbnail($placeholderImge = '') {
   $uploads_dir = wp_upload_dir();
   $upload_url = $uploads_dir['baseurl']."/";
   $upload_dir = $uploads_dir['basedir']."/";
   $thumb_url = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID(), array('class' => 'img-responsive') ) );            
   $check_image_dir = str_replace($upload_url, $upload_dir, $thumb_url);
   if ( has_post_thumbnail() ) {
       if(@file_exists($check_image_dir)){                
        the_post_thumbnail('thumbnail', array('class' => 'img-responsive'));
       } else {
           echo '<img src="http://placehold.it/'.$placeholderImge.'" />';
       }
   }
   else {
       echo '<img src="http://placehold.it/'.$placeholderImge.'" />';
   }
}
  }
}
?>