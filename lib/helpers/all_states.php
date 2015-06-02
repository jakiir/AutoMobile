<?php
if (!class_exists( 'all_states' )){ 
		class all_states{
			
			//public $countryList;
			
		function __construct() {
									 
		  }
		
			  
	   function state_list(){
		   global $autoMobile, $states;
		   $statesPath = $autoMobile->statesPath;
		   require_once( $statesPath . 'AU' . '.php' );
		   require_once( $statesPath . 'BD' . '.php' );
		   require_once( $statesPath . 'BG' . '.php' );
		   require_once( $statesPath . 'BR' . '.php' );
		   require_once( $statesPath . 'CA' . '.php' );
		   require_once( $statesPath . 'CN' . '.php' );
		   require_once( $statesPath . 'ES' . '.php' );
		   require_once( $statesPath . 'GR' . '.php' );
		   require_once( $statesPath . 'HK' . '.php' );
		   require_once( $statesPath . 'HU' . '.php' );
		   require_once( $statesPath . 'ID' . '.php' );
		   require_once( $statesPath . 'IN' . '.php' );
		   require_once( $statesPath . 'IR' . '.php' );
		   require_once( $statesPath . 'IT' . '.php' );
		   require_once( $statesPath . 'JP' . '.php' );
		   require_once( $statesPath . 'MX' . '.php' );
		   require_once( $statesPath . 'MY' . '.php' );
		   require_once( $statesPath . 'NP' . '.php' );
		   require_once( $statesPath . 'NZ' . '.php' );
		   require_once( $statesPath . 'PE' . '.php' );
		   require_once( $statesPath . 'TH' . '.php' );
		   require_once( $statesPath . 'TR' . '.php' );
		   require_once( $statesPath . 'US' . '.php' );
		   require_once( $statesPath . 'ZA' . '.php' );
		   
		   return $output =  $states;
	   }    
        
    }
}