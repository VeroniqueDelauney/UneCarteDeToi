<?php
$args = array(
    'post_status' => 'publish', 
    'posts_per_page' => '-1',
    'post_type' => 'temoignage',
    'orderby' => 'date',
    'order' => 'DESC'
);
$my_query = new WP_Query( $args );  
?>


<?php
if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();
?>    
    <div class="ligne animated fadeInLeft">
        <div class="small"><?php echo get_field("date") ?></div>
        <h2><?php echo get_field("nom"); ?></h2>
        <p>
            <?php echo get_field("temoignage"); ?>
        </p>
    </div>
<?php
endwhile;
wp_reset_postdata();
endif;
?>