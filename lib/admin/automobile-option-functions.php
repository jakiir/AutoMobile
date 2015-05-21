<?php
/**
 * Flex automobile plugin by bdwebteam.
 *
 * @package   automobile
 * @author    Mahabub Hasan <m.manik01@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.bdwebteam.com
 * @copyright 2015 Mahabub Hasan
 */
$options = get_option('automobile_options');
function automobile_get_rgb_color($color){
			
		if ( $color[0] == '#' ) {
                $color = substr( $color, 1 );
        }
        if ( strlen( $color ) == 6 ) {
                list( $r, $g, $b ) = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                list( $r, $g, $b ) = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return false;
        }
		
		$r = hexdec( $r );
        $g = hexdec( $g );
        $b = hexdec( $b );
        
		
		$rgb =$r.','.$g.','.$b;
		return $rgb;       
}

/**
 * A safe way of adding JavaScripts to a WordPress generated page.
 */

if (!is_admin()){
    add_action('wp_footer', 'automobile_js');
}
if (!function_exists('automobile_js')) {
    function automobile_js() {	
           wp_enqueue_script( 'automobile_theme_options', plugins_url('assets/js/custom_automobile.js',dirname(__FILE__)) );
           wp_localize_script(
			'automobile_theme_options',
			'adminUrl',
			 array( 'ajaxurl' => admin_url('admin-ajax.php') )
		  );
          
    }
  }

/**
 * Enqueues styles for front-end.
 *
 */ 
if (!function_exists('automobile_public_css')) {
	function automobile_public_css() { 	  
    wp_enqueue_style( 'font-awesome', plugins_url('css/font-awesome/css/font-awesome.min.css', dirname(__FILE__)) );
    }
}
add_action( 'wp_enqueue_scripts', 'automobile_public_css' );
  

function automobile_custom_styles(){       
    $options = get_option('automobile_options');   
    $automobile_text_color = $options['automobile_text_color'];
    $automobile_background_color = $options['automobile_background_color'];    
    $automobile_hover_background_color = $options['automobile_hover_background_color'];
    $automobile_links_hover_color = $options['automobile_links_hover_color'];
    $automobile_fontsize = $options['automobile_fontsize'];
    $automobile_links_color = $options['automobile_links_color'];
    $automobile_line_height = $options['automobile_line_height'];
    $automobile_padding_top_bottom = $options['automobile_padding_top_bottom'];
    $automobile_padding_left_right = $options['automobile_padding_left_right']; 
    
    $custom_css = "
                div.bhoechie-tab-container{
                border:1px solid #ddd;}
                div.bhoechie-tab-menu div.list-group>a .glyphicon,div.bhoechie-tab-menu div.list-group>a .fa,div.bhoechie-tab-menu div.list-group>a {color: $automobile_links_color;background-color: $automobile_background_color;}                
                div.bhoechie-tab-menu div.list-group>a.active,
                div.bhoechie-tab-menu div.list-group>a.active .glyphicon,
                div.bhoechie-tab-menu div.list-group>a.active .fa{
                background-color: $automobile_hover_background_color;
                background-image: $automobile_hover_background_color;
                color: $automobile_links_hover_color;
                }
                ";
           
            
    wp_add_inline_style( 'custom-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'automobile_custom_styles' );

add_action('admin_enqueue_scripts', 'admin_automobile_style');

function admin_automobile_style() {
    $options = get_option('automobile_options');	
    $automobile_text_color = $options['automobile_text_color'];
    $automobile_background_color = $options['automobile_background_color'];    
    $automobile_hover_background_color = $options['automobile_hover_background_color'];
    $automobile_links_hover_color = $options['automobile_links_hover_color'];
    $automobile_fontsize = $options['automobile_fontsize'];
    $automobile_links_color = $options['automobile_links_color'];
    $automobile_line_height = $options['automobile_line_height'];
    $automobile_padding_top_bottom = $options['automobile_padding_top_bottom'];
    $automobile_padding_left_right = $options['automobile_padding_left_right'];
  echo "<style>
    #automobile-admin .automobile ul li a{
    color:".$automobile_links_color." !important;  
    background: ".$automobile_background_color." !important;
    padding-top:".$automobile_padding_top_bottom ." !important;
    padding-bottom:".$automobile_padding_top_bottom ." !important;
    
    padding-left:".$automobile_padding_left_right ." !important;
    padding-right:".$automobile_padding_left_right ." !important;
     }
     #automobile-admin .automobile ul li a:hover,#automobile-admin .automobile ul li.active a{
         color:".$automobile_links_hover_color." !important;  
        background: ".$automobile_hover_background_color.";        
     }
     </style>";
}

/**
 * Set font styles
 */ 
function automobile_set_font_style($fontstyle){
	$stack = '';
		
	switch ( $fontstyle ) {

		case "normal":
			$stack .= "";
		break;
		case "italic":
			$stack .= "    font-style: italic;";
		break;
		case 'bold':
			$stack .= "    font-weight: bold;";
		break;
		case 'bold-italic':
			$stack .= "    font-style: italic;\n    font-weight: bold;";
		break;
	}
	return $stack;
}

?>