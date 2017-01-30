<?php get_header(); ?>

<?php
global $post;

// Return META Data
$start_date_time = get_post_meta($post->ID, 'mg_event_start_datetime_timestamp', true);

$start_date = date_i18n(get_option( 'date_format' ), $start_date_time, true) ;
$start_time = date_i18n(get_option( 'time_format' ), $start_date_time, true) ;
$start_day = date_i18n("d", $start_date_time, true) ;
$start_month = date_i18n("M", $start_date_time, true) ;				

$end_date_time = get_post_meta($post->ID, 'mg_event_end_datetime_timestamp', true);
$end_date = date_i18n(get_option( 'date_format' ), $end_date_time, true) ;
$end_time = date_i18n(get_option( 'time_format' ), $end_date_time, true) ;

if ($start_date === $end_date){
					$end_date = "";
				}

?>	
<div class="container">
<div class="row"> 
    <?php get_sidebar(); ?>
	<div class="eightcol last">

    <div id="main-content">
        <div id="inner-content">
        	<?php while ( have_posts() ) : the_post(); ?>
            	<h1 class="post-title"><?php the_title(); ?> </h1>
                <hr class="headings">
				<?php if ( has_post_thumbnail()) {
					echo '<div class="blog_post_image">';
                	$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
					echo do_shortcode('[image src="'.$large_image_url[0].'" width="668" height="180" '.the_title_attribute('echo=0').']');
                	echo '</div>';
                } ?>              
                <div class="date-box">
                    <p class="day"><?php echo $start_day; ?></p>
                    <p class="month"><?php echo $start_month; ?></p>                            
                </div>
                <p class="eventmeta">
				<?php echo "<span class='meta-start'>";?><?php _e('Starts:','eatery'); ?> <?php echo $start_date ." ". $start_time;
					echo "</span><span class='meta-end'>"; ?>
                <?php _e('Ends:','eatery'); ?><?php echo $end_date ." ". $end_time;				
					echo "</span>";					
                ?>
                </p>
                <div class="event-content">
	            	<?php the_content(''); ?>
				</div>
                <?php comments_template( '', true ); ?>  
                <br class="clear" />
            <?php endwhile; ?>

			<?php if ( $wp_query->max_num_pages > 1 ) : ?>  
                <div id="older-posts"><?php next_posts_link(__('Older Posts &raquo;','eatery')); ?></div>  
                <div id="newer-posts"><?php previous_posts_link(__('&laquo; Newer Posts','eatery')); ?></div>  
            <?php endif; ?> 
            
            <div class="corner topLeft"></div>
            <div class="corner topRight"></div>            
            <div class="corner bottomLeft"></div>
            <div class="corner bottomRight"></div>       
        </div>                
    </div>   

    <div style="clear:both;"></div>        

    <?php get_footer(); ?>    
    