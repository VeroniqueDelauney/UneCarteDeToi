<?php
$args = array(
    'post_status' => 'publish', 
    'posts_per_page' => '1',
    'post_type' => 'temoignage',
    'orderby' => 'rand'
);
$my_query = new WP_Query( $args );  
?>

<div class="centered animated fadeInLeft">
    <?php
    if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();
    ?>    
        <h3><?php echo get_field("nom") ?></h3>
        <?php echo get_field("temoignage") ?>
    <?php
    endwhile;
    wp_reset_postdata();
    endif;
    ?>
</div>