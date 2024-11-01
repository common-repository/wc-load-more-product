<?php 
/** 
 * Abstract class  has been designed to use common functions.
 * This is file is responsible to add custom logic needed by all templates and classes.  
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly   
if ( ! class_exists( 'categoryWcProductLMLib' ) ) { 
	abstract class categoryWcProductLMLib extends WP_Widget {
		
	   /**
		* Default values can be stored
		*
		* @access    public
		* @since     1.0
		*
		* @var       array
		*/
		public $_config = array();

		/**
		 * PHP5 constructor method.
		 *
		 * Run the following methods when this class is loaded.
		 * 
		 * @access    public
		 * @since     1.0
		 *
		 * @return    void
		 */ 
		public function __construct() {  
		
			/**
			 * Default values configuration 
			 */
			$this->_config = array(
				'widget_title'=>wclm_widget_title,
				'number_of_post_display'=>wclm_number_of_post_display, 
				'title_text_color'=>wclm_title_text_color, 
				'header_text_color'=>wclm_header_text_color,
				'header_background_color'=>wclm_header_background_color,
				'display_title_over_image'=>wclm_display_title_over_image, 
				'hide_widget_title'=>wclm_hide_widget_title, 
				'hide_post_title'=>wclm_hide_post_title,
				'template'=>wclm_template, 
				'vcode'=>$this->getUCode(),  
				'security_key'=>wclm_security_key,
				'tp_widget_width'=>wclm_widget_width 
			); 
			
			/**
			 * Load text domain
			 */
			add_action( 'plugins_loaded', array( $this, 'wcloadmore_text_domain' ) );
			
			parent::__construct( 'wcloadmore', __( 'Wc Product Load More', 'wcloadmore' ) );
			
			/**
			 * Widget initialization for category and posts
			 */
			add_action( 'widgets_init', array( &$this, 'initcategoryWcProductLM' ) ); 
			
			/**
			 * Load the CSS/JS scripts
			 */
			add_action( 'init',  array( $this, 'wcloadmore_scripts' ) );
			
			add_action( 'admin_enqueue_scripts', array( $this, 'wclm_admin_enqueue' ) ); 
			
		}
		
		
		/**
		* Register and load JS/CSS for admin widget configuration 
		*
		* @access  private
		* @since   1.0
		*
		* @return  bool|void It returns false if not valid page or display HTML for JS/CSS
		*/  
		public function wclm_admin_enqueue() {

			if ( ! $this->validate_page() )
				return FALSE;
			
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'wp-color-picker' );
			wp_enqueue_style( 'admin-wcloadmore.css', WCLM_MEDIA."css/admin-wcloadmore.css" );
			wp_enqueue_script( 'admin-wcloadmore.js', WCLM_MEDIA."js/admin-wcloadmore.js" ); 
			
		}
		
		
	   /**
		* Validate widget or shortcode post type page
		*
		* @access  private
		* @since   1.0
		*
		* @return  bool It returns true if page is post.php or widget otherwise returns false
		*/ 
		private function validate_page() {

			if ( ( isset( $_GET['post_type'] )  && $_GET['post_type'] == 'wclm_tabs' ) || strpos($_SERVER["REQUEST_URI"],"widgets.php") > 0  || strpos($_SERVER["REQUEST_URI"],"post.php" ) > 0 || strpos($_SERVER["REQUEST_URI"], "wcloadmore_settings" ) > 0  )
				return TRUE;
		
		} 
		
		/**
		 * Load the CSS/JS scripts
		 *
		 * @return  void
		 *
		 * @access  public
		 * @since   1.0
		 */
		function wcloadmore_scripts() {

			$dependencies = array( 'jquery' );
			 
			/**
			 * Include Wc Product Load More JS/CSS 
			 */
			wp_enqueue_style( 'wcloadmore', WCLM_MEDIA."css/wcloadmore.css" );
			 
			wp_enqueue_script( 'wcloadmore', WCLM_MEDIA."js/wcloadmore.js", $dependencies  );
			
			/**
			 * Define global javascript variable
			 */
			wp_localize_script( 'wcloadmore', 'wcloadmore', array(
				'wclm_ajax_url' => admin_url( 'admin-ajax.php' ),
				'wclm_security'  =>  wp_create_nonce(wclm_security_key),
				'wclm_media'  => WCLM_MEDIA,
				'wclm_all'  => __( 'All', 'wcloadmore' ),
				'wclm_plugin_url' => plugins_url( '/', __FILE__ ),
			)); 
		}	 
		
		/**
		 * Loads the text domain
		 *
		 * @access  private
		 * @since   1.0
		 *
		 * @return  void
		 */
		public function wcloadmore_text_domain() {

		  /**
		   * Load text domain
		   */
		   load_plugin_textdomain( 'wcloadmore', false, wclm_plugin_DIR . '/languages' );
			
		}
		 
		/**
		 * Load and register widget settings
		 *
		 * @access  private
		 * @since   1.0
		 *
		 * @return  void
		 */ 
		public function initcategoryWcProductLM() { 
			
		  /**
		   * Widget registration
		   */ 
			register_widget( 'categoryWcProductLMWidget_Admin' );
			
		}     
		 
		/**
		 * Get post image by given image attachment id
		 *
 		 * @access  public
		 * @since   1.0
		 *
		 * @param   int   $img  Image attachment ID
		 * @return  string  Returns image html from post attachment
		 */
		 public function getWcProductImage( $img ) {
		 
			$image_link = wp_get_attachment_url( $img ); 
			if( $image_link ) {
				$image_title = esc_attr( get_the_title( $img ) );  
				return wp_get_attachment_image( $img , array(180,180), 0, $attr = array(
									'title'	=> $image_title,
									'alt'	=> $image_title
								) );
			}else{
				return "<img src='".WCLM_MEDIA."images/no-img.png' />";
			}
			
		 }
		    

		/**
		* Fetch post data from database by category, search text and item limit
		*
		* @access  public
		* @since   1.0 
		* 
		* @param   int    $_limit_start  		Limit to fetch post starting from given position
		* @param   int    $_limit_end  			Limit to fetch post ending to given position
		* @param   int    $is_count  			Whether to fetch only number of products from database as count of items 
		* @param   int    $_is_last_updated  	Whether to fetch only last updated post or not
		* @return  object Set of searched post data
		*/
		function getSqlResult( $_limit_start, $_limit_end, $is_count = 0, $_is_last_updated = 0 ) {
			
			global $wpdb; 
			$_category_filter_query = "";
			$_post_text_filter_query = "";
			$_fetch_fields = "";
			$_limit = "";
			 
			$category_type = "product_cat"; 	
			
		   /**
			* Prepare safe mysql database query
			*/ 
			
			$_category_filter_query .=  $wpdb->prepare( "INNER JOIN {$wpdb->prefix}term_taxonomy as wtt on wtt.taxonomy = %s  INNER JOIN {$wpdb->prefix}term_relationships as wtr on  wtr.term_taxonomy_id = wtt.term_taxonomy_id and wtr.object_id = wp.ID ", $category_type );  
			 
			 
			
			if( $is_count == 1 ) { 
				$_fetch_fields = " count(*) as total_val ";
			} else {  
				$_fetch_fields = " wp.post_type, pm.meta_value as sale_price, pm_image.meta_value as post_image, wp.ID as post_id, wp.post_title as post_title, wp.post_date ";
				
				if( $_is_last_updated == 1 )
					$_limit = $wpdb->prepare( " order by CONVERT(sale_price, UNSIGNED INTEGER) ASC limit  %d, %d ", 0, 1 );
				else
					$_limit = $wpdb->prepare( " order by CONVERT(sale_price, UNSIGNED INTEGER) ASC limit  %d, %d ", $_limit_start, $_limit_end );
			} 
			$_limit = " group by wp.ID ".$_limit;  
			$_post_text_filter_query .=   " and wp.post_type = 'product' "; 
			 
		   /**
			* Fetch post data from database
			*/
			if( $is_count == 1 ) {
				$_result_items = $wpdb->get_results( " select $_fetch_fields from ( select $_fetch_fields from {$wpdb->prefix}posts as wp  
				INNER JOIN {$wpdb->prefix}postmeta as pm on pm.post_id = wp.ID and pm.meta_key = '_price' 
				INNER JOIN {$wpdb->prefix}postmeta as pm_stock on pm_stock.post_id = wp.ID and pm_stock.meta_key = '_stock_status' 
				INNER JOIN {$wpdb->prefix}postmeta as pm_backorders on pm_backorders.post_id = wp.ID and pm_backorders.meta_key = '_backorders' 
				$_category_filter_query LEFT JOIN {$wpdb->prefix}postmeta as pm_image on pm_image.post_id = wp.ID and pm_image.meta_key = '_thumbnail_id'
				where wp.post_status = 'publish' $_post_text_filter_query $_limit ) as ct" );			
			} else {
				$_result_items = $wpdb->get_results( " select $_fetch_fields from {$wpdb->prefix}posts as wp  
				INNER JOIN {$wpdb->prefix}postmeta as pm on pm.post_id = wp.ID and pm.meta_key = '_price' 
				INNER JOIN {$wpdb->prefix}postmeta as pm_stock on pm_stock.post_id = wp.ID and pm_stock.meta_key = '_stock_status' 
				INNER JOIN {$wpdb->prefix}postmeta as pm_backorders on pm_backorders.post_id = wp.ID and pm_backorders.meta_key = '_backorders' 
				$_category_filter_query LEFT JOIN {$wpdb->prefix}postmeta as pm_image on pm_image.post_id = wp.ID and pm_image.meta_key = '_thumbnail_id'
				where wp.post_status = 'publish' $_post_text_filter_query $_limit " );			
			}
				  
			return $_result_items;

		}
		
		/**
		 * Get all the categories types
		 *
		 * @access  public
		 * @since   1.0
		 *
		 * @return  object It contains all the types of categories
		 */
		public function wcloadmore_getCategoryTypes() {
		
			global $wpdb;
			 
			return $wpdb->get_results( "select taxonomy from {$wpdb->prefix}term_taxonomy group by taxonomy" );
		
		}
		
		/**
		 * Get all the post types
		 *
		 * @access  public
		 * @since   1.0
		 *
		 * @return  object It contains all the types of posts
		 */
		public function wcloadmore_getWcProductTypes() {
		
			global $wpdb;
			 
			return $wpdb->get_results( "SELECT post_type FROM {$wpdb->prefix}posts group by post_type" );
		
		}
		
		 
		/**
		 * Get Unique Block ID
		 *
		 * @access  public
		 * @since   1.0
		 *
		 * @return  string 
		 */
		public function getUCode() { 
			
			return 'uid_'.md5( "TABULA#RPANE32@#RPSDD@SQSITARAM@A$".time() );
		
		} 
		
		/**
		 * Get Wc Product Load More Template
		 *
		 * @access  public
		 * @since   1.0
		 *
		 * @param   string $file Template file name
		 * @return  string Returns template file path
		 */
		public function getcategoryWcProductLMTemplate( $file ) {
			
			if( locate_template( $file ) != "" ){
				return locate_template( $file );
			}else{
				return plugin_dir_path( dirname( __FILE__ ) ) . 'templates/' . $file ;
			}   
			
	   }
   }
}