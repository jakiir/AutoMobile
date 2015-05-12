<?php 
   /*
	Plugin Name: Auto Mobile
	Plugin URI: http://jakirhossain.com
	Description: An eCommerce toolkit that helps you sell any product.
	Author: Jakir Hossain
	Version: 1.0
	Author URI: http://jakirhossain.com
	*/
	
	
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Please don\'t access this file directly.');
}

require_once ( 'lib/init.php' );  
//require_once ( 'lib/api.php' ); 

if (!class_exists( 'AutoMobile' )){
    class AutoMobile extends autoMobileCore {
        
        public $title       = 'Auto Mobile';
        public $name        = 'auto-mobile';
        public $version     = '1.0';
        public $prefix      = 'atm_';  
        public $prefixLong  = 'auto_mobile_';
        public $website     = 'http://jakirhossain.com';     
        
        
        function __construct(){ 
            $this->file             = __FILE__;
            $this->pluginSlug       = plugin_basename(__FILE__);
            $this->pluginPath       = dirname( __FILE__ );
            $this->modelsPath       = $this->pluginPath . '/lib/models/';
			$this->adminPath       = $this->pluginPath . '/lib/admin/';
            $this->controllersPath  = $this->pluginPath . '/lib/controllers/';
            $this->viewsPath        = $this->pluginPath . '/lib/views/';
            $this->helperPath        = $this->pluginPath . '/lib/helpers/';
            
            $this->pluginUrl        = plugins_url( '' , __FILE__ ); 
            $this->assetsUrl        = $this->pluginUrl  . '/assets/'; 
            $this->helperUrl        = $this->pluginUrl  .'/lib/helpers/';
            define('ATM_PATH',dirname( __FILE__ )); 
            define('ATM_PLUGIN_URL',plugins_url( '' , __FILE__ )).'/';
            define('ATM_ASSECTS_URL', ATM_PLUGIN_URL.'/assets/');
            define('ATM_HELPER_URL', ATM_PLUGIN_URL.'/lib/helpers/');
            
          
          $this->loadModels( $this->modelsPath );
		  $this->loadAdmins( $this->adminPath );
          //$this->loadModels( $this->modelsPath.'enc/' , true);
          
          $this->options=array(
			'auto_mobile' =>'atm_auto_mobile',
			'post_types'=>'atm_post_types',
			'taxonomies'=>'atm_taxonomies',
			'settings'  =>'atm_settings',
			'cache'     =>'atm_cache'
			);
          

        }
        function init(){
            
            $this->pluginInit();        
        }
        
        
    }
    global $autoMobile;
    $autoMobile = new AutoMobile;
    $autoMobile->init();
}
	
?>