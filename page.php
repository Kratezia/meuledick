<?php get_header(); ?>
<div class="container">
<div class="row">        
    <?php get_sidebar(); ?>
    <div class="eightcol last">
    <div id="main-content">
        <div id="inner-content">
            <?php while ( have_posts() ) : the_post(); ?> 
           		<?php 
				$themo_hide_page_title = get_post_meta(get_the_ID(), 'mg_themo_hide_page_title', true);
				if ($themo_hide_page_title !== 'on'){ ?>
                <h1 class="page-title"><?php the_title(); ?></h1>
                <hr class="headings">
				<?php } ?>
            	<?php the_content(''); ?>
            <?php endwhile; ?>            
			<?php wp_link_pages('before=<p>&after=</p>&next_or_number=number&pagelink=Page %'); ?>                        
            <div class="corner topLeft"></div>
            <div class="corner topRight"></div>            
            <div class="corner bottomLeft"></div>
            <div class="corner bottomRight"></div>
        <br class="clear" /></div>
    </div>
	<div style="clear:both;"></div>
    <?php get_footer(); ?>    