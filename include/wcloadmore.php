<?php  
/**
 * Widget configuration. 
 */ 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly   
if ( ! class_exists( 'categoryWcProductLMWidget' ) ) { 
	class categoryWcProductLMWidget extends categoryWcProductLMLib {
	 
	   /**
		* PHP5 constructor method.
		*
		* Run the following methods when this class is loaded
		*
		* @access  public
		* @since   1.0
		*
		* @return  void
		*/ 
		public function __construct() {
		
			add_action( 'init', array( &$this, 'init' ) ); 
			parent::__construct();
			
		}  
		
	   /**
		* Load required methods on wordpress init action 
		*
		* @access  public
		* @since   1.0
		*
		* @return  void
		*/ 
		public function init() {
		
			add_action( 'wp_ajax_getTotalWcProducts',array( &$this, 'getTotalWcProducts' ) );
			add_action( 'wp_ajax_getWcProducts',array( &$this, 'getWcProducts' ) ); 
			add_action( 'wp_ajax_getMoreWcProducts',array( &$this, 'getMoreWcProducts' ) );
			
			add_action( 'wp_ajax_nopriv_getTotalWcProducts', array( &$this, 'getTotalWcProducts' ) );
			add_action( 'wp_ajax_nopriv_getWcProducts', array( &$this, 'getWcProducts' ) ); 
			add_action( 'wp_ajax_nopriv_getMoreWcProducts', array( &$this, 'getMoreWcProducts' ) ); 
			
			add_shortcode( 'wcloadmore', array( &$this, 'categoryWcProductLM' ) ); 
			
		} 
		
	   /**
		* Get the total numbers of posts
		*
		* @access  public
		* @since   1.0
		*   
		* @return  int	  Total number of posts  	
		*/  
		public function getTotalWcProducts() { 
		
			global $wpdb;   
			
		   /**
			* Check security token from ajax request
			*/
			check_ajax_referer( $this->_config["security_key"], 'security' );

		   /**
			* Fetch posts as per search filter
			*/	
			$_res_total = $this->getSqlResult( 0, 0, 1 );
			
			return $_res_total[0]->total_val;
			 
		}	

		 
	   /**
		* Render category and posts shortcode
		*
		* @access  public
		* @since   1.0
		*
		* @param   array   $params  Shortcode configuration options from admin settings
		* @return  string  Render category and posts HTML
		*/
		public function categoryWcProductLM( $params = array() ) { 	
		
			$wcloadmore_id = $params["id"]; 
			$wclm_shortcode = get_post_meta( $wcloadmore_id ); 
			
			foreach ( $wclm_shortcode as $sc_key => $sc_val ) {			
				$wclm_shortcode[$sc_key] = $sc_val[0];			
			} 
			
			if(!isset($wclm_shortcode["number_of_post_display"]))	
				$wclm_shortcode["number_of_post_display"] = 0; 
				
			$this->_config = shortcode_atts( $this->_config, $wclm_shortcode ); 
			
		   /**
			* Load template according to admin settings
			*/
			ob_start();
			
			require( $this->getcategoryWcProductLMTemplate( "template_" . $this->_config["template"] . ".php" ) ); 
			
			return ob_get_clean();
		
		}   
		
	   /**
		* Load more post via ajax request
		*
		* @access  public
		* @since   1.0
		* 
		* @return  void Displays searched posts HTML to load more pagination
		*/	
		public function getMoreWcProducts() {
		
			global $wpdb, $wp_query; 
			
		   /**
			* Check security token from ajax request
			*/
			check_ajax_referer($this->_config["security_key"], 'security' );
			
			$_total = ( isset( $_REQUEST["total"] )?esc_attr( $_REQUEST["total"] ):0 );   
			$_limit_start = ( isset( $_REQUEST["limit_start"])?esc_attr( $_REQUEST["limit_start"] ):0 );
			$_limit_end = ( isset( $_REQUEST["number_of_post_display"])?esc_attr( $_REQUEST["number_of_post_display"] ):wclm_number_of_post_display ); 
			
		   /**
			* Fetch posts as per search filter
			*/	
			$_result_items = $this->getSqlResult( $_limit_start, $_limit_end );
		  
			require( $this->getcategoryWcProductLMTemplate( 'ajax_load_more_posts.php' ) );	
			
			wp_die();
		}    
		
	   /**
		* Load more posts via ajax request
		*
		* @access  public
		* @since   1.0
		* 
		* @return  object Displays searched posts HTML
		*/
		public function getWcProducts() {
		
		   global $wpdb; 
			
		   /**
			* Check security token from ajax request
			*/	
		   check_ajax_referer( $this->_config["security_key"], 'security' );	   
		   
		   require( $this->getcategoryWcProductLMTemplate( 'ajax_load_posts.php' ) );	
		   
  		   wp_die();
		
		}
		 
	   /**
		* Get post list with specified limit and filtered by category and search text
		*
		* @access  public
		* @since   1.0 
		* 
		* @param   int     $_limit_end			 Limit to fetch post ending to given position
		* @return  object  Set of searched post data
		*/
		public function getWcProductList( $_limit_end ) {
			
		   /**
			* Check security token from ajax request
			*/	
			check_ajax_referer( $this->_config["security_key"], 'security' );		
			
		   /**
			* Fetch data from database
			*/
			return $this->getSqlResult( 0, $_limit_end );
			 
		} 
		
	}
	
}
new categoryWcProductLMWidget();