<?php get_header(); ?>
	
<div class="container">
<div class="row">       
    <?php get_sidebar(); ?>
	<div class="eightcol last">
                       
    <div id="main-content">
        <div id="inner-content">
        	<?php if( is_home() && get_option( 'page_for_posts' ) ){
				 echo "<h1 class=\"page-title\">".get_the_title( get_option( 'page_for_posts' ))."</h1><hr class=\"headings\">"; 
			}
			?>
            
			<?php while ( have_posts() ) : the_post(); ?>                	
            	<div class="blog_post post-<?php the_ID(); ?> <?php post_class(); ?>">            
            		<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                	<p class="postmeta"><?php _e('Posted on','eatery'); ?> <?php the_time('M jS, Y') ?> <?php _e('in','eatery'); ?> <?php the_category(', ') ?>&nbsp;// <a href="<?php comments_link(); ?>"><?php _e('Comments&nbsp;&raquo;','eatery'); ?></a></p>                
					<?php if ( has_post_thumbnail() ) { ?>                        
                            <div class="blog_post_image">
                            	<a title="<?php printf(__('Permanent Link to %s', 'eatery'), get_the_title()); ?>" href="<?php the_permalink(); ?>">
                                	<?php the_post_thumbnail('blog_image'); ?>
								</a>
                            </div>    
                    <?php } ?>
                    <div class="post-content">
            			<?php the_content(__('Read more &raquo;','eatery')); ?>
                    </div>
                </div>

            <?php endwhile; ?>

			<?php if ( $wp_query->max_num_pages > 1 ) : ?>  
                <div id="older-posts"><?php next_posts_link(__('Next Page &raquo;','eatery')); ?></div>                
                <div id="newer-posts"><?php previous_posts_link(__('&laquo; Previous Page','eatery')); ?></div>            
            <?php endif; ?>  
            <br class="clear" />
            <div class="corner topLeft"></div>
            <div class="corner topRight"></div>            
            <div class="corner bottomLeft"></div>
            <div class="corner bottomRight"></div>                   
        </div>                
    </div>   

        <div style="clear:both;"></div>        

    <?php get_footer(); ?>    