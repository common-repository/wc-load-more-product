<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly    
	$params = $_REQUEST;   
	$_total = ( isset( $params["total"] ) ? intval( $params["total"] ) : 0 ); 
	$_limit_start =( isset( $params["limit_start"] ) ? intval( $params["limit_start"] ) : 0 );
	$_limit_end = intval( $params["number_of_post_display"] ); 
	$all_pg = ceil( $_total / intval( $params["number_of_post_display"] ) );
	$cur_all_pg =ceil( ( $_limit_start ) / intval( $params["number_of_post_display"] ) ); 
	?><script language='javascript'>
			var request_obj_<?php echo esc_js( $params["vcode"] ); ?> = {  
			hide_post_title:'<?php echo esc_js( $params["hide_post_title"] ); ?>', 
			post_title_color:'<?php echo esc_js( $params["post_title_color"] ); ?>',  
			header_text_color:'<?php echo esc_js( $params["header_text_color"] ); ?>', 
			header_background_color:'<?php echo esc_js( $params["header_background_color"] ); ?>',
			display_title_over_image:'<?php echo esc_js( $params["display_title_over_image"] ); ?>',
			number_of_post_display:'<?php echo esc_js( $params["number_of_post_display"] ); ?>', 
			vcode:'<?php echo esc_js( $params["vcode"] ); ?>'
		}
	</script><?php
	$_total_posts = $this->getTotalWcProducts();
	if( $_total_posts <= 0 ) {
		?><div class="ik-post-no-items"><?php echo __( 'No products found.', 'wcloadmore' ); ?></div><?php
		die();
	}
	foreach( $_result_items as $_post ) {
		$image = $this->getWcProductImage( $_post->post_image );  
		$wc_product = wc_get_product( $_post->post_id );
		$add_to_cart_url = esc_url( $wc_product->add_to_cart_url() );
		$add_to_cart_text = $wc_product->add_to_cart_text();  		
		$_is_view = "bt-cart";
		if( esc_url( get_permalink( $_post->post_id ) ) == $add_to_cart_url ) {
			$add_to_cart_text = __( 'View Detail', 'wcloadmore' ); 
			$_is_view = "product_wc_view";
		}	
		else {
			$add_to_cart_text = __( 'Add to Cart', 'wcloadmore' );
			$add_to_cart_url = get_permalink($_post->post_id)."/?add-to-cart=".$_post->post_id; 
		}
		?>
		<div class='ik-post-item pid-<?php echo esc_attr( $_post->post_id ); ?>'> 
			<div class='ik-post-image' onmouseout="wclm_pr_item_image_mouseout(this)" onmouseover="wclm_pr_item_image_mousehover(this)"> 
				<a href="<?php echo get_permalink( $_post->post_id ); ?>">
					<div class="ov-layer">
						 <?php if( sanitize_text_field( $params["display_title_over_image"] )=='yes' ) { ?> 
								<div class='ik-overlay-post-content'>
									<?php if( sanitize_text_field( $params["hide_post_title"] ) =='no' ) { ?> 
										<div class='ik-post-name' style="color:<?php echo esc_attr( $params["post_title_color"] ); ?>" >
											<span  style="color:<?php echo esc_attr( $params["post_title_color"] ); ?>">
												<?php echo esc_html( $_post->post_title ); ?>
											</span>	
										</div>
									<?php } ?>	 
									 
									<div class='ik-product-sale-price' style="color:<?php echo esc_attr( $params["post_title_color"] ); ?>" >
										<?php echo get_woocommerce_currency_symbol().$_post->sale_price; ?>
									</div> 
									<div class='ik-product-sale-btn-price' style="color:<?php echo esc_attr( $params["post_title_color"] ); ?>" >
										<?php echo do_shortcode("[add_to_cart show_price='false' style='' id = '".$_post->post_id."']"); ?> 
									</div>
									<div class="clr"></div>
								</div>
								<div class="clr"></div>
						<?php } ?> 
					</div>
					<div class="clr"></div>
				</a>
				<a href="<?php echo get_permalink( $_post->post_id ); ?>">	 
					<?php echo $image; ?>
				 </a>  
			</div>  
			<?php if(sanitize_text_field( $params["display_title_over_image"] )=='no'){ ?> 
				<div class='ik-post-content'>
					<?php if(sanitize_text_field( $params["hide_post_title"] )=='no'){ ?> 
						<div class='ik-post-name'>  
							<a href="<?php echo get_permalink($_post->post_id); ?>" style="color:<?php echo esc_attr( $params["post_title_color"] ); ?>" >
									<?php echo esc_html( $_post->post_title ); ?>
							 </a>	 
						</div>
					<?php } ?>	  
					<div class='ik-product-sale-price' style="color:<?php echo esc_attr( $params["post_title_color"] ); ?>" >
						<?php echo get_woocommerce_currency_symbol().$_post->sale_price; ?>
					</div> 
					<div class='ik-product-sale-btn-price' style="color:<?php echo esc_attr( $params["post_title_color"] ); ?>" >
						<?php echo do_shortcode("[add_to_cart show_price='false' style='' id = '".$_post->post_id."']"); ?> 
					</div>	
				</div>	
			<?php } ?> 
		</div> 
		<?php 
	}  
	if( ( $all_pg ) >= $cur_all_pg + 2 ) {
		?>
			<div class="clr"></div>
			<div class='ik-post-load-more' align="center" onclick='WCLM_loadMoreWcProducts( "<?php echo esc_js( $_limit_start+$_limit_end ); ?>","<?php echo esc_js( $params["vcode"] ); ?>","<?php echo esc_js( $_total ); ?>",request_obj_<?php echo esc_js( $params["vcode"] ); ?>)'>
				<?php echo __( 'Load More', 'wcloadmore' ); ?>
			</div>
		<?php
	} else {
		?><div class="clr"></div><?php
	}