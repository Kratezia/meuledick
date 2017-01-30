<?php get_header(); ?>
	
<div class="container"> 
<div class="row">        
    <?php get_sidebar(); ?>
    <div class="eightcol last">
                  
    <div id="main-content">
        <div id="inner-content">
        	<h1 class="page-title"><?php printf( __( 'Search Results for: %s' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
            <hr class="headings">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>        
                <?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                  echo "<div class='menu_item_image_sm'>";
                   // THUMB WITH LIGHTBOX
								$thumbnail_id=get_the_post_thumbnail($post->ID);
								preg_match ('/src="(.*)" class/',$thumbnail_id,$link);
								// Return Title and use it in the lightbox.
								$title = get_the_title();
								if ($title > ""){
									$title = "title=\"$title\"";
								}
								echo do_shortcode('[image src="'.$link[1].'" width="100" height="100" '.$title.']');
							// END THUMB WITH LIGHTBOX				
						  //the_post_thumbnail( 'food-menu-thumb' );
				  //the_post_thumbnail( 'food-menu-thumb' );
                  echo "</div>";
                  } ?>
                <?php if($post->post_type == 'post') :?>
                	<h3 class="search-result-title meta"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <p class="postmeta"><?php _e('Posted on','eatery'); ?> <?php the_time('F jS, Y') ?> <?php _e('in','eatery'); ?> <?php the_category(', ') ?> // <a href="<?php comments_link(); ?>"><?php _e('Comments&nbsp;&raquo;','eatery'); ?></a></p>
				<?php else: ?>
                	<h3 class="search-result-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <?php endif ?>
            	<?php the_excerpt(''); 
				
				//echo the_ID();
			$post_id = get_the_ID();
			$single = true;
			
				?>
                
                
            <br class="clear" />
			<?php endwhile; else: ?>
				<div class="post-title"><h2><?php _e( 'Nothing Found' ); ?></h2></div>
                <p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.' ); ?></p>
                                
            <?php endif; ?>
            
			<?php if ( $wp_query->max_num_pages > 1 ) : ?>  
                <div id="next-page"><?php next_posts_link(__('Next Page &raquo;','eatery')); ?></div>              
                <div id="previous-page"><?php previous_posts_link(__('&laquo; Previous Page','eatery')); ?></div>              
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