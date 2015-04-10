<?php 
if ( !defined('ABSPATH')) exit;
class nusantara_widget_text extends WP_Widget {
	function nusantara_widget_text() {
		$widget_ops = array('classname' => 'nusantara_widget_text',
		 'description' => __('Text Widget with Two Columns.','nusantara'));
		$control_ops = array('width' => 400, 'height' => 350);
		$this->WP_Widget('nusantara_text', __('nusantara texarea','nusantara'), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		$text = apply_filters( 'nusantara_text', $instance['text'], $instance );
		$text2 = apply_filters( 'nusantara_text', $instance['text2'], $instance );
		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } ?>
			<div class="textwidget"><div class="six">
			<?php
			if ($instance['filter']) {
				echo(wpautop($text)); echo('</div><div class="six">');
				echo(wpautop($text2)); echo('</div><div class="clear"></div>');
			} else {
			    echo($text); echo('</div><div class="six">');
			    echo($text2); echo('</div><div  class="clear"></div>');
			}
			?>
			</div>
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		if ( current_user_can('unfiltered_html') ) {
			$instance['text'] =  $new_instance['text'];
			$instance['text2'] =  $new_instance['text2'];
		}
		else {
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
			$instance['text2'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text2']) ) );
		}
		$instance['filter'] = isset($new_instance['filter']);
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', 'text2' => '',  'filter' => 0) );
		$title = strip_tags($instance['title']);
		$text = format_to_edit($instance['text']);
		$text2 = format_to_edit($instance['text2']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','nusantara'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<label><?php _e('Left Side:','nusantara'); ?></label>
		<textarea class="widefat" rows="8" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
		<label><?php _e('Right Side:','nusantara'); ?></label>
		<textarea class="widefat" rows="8" cols="20" id="<?php echo $this->get_field_id('text2'); ?>" name="<?php echo $this->get_field_name('text2'); ?>"><?php echo $text2; ?></textarea>
		<p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />
			&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e('Automatically add paragraphs','nusantara'); ?></label></p>
<?php
	}
}
?>