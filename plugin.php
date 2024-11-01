<?php 
/*
  Plugin Name: WC Load More Product
  Description: WC Load More Product
  Author: ikhodal team
  Plugin URI: http://www.ikhodal.com/wc-load-more-product/
  Author URI: http://www.ikhodal.com/wc-load-more-product/
  Version: 1.0
  License: GNU General Public License v2.0
  License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/ 
  
  
//////////////////////////////////////////////////////
// Defines the constants for use within the plugin. //
////////////////////////////////////////////////////// 
if ( ! defined( 'ABSPATH' ) ) exit;
/**
* Widget/Block Title
*/
define( 'wclm_widget_title', __( 'WC Products Load More View', 'wcloadmore') );
  
/**
* Number of posts per next loading result
*/
define( 'wclm_number_of_post_display', '2' ); 
  
/**
* Product title text color
*/
define( 'wclm_title_text_color', '#000' );
 
/**
* Widget/block header text color
*/
define( 'wclm_header_text_color', '#fff' );

/**
* Widget/block header text background color
*/
define( 'wclm_header_background_color', '#00bc65' );

/**
* Display product title and text over post image
*/
define( 'wclm_display_title_over_image', 'no' );

/**
* Widget/block width
*/
define( 'wclm_widget_width', '100%' );  

/**
* Hide/Show widget title
*/
define( 'wclm_hide_widget_title', 'no' );
 
/**
* Template for widget/block
*/
define( 'wclm_template', 'pane_style_1' ); 

/**
* Hide/Show product title
*/
define( 'wclm_hide_post_title', 'no' );  
   
/**
* Security key for block id
*/
define( 'wclm_security_key', 'WCLM_#9s@R$@ASI#TA(!@@21M3' );
 
/**
*  Assets for category and posts
*/
$wclm_plugins_url = plugins_url( "/assets/", __FILE__ );

define( 'WCLM_MEDIA', $wclm_plugins_url );  

/**
*  Plugin DIR
*/
$wclm_plugin_DIR = plugin_basename(dirname(__FILE__));

define( 'wclm_plugin_DIR', $wclm_plugin_DIR ); 
 
/**
 * Include abstract class for common methods
 */
require_once 'include/abstract.php';


///////////////////////////////////////////////////////
// Include files for widget and shortcode management //
///////////////////////////////////////////////////////

/**
 * Admin panel widget configuration
 */ 
require_once 'include/admin.php';
 
/**
 * Load Wc Product Load More on frontent pages
 */
require_once 'include/wcloadmore.php';  
 