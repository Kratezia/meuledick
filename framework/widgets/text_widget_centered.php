<?php
/* Custom Widget for centered text */

class WP_Text_Widget_Centered extends WP_Widget {

	function __construct() {
		$widget_ops = array(
			'classname' => 'widget_text',
			'description' => __('Arbitrary text or HTML - Centered')
		);

		$control_ops = array(
			'width' => 400,
			'height' => 350
		);

		parent::__construct('text_centered', __('Text Centered'), $widget_ops, $control_ops);
	}

	function widget($args, $instance) {

		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		$text = apply_filters('widget_text', empty($instance['text']) ? '' : $instance['text'], $instance);
		echo "<div class='textCenter' >".$before_widget;
		
		if (!empty($title)) {
			echo $before_title . $title . $after_title;
		}
		echo "<div class=\"textwidget\">";
		echo !empty($instance['filter']) ? wpautop($text) : $text;
		echo "</div>";
		echo $after_widget."</div>";

	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		
		if (current_user_can('unfiltered_html'))
			$instance['text'] = $new_instance['text'];
		else
			$instance['text'] = stripslashes(wp_filter_post_kses(addslashes($new_instance['text'])));
		$instance['filter'] = isset($new_instance['filter']);

		return $instance;

	}

	function form($instance) {
		$instance = wp_parse_args((array) $instance, array(
			'title' => '',
			'text' => ''
		));

		$title = strip_tags($instance['title']);
		$text = esc_textarea($instance['text']);

?>

<p>
	<label for="<?php echo $this->get_field_id('title'); ?>">
		<?php _e('Title:'); ?>
	</label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
</p>

<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
<p>

	<input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />
	&nbsp;
	<label for="<?php echo $this->get_field_id('filter'); ?>">
		<?php _e('Automatically add paragraphs'); ?>
	</label>
</p>

<?php

	}

}

add_action('widgets_init', create_function('', 'return register_widget("WP_Text_Widget_Centered");'));

