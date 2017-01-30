<?php

/**
	* Recent Events
	*
	* @copyright  2014 Themovation
	* @version    1.1 - May 27, 2014
	* Fixed Limit Posts Bug
 */
class WP_Widget_Upcoming_Events extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_themo_upcoming_entries', 'description' => __( "Upcoming Events") );
		parent::__construct('themo-upcoming-events', __('Upcoming Events'), $widget_ops);
		$this->alt_option_name = 'widget_themo_upcoming_entries';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance) {
		$cache = wp_cache_get('widget_themo_upcoming_events', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Upcoming Events') : $instance['title'], $instance, $this->id_base);
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
 			$number = 5;

		//$r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
		 $type = 'themo_event';
		$args_query = array (
			'post_type' => $type,
			'meta_key' => 'mg_event_start_datetime_timestamp',
			'orderby' => 'meta_value_num',
			'order' => 'ASC',
			'posts_per_page' => $number,
		);
		$wp_query = "";
		$temp = $wp_query; // assign ordinal query to temp variable for later use  
        $wp_query = null;
        $wp_query = new WP_Query($args_query);  
		
		if ($wp_query->have_posts()) :
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<ul>
		<?php  while ($wp_query->have_posts()) : $wp_query->the_post(); 
		 // Return META Data
		$start_date_time = '';
		$start_date = '';
		$start_time = '';
		$end_date_time = '';
		$end_date = '';
		$end_time = '';
		
		$start_date_time = get_post_meta($wp_query->post->ID, 'mg_event_start_datetime_timestamp', true);
		$start_date = date_i18n("M j", $start_date_time, true);
		$start_time = date_i18n(get_option( 'time_format' ), $start_date_time, true);
		
		
		if ($start_date > ""){
			$start_date = " ".$start_date;
		}
		if ($start_time > ""){
			$start_time = " @ " . $start_time;
		}
		?>
		<li><a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a><?php echo $start_date . $start_time; ?></li>
		<?php endwhile; ?>
		</ul>
		<?php echo $after_widget; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;
		$wp_query = $temp;
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_themo_upcoming_events', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_themo_upcoming_entries']) )
			delete_option('widget_themo_upcoming_entries');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('widget_themo_upcoming_events', 'widget');
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
<?php
	}
}

add_action('widgets_init', create_function('', 'return register_widget("WP_Widget_Upcoming_Events");'));
