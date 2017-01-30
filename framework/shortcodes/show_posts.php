<?php
/**
	* show_posts.php
	
	* Shortcode to display posts on any page
	
	* License: GNU GENERAL PUBLIC LICENSE Version 2
	* License URI: http://www.themovation.com/eatery/license 
	
	* @copyright  2012 Themovation
	* @version    1.0
	* @link       http://www.themovation.com/eatery
*/

/**
	* posts
	
	* Displays posts from a single category

*/
add_shortcode('blogfeed', 'shortcode_blog_feed');

function shortcode_blog_feed($atts) {
	extract(shortcode_atts(array(
		'cat' => '',
		'max'=> 3,
	), $atts));
	
	$styles = array();
	
	if ($cat > ""){
	// The Query
	// assign the variable as current category
	$categoryvariable = $cat;

	// concatenate the query
	$args = 'cat=' . $categoryvariable . '&posts_per_page='.$max.'&orderby=date&showposts='.$max;

	// run the query
	$the_query = new WP_Query( $args );

	query_posts( $args );
	$return_string = '';
	global $more;
	$more = 0;
	if (have_posts()) :
		ob_start();
	 	while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                    <div class="post-<?php the_ID(); ?>">
            		<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                	<p class="postmeta"><?php _e('Posted on','eatery'); ?> <?php the_time('F jS, Y') ?> <?php _e('in','eatery'); ?> <?php the_category(', ') ?> // <a href="<?php comments_link(); ?>"><?php _e('Comments&nbsp;&raquo;','eatery'); ?></a></p>
					<?php if ( has_post_thumbnail() ) { ?>
                        <a title="<?php printf(__('Permanent Link to %s', 'eatery'), get_the_title()); ?>" href="<?php the_permalink(); ?>">
                            <div class="blog_post_image">
                                <?php the_post_thumbnail('blog_image'); ?>
                            </div>
						</a>
                    <?php } ?>
            		<?php

					the_content(__('Read&nbsp;more&nbsp;&raquo;','eatery'));

					?>
                </div>
                <?php

		endwhile;
		$output = ob_get_contents();
		ob_end_clean();
		endif;
		wp_reset_query();
		//return $return_string;
		return $output;
	}
}
