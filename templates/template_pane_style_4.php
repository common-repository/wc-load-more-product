<?php if ( ! defined( 'ABSPATH' ) ) exit;    $vcode = $this->_config["vcode"];   ?>
 <script type='text/javascript' language='javascript'> 
	var request_obj_<?php echo esc_js( $vcode ); ?> = {   
			hide_post_title:'<?php echo esc_js( $this->_config["hide_post_title"] ); ?>', 
			post_title_color:'<?php echo esc_js( $this->_config["title_text_color"] ); ?>', 
			header_text_color:'<?php echo esc_js( $this->_config["header_text_color"] ); ?>', 
			header_background_color:'<?php echo esc_js( $this->_config["header_background_color"] ); ?>',
			display_title_over_image:'<?php echo esc_js( $this->_config["display_title_over_image"] ); ?>', 
			number_of_post_display:'<?php echo esc_js( $this->_config["number_of_post_display"] ); ?>',  
			vcode:'<?php echo esc_js( $vcode ); ?>'
		}
 </script>   
<div id="wcloadmore" style="width:<?php echo $this->_config["tp_widget_width"]; ?>"  class=" pane_style_4 <?php echo ( ( trim( $this->_config["display_title_over_image"] ) == "yes" ) ? "disp_title_over_img" : "" ); ?>">
	<?php if($this->_config["hide_widget_title"]=="no"){ ?>
		<div class="ik-pst-clm-title-head" style="background-color:<?php echo esc_attr( $this->_config["header_background_color"] ); ?>;color:<?php echo esc_attr( $this->_config["header_text_color"] ); ?>"  >
			<?php echo esc_html( $this->_config["widget_title"] ); ?>   
		</div>
	<?php } ?> 
	<span class='wp-load-icon'>
		<img width="18px" height="18px" src="<?php echo WCLM_MEDIA.'images/loader.gif'; ?>" />
	</span>
	<div class="wea_content lt-clm" id="<?php echo $vcode; ?>" > 
		<div class="clr"></div>
		<div class="item-posts">
			<?php  
				   
				 $_limit_start = 0;
				 $_limit_end = $this->_config["number_of_post_display"];
				 $is_default_category_with_hidden = 0; 
				 $__current_term_count = $this->getSqlResult(0, 0, 1);
				 $__current_term_count = $__current_term_count[0]->total_val;
				 
				?><script language='javascript'>
					var request_obj_<?php echo esc_js( $vcode ); ?> = {   
						hide_post_title:'<?php echo esc_js( $this->_config["hide_post_title"] ); ?>',  
						post_title_color:'<?php echo esc_js( $this->_config["title_text_color"] ); ?>',   
						header_text_color:'<?php echo esc_js( $this->_config["header_text_color"] ); ?>', 
						header_background_color:'<?php echo esc_js( $this->_config["header_background_color"] ); ?>',
						display_title_over_image:'<?php echo esc_js( $this->_config["display_title_over_image"] ); ?>', 
						number_of_post_display:'<?php echo esc_js( $this->_config["number_of_post_display"] ); ?>', 
						vcode:'<?php echo esc_js( $vcode ); ?>'
					}
				</script><?php  
			 
				$_total_posts =  $__current_term_count;
				if( $_total_posts <= 0 ) {
					?><div class="ik-post-no-items"><?php echo __( 'No products found.', 'wcloadmore' ); ?></div></div><?php  
				}  
				$post_list = $this->getSqlResult( 0, $_limit_end ); 
				foreach ( $post_list as $_post ) { 
					$image  = $this->getWcProductImage( $_post->post_image ); 
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
								<div class="ov-layer" > 
									 <?php if( sanitize_text_field( $this->_config["display_title_over_image"] ) == 'yes' ) { ?> 
											<div class='ik-overlay-post-content'>
												<?php if( sanitize_text_field( $this->_config["hide_post_title"] ) == 'no' ) { ?> 
													<div class='ik-post-name' >
														 <span style="color:<?php echo esc_attr( $this->_config["title_text_color"] ); ?>" ><?php echo esc_html( $_post->post_title ); ?></span>
													</div>
												<?php } ?>   	 
												<div class='ik-product-sale-price' style="color:<?php echo esc_attr( $this->_config["title_text_color"] ); ?>" >
													<?php echo get_woocommerce_currency_symbol().$_post->sale_price; ?>
												</div> 
												<div class='ik-product-sale-btn-price' style="color:<?php echo esc_attr( $this->_config["title_text_color"] ); ?>" >
													<?php echo do_shortcode("[add_to_cart show_price='false' style='' id = '".$_post->post_id."']"); ?> 
												</div>
												<div class="clr"></div>
											</div>
											<div class="clr"></div>
									<?php } ?>
								</div>
								<div class="clr"></div>
							</a>
							<div class="clr"></div>
							<a href="<?php echo get_permalink( $_post->post_id ); ?>"> 
								<?php echo $image; ?>
							</a>   
						</div>  
						<?php if( sanitize_text_field( $this->_config["display_title_over_image"] ) == 'no' ) { ?> 
							<div class='ik-post-content'>
								<?php if( sanitize_text_field( $this->_config["hide_post_title"] ) =='no'){ ?> 
									<div class='ik-post-name'>
										<a href="<?php echo get_permalink( $_post->post_id ); ?>" style="color:<?php echo esc_attr( $this->_config["title_text_color"] ); ?>" >
											<?php echo esc_html( $_post->post_title ); ?>
										</a>	
									</div>
								<?php } ?>	 
								<div class='ik-product-sale-price' style="color:<?php echo esc_attr( $this->_config["title_text_color"] ); ?>" >
									<?php echo get_woocommerce_currency_symbol().$_post->sale_price; ?>
								</div> 
								<div class='ik-product-sale-btn-price' style="color:<?php echo esc_attr( $this->_config["title_text_color"] ); ?>" >
									<?php echo do_shortcode("[add_to_cart show_price='false' style='' id = '".$_post->post_id."']"); ?> 
								</div>		
							</div>	
						<?php } ?> 
					</div> 
					<?php 
				}
				
				if( $_total_posts > sanitize_text_field( $this->_config["number_of_post_display"] ) ) { ?>
						<div class="clr"></div>
						<div class='ik-post-load-more'  align="center" onclick='WCLM_loadMoreWcProducts( "<?php echo esc_js( $_limit_start+$_limit_end ); ?>", "<?php echo esc_js( $this->_config["vcode"] ); ?>", "<?php echo esc_js( $_total_posts ); ?>", request_obj_<?php echo esc_js( $this->_config["vcode"] ); ?> )'>
							<?php echo __('Load More', 'wcloadmore' ); ?>
						</div>
					<?php  
				} else {
					?><div class="clr"></div><?php
				} 
					 
			?> 
		</div>
		<div class="clr"></div>
	</div>
</div>