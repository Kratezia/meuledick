<?php get_header(); ?>

<?php 
global $sa_general, $currency_symbol;
	
$general_options = get_option('sa_general', $sa_general); 

$currency_symbol_before = "<span class='currency_symbol'>";
	$currency_symbol_after = "</span>";
	
	$currency_symbol = "";

	if(isset($general_options['currency_symbol']))
	{ 
		if ($general_options['currency_symbol'] > ""){
			$currency_symbol = $currency_symbol_before . $general_options['currency_symbol'] . $currency_symbol_after;
		}
	}else{
		$currency_symbol = $currency_symbol_before ."$".$currency_symbol_after;
	}
	
	if(isset($general_options['currency_symbol_align_right']))
	{ 
		$currency_symbol_align_right = $general_options['currency_symbol_align_right'];
			
	}else{
		$currency_symbol_align_right = 0;
	}

?>
	
<div class="container">
<div class="row">        
    <?php get_sidebar(); ?>
    <div class="eightcol last">

    <div id="main-content" >
        <div id="inner-content">

			<?php while ( have_posts() ) : the_post(); ?> 
           		<h1 class="page-title"><?php the_title(); ?></h1>
                
                <h4 class="single-menu-price">
				<?php				
				//echo the_ID();
                $post_id = get_the_ID();
                $single = true;
				
                // Return META Data
                $key = 'mg_price_description';
                $mg_price_description = get_post_meta($post_id, $key, $single);
                $key = 'mg_price';
                $mg_price = get_post_meta($post_id, $key, $single);
				
				$key = 'mg_second_price_description';
                $mg_second_price_description = get_post_meta($post_id, $key, $single);
                $key = 'mg_second_price';
                $mg_second_price = get_post_meta($post_id, $key, $single);
				
				$key = 'mg_third_price_description';
                $mg_third_price_description = get_post_meta($post_id, $key, $single);
                $key = 'mg_third_price';
                $mg_third_price = get_post_meta($post_id, $key, $single);
				
				$key = 'mg_fourth_price_description';
				$mg_fourth_price_description = get_post_meta($post_id, $key, $single);
				$key = 'mg_fourth_price';
				$mg_fourth_price = get_post_meta($post_id, $key, $single);
				
				$key = 'mg_fifth_price_description';
				$mg_fifth_price_description = get_post_meta($post_id, $key, $single);
				$key = 'mg_fifth_price';
				$mg_fifth_price = get_post_meta($post_id, $key, $single);
                
                if ($mg_price > ""){
                    if ($mg_price_description > ""){
                        echo $mg_price_description . ":&nbsp;";
                    }
                    if ($currency_symbol_align_right){
						echo "<span class='item-price'>". $mg_price . $currency_symbol . "</span>";
					}else{
						echo "<span class='item-price'>". $currency_symbol . $mg_price . "</span>";
					}
                }
                
                if ($mg_second_price > ""){
                    if ($mg_second_price_description > ""){
                        echo $mg_second_price_description . ":&nbsp;";
                    }
                    if ($currency_symbol_align_right){
						echo "<span class='item-price'>". $mg_second_price . $currency_symbol . "</span>";
					}else{
						echo "<span class='item-price'>". $currency_symbol . $mg_second_price . "</span>";
					}
					
                }
				
				if ($mg_third_price > ""){
                    if ($mg_third_price_description > ""){
                        echo $mg_third_price_description . ":&nbsp;";
                    }
                    if ($currency_symbol_align_right){
						echo "<span class='item-price'>". $mg_third_price . $currency_symbol . "</span>";
					}else{
						echo "<span class='item-price'>". $currency_symbol . $mg_third_price . "</span>";
					}
                }
				
				
				if ($mg_fourth_price > ""){
					if ($mg_fourth_price_description > ""){
						echo $mg_fourth_price_description . ":&nbsp;";
					}
					if ($currency_symbol_align_right){
						echo "<span class='item-price'>".$mg_fourth_price.$currency_symbol."</span>";
					}else{
						echo "<span class='item-price'>".$currency_symbol.$mg_fourth_price."</span>";
					}
					
				}
				
				if ($mg_fifth_price > ""){
					if ($mg_fifth_price_description > ""){
						echo $mg_fifth_price_description . ":&nbsp;";
					}
					if ($currency_symbol_align_right){
						echo "<span class='item-price'>".$mg_fifth_price.$currency_symbol."</span>";
					}else{
						echo "<span class='item-price'>".$currency_symbol.$mg_fifth_price."</span>";
					}
					
				}
			
				
                ?>
                </h4>
                <hr class="headings">
               
            	<div class='food_menu_wrapper'>
                	<div class='menu_item_wrapper'>
						<?php 
                        // check if the post has a Post Thumbnail assigned to it.
                        if ( has_post_thumbnail() ) { 
                          echo "<div class='menu_item_image_lg'>";
                          // THUMB WITH LIGHTBOX
                          $thumbnail_id=get_the_post_thumbnail($post->ID);
                          preg_match ('/src="(.*)" class/',$thumbnail_id,$link);
                          // Return Title and use it in the lightbox.
                          $title = get_the_title();
                          if ($title > ""){
                          $title = "title=\"$title\"";
                          }
                          echo do_shortcode('[image src="'.$link[1].'" width="200" height="200" '.$title.']');
                          // END THUMB WITH LIGHTBOX				
                          echo "</div>"; 
                        }
                
                        the_content(''); ?>
                                                  			
                    <div class="clear"></div>
                    </div></div>

			<?php endwhile; ?>
					
        <br class="clear" />
        <div class="corner topLeft"></div>
            <div class="corner topRight"></div>            
            <div class="corner bottomLeft"></div>
            <div class="corner bottomRight"></div>
        </div>
    </div>

	<div style="clear:both;"></div>
    
    	

    <?php get_footer(); ?>    