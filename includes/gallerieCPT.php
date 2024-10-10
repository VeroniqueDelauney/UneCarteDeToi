<?php
$args = array(
    'post_status' => 'publish', 
    'posts_per_page' => '-1',
    'post_type' => 'illustration',
    'orderby' => 'rand'
);
$my_query = new WP_Query( $args );  
?>

<div class="gallerie animated fadeInLeft">
    <?php
    if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();
    ?>    
        <!-- Photo -->
        <div class="img">
            <img src="<?php echo get_field("image")["sizes"]["medium"]; ?>" alt="<?php echo the_title(); ?>" title="<?php echo the_title(); ?>">
        </div>
    <?php
    endwhile;
    wp_reset_postdata();
    endif;
    ?>
</div>