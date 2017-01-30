<?php get_header(); ?>
	
<div class="container">
<div class="row"> 
    <?php get_sidebar(); ?>
	<div class="eightcol last">

    <div id="main-content">
        <div id="inner-content">
        	<?php while ( have_posts() ) : the_post(); ?>
            	<h1 class="post-title"><?php the_title(); ?></h1>
                <hr class="headings">
				<?php if ( has_post_thumbnail()) {
					echo '<div class="blog_post_image">';
                	$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
					echo do_shortcode('[image src="'.$large_image_url[0].'" width="668" height="180" '.the_title_attribute('echo=0').']');
                	echo '</div>';
                } ?>              
                <p class="postmeta"><?php _e('Posted on','eatery'); ?> <?php the_time('M jS, Y') ?> <?php _e('in','eatery'); ?> <?php the_category(', ') ?>&nbsp;// <a href="<?php comments_link(); ?>"><?php _e('Comments&nbsp;&raquo;','eatery'); ?></a><br />
                <span class="the-tags"><?php the_tags(); ?></span></p>                
            	<?php the_content(''); ?>
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
    