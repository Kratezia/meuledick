  jQuery(document).ready(function(){
            jQuery("a[data-gal^='prettyPhoto']").prettyPhoto();
            jQuery("#inner-content:first a[data-gal^='prettyPhoto']").prettyPhoto({animation_speed:'fast',theme:'pp_default',slideshow:5000, autoplay_slideshow: false, social_tools: false, show_title: true, overlay_gallery: false});
            jQuery("#inner-content:gt(0) a[data-gal^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true, social_tools: false, show_title: true});
        });