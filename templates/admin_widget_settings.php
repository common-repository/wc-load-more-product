<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
if( strpos($_SERVER["REQUEST_URI"],"widgets.php") <= 0){
	echo "Kindly buy the pro version of the plugin to use full functionalities. <a target='_blank' href='http://www.ikhodal.com/wc-load-more-product/'>Buy Now!</a>";
} 
?> 
<table class="wcloadmore-admin wcloadmore-admin-widget" cellspacing="0" cellpadding="0">
	<tr> <td class="tp-label">
			<p><label for="<?php echo $this->get_field_id( 'widget_title' ); ?>"><?php echo __( 'Widget title', 'wcloadmore' ); ?>:</label></p>
	 	</td> 
		<td>
			<p>
				<input id="<?php echo $this->get_field_id( 'widget_title' ); ?>" name="<?php echo $this->get_field_name( 'widget_title' ); ?>" type="text" value="<?php echo $instance['widget_title']; ?>"   />
			</p>
		</td>
	</tr>	 
	
	<tr>
		<td class="tp-label">
			<p> <label for="<?php echo $this->get_field_id( 'number_of_post_display' ); ?>"><?php echo __( 'Number of post display', 'wcloadmore' ); ?>:</label> </p> 
		</td>  
		<td>
			<p> 
				<input id="<?php echo $this->get_field_id( 'number_of_post_display' ); ?>" name="<?php echo $this->get_field_name( 'number_of_post_display' ); ?>" type="text" value="<?php echo $instance['number_of_post_display']; ?>"   />
			</p>
		</td>
	</tr>

	<tr>
		<td class="tp-label">
			<p> <label for="<?php echo $this->get_field_id( 'title_text_color' ); ?>"><?php echo __( 'Product title text color', 'wcloadmore' ); ?>:</label> </p> 
		</td>  
		<td>  
			<p> 
				<input class="color-field" id="<?php echo $this->get_field_id( 'title_text_color' ); ?>" name="<?php echo $this->get_field_name( 'title_text_color' ); ?>" type="text" value="<?php echo $instance['title_text_color']; ?>"   />
			</p>
		</td>
	</tr>  

	<tr>
		<td class="tp-label">
			<p> <label for="<?php echo $this->get_field_id( 'header_text_color' ); ?>"><?php echo __( 'Widget title text color', 'wcloadmore' ); ?>:</label> </p>
		</td> 
		<td> 
			<p> 
				<input class="color-field" id="<?php echo $this->get_field_id( 'header_text_color' ); ?>" name="<?php echo $this->get_field_name( 'header_text_color' ); ?>" type="text" value="<?php echo $instance['header_text_color']; ?>"   />
			</p>
		</td>
	</tr>
	
	<tr>
		<td class="tp-label">
			<p> <label for="<?php echo $this->get_field_id( 'header_background_color' ); ?>"><?php echo __( 'Widget title background color', 'wcloadmore' ); ?>:</label> </p>
		</td> 
		<td>
			<p> 
				<input class="color-field" id="<?php echo $this->get_field_id( 'header_background_color' ); ?>" name="<?php echo $this->get_field_name( 'header_background_color' ); ?>" type="text" value="<?php echo $instance['header_background_color']; ?>"   />
			</p> 
		</td> 	
	</tr>
	
	<tr>
		<td class="tp-label">
			<p> <label for="<?php echo $this->get_field_id( 'tp_widget_width' ); ?>"><?php echo __( 'Widget Width', 'wcloadmore' ); ?>:</label> </p>
		</td> 
		<td>   
			<p> 
				<input id="<?php echo $this->get_field_id( 'tp_widget_width' ); ?>" name="<?php echo $this->get_field_name( 'tp_widget_width' ); ?>" type="text" value="<?php echo $instance['tp_widget_width']; ?>"   />
			</p>
		</td>
	</tr>
	
	<tr>
		<td class="tp-label">
			<p> <label for="<?php echo $this->get_field_id( 'display_title_over_image' ); ?>"><?php echo __( 'Display title over image?', 'wcloadmore' ); ?></label> </p>
		</td> 
		<td>    
			<p> 
				<input type="radio" <?php echo ( $instance['display_title_over_image'] == "yes" ) ? ' checked="checked"' : ''; ?> value="yes" name="<?php echo $this->get_field_name( 'display_title_over_image' ); ?>" id="<?php echo $this->get_field_id( 'display_title_over_image' ); ?>_1" /> 
				<label for="<?php echo $this->get_field_id( 'display_title_over_image' ); ?>_1"><?php echo __( 'Yes', 'wcloadmore' ); ?></label>
				
				<input type="radio" <?php echo ( $instance['display_title_over_image'] == "no" ) ? ' checked="checked"' : ''; ?> value="no" name="<?php echo $this->get_field_name( 'display_title_over_image' ); ?>" id="<?php echo $this->get_field_id( 'display_title_over_image' ); ?>_2" />
				<label for="<?php echo $this->get_field_id( 'display_title_over_image' ); ?>_2"><?php echo __( 'No', 'wcloadmore' ); ?></label>
			</p>
		</td>
	</tr>
	
	<tr>
		<td class="tp-label">
			<p> <label for="<?php echo $this->get_field_id( 'hide_widget_title' ); ?>"><?php echo __( 'Hide widget title?', 'wcloadmore' ); ?></label> </p>
		</td> 
		<td> 
			<p> 
				<input type="radio" <?php echo ( $instance['hide_widget_title'] == "yes" ) ? ' checked="checked"' : ''; ?> value="yes" name="<?php echo $this->get_field_name( 'hide_widget_title' ); ?>" id="<?php echo $this->get_field_id( 'hide_widget_title' ); ?>_1" />
				<label for="<?php echo $this->get_field_id( 'hide_widget_title' ); ?>_1"><?php echo __( 'Yes', 'wcloadmore' ); ?></label>	
				
				<input type="radio" <?php echo ( $instance['hide_widget_title'] == "no" ) ? ' checked="checked"' : ''; ?> value="no" name="<?php echo $this->get_field_name( 'hide_widget_title' ); ?>" id="<?php echo $this->get_field_id( 'hide_widget_title' ); ?>_2" />
				<label for="<?php echo $this->get_field_id( 'hide_widget_title' ); ?>_2"><?php echo __( 'No', 'wcloadmore' ); ?></label>
			</p>
		</td>
	</tr> 
	
	<tr>
		<td class="tp-label">
			<p> <label for="<?php echo $this->get_field_id( 'hide_post_title' ); ?>"><?php echo __( 'Hide product title?', 'wcloadmore' ); ?></label> </p>
		</td>
		<td>  
			<p> 
				<input type="radio" <?php echo ( $instance['hide_post_title'] == "yes" ) ? ' checked="checked"' : ''; ?> value="yes" name="<?php echo $this->get_field_name( 'hide_post_title' ); ?>" id="<?php echo $this->get_field_id( 'hide_post_title' ); ?>_1" /> 
				<label for="<?php echo $this->get_field_id( 'hide_post_title' ); ?>_1"><?php echo __( 'Yes', 'wcloadmore' ); ?></label>
				
				<input type="radio" <?php echo ( $instance['hide_post_title'] == "no" ) ? ' checked="checked"' : ''; ?> value="no" name="<?php echo $this->get_field_name( 'hide_post_title' ); ?>" id="<?php echo $this->get_field_id( 'hide_post_title' ); ?>_2" />
				<label for="<?php echo $this->get_field_id( 'hide_post_title' ); ?>_2"><?php echo __( 'No', 'wcloadmore' ); ?></label>
			</p>
		</td>
	</tr>   
 
	<tr>
		<td class="tp-label">
			<p> <label for="<?php echo $this->get_field_id( 'template' ); ?>"><?php echo __( 'Template', 'wcloadmore' ); ?>:</label> </p>
		</td>
		<td>
			<p> 
				<select id="<?php echo $this->get_field_id( 'template' ); ?>" name="<?php echo $this->get_field_name( 'template' ); ?>" >
					<option <?php echo ( ( $instance['template'] == 'pane_style_1' || $instance['template'] == '' ) ? "selected" : "" ); ?> value="pane_style_1"><?php echo __( 'Pane style 1', 'wcloadmore' ); ?></option>
					<option <?php echo ( ( $instance['template'] == 'pane_style_2' ) ? "selected" : "" ); ?> value="pane_style_2"><?php echo __( 'Pane style 2', 'wcloadmore' ); ?></option>
					<option <?php echo ( ( $instance['template'] == 'pane_style_3' ) ? "selected" : "" ); ?> value="pane_style_3"><?php echo __( 'Pane style 3', 'wcloadmore' ); ?></option>
					<option <?php echo ( ( $instance['template'] == 'pane_style_4' ) ? "selected" : "" ); ?> value="pane_style_4"><?php echo __( 'Pane style 4', 'wcloadmore' ); ?></option>
				</select>
			</p> 
		</td>
	</tr>
</table>
<input type="hidden" name="<?php echo $this->get_field_name( 'vcode' ); ?>" id="<?php echo $this->get_field_id( 'vcode' ); ?>" value="<?php echo $instance["vcode"]; ?>" /><br />